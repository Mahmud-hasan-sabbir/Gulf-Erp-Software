<?php

namespace App\Http\Controllers\Warranty;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty\Spare;
use App\Models\Warranty\SpareDetails;
use App\Helpers\Helper;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastItemRegister;
use App\Models\Warranty\Complaint;
use DB;
use Response;
use App\Models\Setup;
use App\Models\Admin\InfoPersonal;
use App\Models\User;

class SparePartController extends Controller
{

    public function sparePartList()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 2)->where('status', 1)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->get();

        //techName//
        $setup = setup::first();
        $technicianId = Setup::first();
        $employ_id = InfoPersonal::where('mast_designation_id', $technicianId->services_technician)->pluck('emp_id');
        $tecnicianName = User::whereNotIn('id', $employ_id)->get();

        $technician = InfoPersonal::with('user')->with('mastDepartment')->with('mastDesignation')->where('mast_designation_id', $technicianId->services_technician)->get();

        $data = Complaint::with('custo')->get();
        $spare = Spare::with('issueNo')->with('techName')->with('purchaseDetails')->get();
        // dd($list);

        // $job = DB::table('job_cards')
        // ->join('users','users.id','job_cards.tech_id')
        // ->join('complaints','complaints.id','job_cards.tracking_no')
        // ->get()->toArray();
        // // dd($job);
        
        return view('layouts.pages.warranty.spare_part.index',compact('customer','item_group','data','spare','setup','technicianId','employ_id','tecnicianName','technician','technicianId'));
    }

    public function getComplaint(Request $request)
    {
        $desig = DB::table('complaints')->where('complaints.id', $request->id)
        ->join('mast_customers','mast_customers.id','complaints.mast_customer_id')
        ->select('complaints.issue_date','mast_customers.name','complaints.issue_no')
        ->first();
        return response()->json([
            'desig' => $desig,
        ]);
    }

    public function spareEdit(Request $request)
    {
        
        $spot = Spare::where('id', $request->id)->with('issueNo')->with('mastCustomer')->with('makeName')->first()->toArray();
        // dd($spot);
        $compliant = Complaint::all();

        $user_data = User::all();
        // dd($spot);
        $purchase_details = SpareDetails::where('requ_id', $request->id)
            ->join('spares', 'spares.id', 'spare_details.requ_id')
            ->join('mast_item_categories', 'mast_item_categories.id', 'spare_details.cat_id')
            ->join('mast_item_registers', 'mast_item_registers.id', 'spare_details.mast_item_register_id')
            ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
            ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')
            ->select('spare_details.*', 'spares.requ_no', 'spares.requ_date', 'spares.remarks',
                'mast_item_categories.id as cat_id','mast_units.unit_name','mast_item_groups.id as item_group_id','mast_item_groups.part_name as part_name', 'mast_item_registers.id as item_register_id', 'mast_item_registers.part_no','mast_item_registers.box_qty')
            ->get();
            
            // dd($purchase_details);

        return response()->json([
           'spot'               => $spot,
           'compliant'          => $compliant,
            'purchase_details'  => $purchase_details,
            'user_data'         => $user_data,
            // 'value'   => $value,

            // 'complaintt' => $complaintt,
            // 'customer' => $customer,
            // 'purchase_details' => $purchase_details,
        ]);
        
    }
    public function getPartNumber(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return view('layouts.pages.inventory.purchase.load-part-number',compact('data'));
    }
    public function getPartNo(Request $request)
    {
        $anotherField = MastItemRegister::where('id', $request->part_id)->with('unit')->first();
        return response()->json($anotherField);
    }
    public function getEditPartNo(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return response()->json($data);
    }

    public function storeSpare(Request $request)
    {
        //  $purchase_codes = Helper::IDGenerator(new Requisition, 'requ_no', 5, "REQUISITION-NO"); /* Generate id */ 
        $requ_id=$request->requ_id;
        if(isset($requ_id)){
            $storePurchase = Spare::findOrFail($requ_id);
        }else{
            $validator = Validator::make($request->all(), [
                
                'requ_date' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $storePurchase = new Spare();
            // $storePurchase->requ_no = $purchase_codes;
        }
        $IDGenarator = Helper::IDGenerator(new Spare,'requ_no', 5, "REQU-");
        $storePurchase->requ_no      = $request->requ_no;
        $storePurchase->requ_date    = $request->requ_date;
        $storePurchase->tech_id      = $request->tech_id;
        $storePurchase->complaint_id = $request->complaint_id;
        $storePurchase->remarks      = $request->remarks;
        $storePurchase->status       = 0;
        $storePurchase->requ_no      = $IDGenarator;
        $storePurchase->mast_item_category_id = 2;
        // $storePurchase->mast_customer_id = $request->mast_customer_id;
        
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){

                $data = new SpareDetails();

                $data->requ_id = $storePurchase->id;
                $data->cat_id = 2;
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;
                
                $data->status = 1;
                if(isset($requ_id)){
                    $data->requ_id = $requ_id;
                }else{
                    $data->requ_id = $storePurchase->id;
                }
               
                $data->user_id = Auth::user()->id;
                $data->save();

            }
        }
        if (isset($request->editFile[0]['item_id']) && !empty($request->editFile[0]['item_id'])) {
            foreach($request->editFile as $item){
                $data = SpareDetails::findOrFail($item['id']);

                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;

                $data->status = 1;
                if(isset($requ_id)){
                    $data->requ_id = $requ_id;
                }else{
                    $data->requ_id = $storePurchase->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        if(isset($requ_id)){
            $purchase = Spare::where('id', $requ_id)->first();
        }else{
            $purchase = Spare::where('id', $storePurchase->id)->first();
        }

        $issueNo = $purchase->issueNo;
        $techName = $purchase->techName;
        return response()->json([
            'storePurchase'   => $storePurchase,
            'purchase'        => $purchase,
            'issueNo'         => $issueNo,
            'techName'        => $techName,
        ]);
        
        // return response()->json('success');
        
    }
    
    // public function calcList($id)
    // {

    // $designId = Complaint::find($id);
    // $design = Complaint::select( `issue_no`, `issue_date` , `mast_customer_id`)->where('id','=',$designId);
    // // return Response::json(array('datas' => $design));
    // // return response()->json(['data'=>$design]);
    // return Response::json($design);
    // }
}
