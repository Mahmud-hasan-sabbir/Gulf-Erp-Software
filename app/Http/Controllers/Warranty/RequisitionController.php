<?php


namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastItemRegister;
use App\Helpers\Helper;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\Requisition;
use App\Models\Warranty\RequisitionDetails;
use App\Models\Admin\InfoPersonal;
use App\Models\Master\MastDesignation;
use App\Models\User;
use App\Models\Setup;


class RequisitionController extends Controller
{
    public function indexTools()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 4)->where('status', 1)->orderBy('part_name', 'asc')->get();

        // $complaintt = Complaint::with('complaintType')->get();
        $customer = MastCustomer::where('status', 1)->get();
        
        // $data = Requisition::where('mast_item_category_id', 4)->with('complaintType','requisitionDetails','mastCustomer')->orderBy('id', 'desc')->latest()->get();

        $data = Complaint::with('custo')->get();
        $list = Requisition::with('issueNo')->with('techName')->get();
        // dd($list);

        return view('layouts.pages.warranty.tools_requisition.index',compact('customer','item_group','data','list'));
    }

    public function toolsList()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 4)->where('status', 1)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->get();

        ///for tech name////
        $setup = setup::first();
        $technicianId = Setup::first();
        $employ_id = InfoPersonal::where('mast_designation_id', $technicianId->services_technician)->pluck('emp_id');
        $tecnicianName = User::whereNotIn('id', $employ_id)->get();

        $technician = InfoPersonal::with('user')->with('mastDepartment')->with('mastDesignation')->where('mast_designation_id', $technicianId->services_technician)->get();
        // dd($technician);

        $data = Complaint::with('custo')->get();
        $list = Requisition::with('issueNo')->with('techName')->get();
        // dd($list);

        return view('layouts.pages.warranty.tools_requisition.index',compact('customer','item_group','data','list','setup','technicianId','employ_id','tecnicianName','technician'));
    }

    public function customGet(Request $request)
    {
        $desig = DB::table('complaints')->where('complaints.id', $request->id)
        ->join('mast_customers','mast_customers.id','complaints.mast_customer_id')
        ->select('complaints.issue_date','mast_customers.name','complaints.issue_no')
        ->first();
        return response()->json([
            'desig' => $desig,
        ]);
    }

    public function storeTools(Request $request)
    {
       
        //  $purchase_codes = Helper::IDGenerator(new Requisition, 'requ_no', 5, "REQUISITION-NO"); /* Generate id */ 
        
        $requ_id=$request->requ_id;
        if(isset($requ_id)){
            $storePurchase = Requisition::findOrFail($requ_id);
        }else{
            $validator = Validator::make($request->all(), [
               
                'requ_date' => 'required',
                
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $storePurchase = new Requisition();
            // $storePurchase->requ_no = $purchase_codes;
        }

        $IDGenarator = Helper::IDGenerator(new Requisition,'requ_no', 5, "REQU");
        $storePurchase->requ_no      = $request->requ_no;
        $storePurchase->tech_id      = $request->tech_id;
        $storePurchase->complaint_id = $request->complaint_id;
        $storePurchase->requ_date    = $request->requ_date;
        $storePurchase->remarks      = $request->remarks;
        $storePurchase->status       = 0;
        $storePurchase->requ_no      = $IDGenarator;
        $storePurchase->mast_item_category_id = 4;
        // $storePurchase->mast_customer_id = $request->mast_customer_id;
        
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){

                $data = new RequisitionDetails();

                $data->requ_id = $storePurchase->id;
                $data->cat_id = 4;
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
                $data = RequisitionDetails::findOrFail($item['id']);

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
            $requisition = Requisition::where('id', $requ_id)->first();
        }else{
            $requisition = Requisition::where('id', $storePurchase->id)->first();
        }
        $issueNo = $requisition->issueNo;
        $techName = $requisition->techName;
        return response()->json([
            'storePurchase' => $storePurchase,
            'requisition' => $requisition,
            'issueNo' => $issueNo,
            'techName' => $techName,
        ]);
        // return response()->json('success');
        
    }

    public function inv_purchase_destroy($id)
    {
        $data=RequisitionDetails::find($id);
        $data->delete();
        return response()->json('success');
    }

    public function getPartNumber(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return view('layouts.pages.warranty.load-part-number',compact('data'));
    }

    public function anotherField(Request $request)
    {
        $anotherField = MastItemRegister::where('id', $request->part_id)->with('unit')->first();
       
        return response()->json($anotherField);
    }

    public function toolsEdit(Request $request)
    {
        // // Get active customers

        $tools = Requisition::where('id', $request->id)->with('issueNo')->with('mastCustomer')->with('makeName')->first()->toArray();
        $compliant = Complaint::all();

        $user_data = User::all();
        
        $requisition_details = RequisitionDetails::where('requ_id', $request->id)
        ->join('requisitions', 'requisitions.id', 'requisition_details.requ_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'requisition_details.cat_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'requisition_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')
        ->select('requisition_details.*', 'requisitions.requ_no', 'requisitions.requ_date', 'requisitions.remarks',
                'mast_item_categories.id as cat_id','mast_units.unit_name','mast_item_groups.id as item_group_id','mast_item_groups.part_name as part_name', 'mast_item_registers.id as item_register_id', 'mast_item_registers.part_no','mast_item_registers.box_qty')
        ->get();
        // dd($purchase_details);

        return response()->json([
            'tools'               => $tools,
            'compliant'           => $compliant,
            'requisition_details' => $requisition_details,
            'user_data'           => $user_data,

            // 'value'   => $value,

            // 'complaintt' => $complaintt,
            // 'customer' => $customer,
            // 'purchase_details' => $purchase_details,
        ]);
        
    }

    
    /**_____________________________________________________________________________
     * Spare Part Requisition
     * _____________________________________________________________________________
     */
    public function indexSparePart()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 2)->where('status', 1)->orderBy('part_name', 'asc')->get();
        $complaintt = Complaint::with('custo')->get();
        $customer = MastCustomer::where('status', 1)->get();

        return view('layouts.pages.warranty.spare_part.index' , compact('item_group','complaintt','customer'));
    }

    ///for tech id and name/////
    
    
}

   
