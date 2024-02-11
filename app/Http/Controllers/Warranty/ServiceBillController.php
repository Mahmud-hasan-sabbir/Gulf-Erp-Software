<?php

namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\JobCard;
use App\Models\Warranty\RequisitionDetails;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastCustomer;
use App\Helpers\Helper;
use App\Models\Warranty\ServiceBill;
use App\Models\Warranty\ServiceBillDetails;
use Validator;
use Auth;
use App\Models\Setup;
use App\Models\Admin\InfoPersonal;
use App\Models\User;

class ServiceBillController extends Controller
{
    public function index()
    {
        $customer = MastCustomer::where('status', 1)->get();
        $service = Complaint::with('custo')->get();
        $bill    = JobCard::all();
        $details = RequisitionDetails::with('mastItemRegister',)->with('mastItemRegister.unit')->with('mastItemRegister.mastItemGroup')->get();
        // dd($details);

        ///for tech name////
        $setup = setup::first();
        $technicianId = Setup::first();
        $employ_id = InfoPersonal::where('mast_designation_id', $technicianId->services_technician)->pluck('emp_id');
        $tecnicianName = User::whereNotIn('id', $employ_id)->get();

        $technician = InfoPersonal::with('user')->with('mastDepartment')->with('mastDesignation')->where('mast_designation_id', $technicianId->services_technician)->get();
        // dd($technician);

        return view('layouts.pages.warranty.service_bill.index', compact('service','bill','details','customer','setup','technicianId','employ_id','tecnicianName','technician'));
    }
    public function getBill(Request $request)
    {
        $services = Complaint::where('id', $request->id)->get();
        dd($services);
        return response()->json([
            'services' => $services,
        ]);
    }


    public function storeBill(Request $request, $type)
    {
        // $purchase_codes = Helper::IDGenerator(new ServiceBill, 'inv_no', 5, 'INV-NO'); /* Generate id */
     

        $pur_id=$request->pur_id;
        if(isset($pur_id)){
            $storePurchase = ServiceBill::findOrFail($pur_id);
        }else{
            $validator = Validator::make($request->all(), [
                'inv_date' => 'required',
                'mast_supplier_id' => 'required',
                'mast_work_station_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $storePurchase = new ServiceBill();
            // $storePurchase->inv_no = $purchase_codes;
        }
        $storePurchase->inv_date = $request->inv_date;
        $storePurchase->remarks = $request->remarks;
        $storePurchase->status = 0;
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){
                $data = new ServiceBillDetails();
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;
                $data->price = $item['price'];

                $data->status = 1;
                if(isset($pur_id)){
                    $data->purchase_id = $pur_id;
                }else{
                    $data->purchase_id = $storePurchase->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        if (isset($request->editFile[0]['item_id']) && !empty($request->editFile[0]['item_id'])) {
            foreach($request->editFile as $item){
                $data = ServiceBillDetails::findOrFail($item['id']);

                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;
                $data->price = $item['price'];

                $data->status = 1;
                if(isset($pur_id)){
                    $data->purchase_id = $pur_id;
                }else{
                    $data->purchase_id = $storePurchase->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        if(isset($pur_id)){
            $purchase = ServiceBill::where('id', $pur_id)->first();
        }else{
            $purchase = ServiceBill::where('id', $storePurchase->id)->first();
        }
        $mastWorkStation = $purchase->mastWorkStation;
        $mastSupplier = $purchase->mastSupplier;
        $purchaseDetails = $purchase->purchaseDetails;

        $total = 0;
        foreach ($purchaseDetails as $key => $value) {
            $total += $value->qty * $value->price;
        }

        return response()->json([
            'storePurchase' => $storePurchase,
            'purchase' => $purchase,
            'mastWorkStation' => $mastWorkStation,
            'mastSupplier' => $mastSupplier,
            'total' => $total,
        ]);
    }

    public function calculateTotal(Request $request)
    {
        $quantity = floatval($request->input('qty'));
        $price = floatval($request->input('price'));
        
        $total = $quantity * $price;
        
        return response()->json(['total' => number_format($total, 2)]);
    }
}
