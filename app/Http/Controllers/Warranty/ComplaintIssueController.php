<?php

namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastCustomer;
use App\Models\deliverie;
use App\Models\Warranty\Complaint;
use App\Models\Master\MastComplaintType;
use App\Models\Inventory\Delivery;
use App\Helpers\Helper;
use Carbon\Carbon;

class ComplaintIssueController extends Controller
{
    public function index()
    {
        $data = Complaint::get();
        return view('layouts.pages.warranty.complaint.index',compact('data'));
    }
    public function showCustomerList()
    {
        $customer = MastCustomer::with('mastCustomerType')->orderBy('id', 'asc')->get();
        $compliantType = MastComplaintType::all();
        return view('layouts.pages.warranty.complaint.customer-list',compact('customer','compliantType'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mast_complaint_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $IDGenarator = Helper::IDGenerator(new Complaint,'issue_no', 5, "ISSUE");
        $data = new Complaint();
        $data->note = $request->note;
        $data->note = $request->note;
        $data->remarks = $request->remarks;
        $data->mast_complaint_type_id = $request->mast_complaint_type_id;
        $data->mast_customer_id = $request->mast_customer_id;
        $data->issue_date = date('y-m-d');
        $data->with_warranty = $request->warenty == 'Yes' ? 1 : 0 ;
        $data->issue_no = $IDGenarator;
        $data->user_id = Auth::user()->id;
        $data->save();

        return response()->json(['data' => $data]);
    }


    /**__________________________________________________________________________________
     * Ajax Call Data => Show
     * __________________________________________________________________________________
     */
    public function getCompliantData(Request $request)
    {
        $complaint = Complaint::with('mastCustomer')->with('compliantType')->where('id',$request->id)->first();
        return response()->json($complaint);
    }

    public function getCustomerDetails(Request $request)
    {
        $customer = MastCustomer::orderBy('name', 'asc')->where('id', $request->customer_id)->first();
        $getDelivary = Delivery::where('mast_customer_id', $request->customer_id)->get();

        $getDelivary = Delivery::where('deliveries.mast_customer_id', $request->customer_id)
        ->join('mast_item_registers', 'mast_item_registers.id', 'deliveries.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('sales', 'sales.id', 'deliveries.sales_id')
        ->select('deliveries.*','mast_item_registers.part_no','mast_item_groups.part_name','sales.inv_date')
        ->get();
        
        foreach ($getDelivary as $data) {
            $previousDate = Carbon::createFromFormat('Y-m-d', $data->deli_date);
            $todayDate = Carbon::today();
            
            if ($data->mastItemRegister && $data->mastItemRegister->warranty) {
                $total_day = $data->mastItemRegister->warranty * 30;
                $data['warranty_status'] = $todayDate->diffInDays($previousDate) <= $total_day ? 'Yes' : 'No';
            } else {
                $data['warranty_status'] = 'N/A';
            }
        }
        return response()->json([
            'customer' => $customer,
            'deliveries' => $getDelivary,
        ]);
    }



}
