<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastCustomerType;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Helpers\Helper;

class SalesController extends Controller
{
    public function index($type)
    {   
        $item_group = MastItemGroup::where('mast_item_category_id', $type)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->where('mast_customer_type_id', $type)->get();
        $customer_type = MastCustomerType::where('status', 1)->get();
        $item_category = MastItemCategory::where('status', 1)->get();
        
        $data=Sales::where('mast_item_category_id', $type)->where('quotation_id', null)->orderBy('id', 'desc')->latest()->get();
        $quotation=Sales::where('mast_item_category_id', $type)->where('quotation_id', '!=', null)->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.sales.sales.index',compact('type','data', 'quotation','item_group','customer','customer_type','item_category'));
    }
    public function store(Request $request, $type)
    {
        $invoice_codes = Helper::IDGenerator(new Sales, 'inv_no', 5, 'INV-NO'); /* Generate id */
        
        $sal_id=$request->sal_id;
        if(isset($sal_id)){
            $sales = Sales::findOrFail($sal_id);
        }else{
            $validator = Validator::make($request->all(), [
                'inv_date' => 'required',
                'mast_customer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $sales = new Sales();
            $sales->inv_no = $invoice_codes;
        }
        $sales->inv_date = $request->inv_date;
        $sales->vat = $request->vat;
        $sales->tax = $request->tax;
        $sales->remarks = $request->remarks;
        $sales->status = 0;
        $sales->mast_item_category_id = $type;
        $sales->mast_customer_id = $request->mast_customer_id;
        $sales->user_id = Auth::user()->id;
        $sales->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){
                $data = new SalesDetails();
                $data->mast_item_register_id = $item['item_id'];
                $data->mast_item_category_id = $sales->mast_item_category_id;
                $data->qty = $item['qty'];
                $data->deli_qty = 0;
                $data->status = 0;
                $data->price = $item['price'];
                
                $data->status = 1;
                if(isset($sal_id)){
                    $data->sales_id = $sal_id;
                }else{
                    $data->sales_id = $sales->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        if (isset($request->editFile[0]['item_id']) && !empty($request->editFile[0]['item_id'])) {
            foreach($request->editFile as $item){
                $data = SalesDetails::findOrFail($item['id']);
                $data->mast_item_register_id = $item['item_id'];
                $data->mast_item_category_id = $sales->mast_item_category_id;
                $data->qty = $item['qty'];
                $data->deli_qty = 0;
                $data->price = $item['price'];
                $data->status = 0;
                if(isset($sal_id)){
                    $data->sales_id = $sal_id;
                }else{
                    $data->sales_id = $sales->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }

        if(isset($sal_id)){
            $new_sales = Sales::where('id', $sal_id)->first();
        }else{
            $new_sales = Sales::where('id', $sales->id)->first();
        }
        $mastCustomer = $new_sales->mastCustomer;
        $mastItemCategory = $new_sales->mastItemCategory;
        $salesDetails = $new_sales->salesDetails;

        $total = 0;
        foreach ($salesDetails as $key => $value) {
            $total += $value->qty * $value->price;
        }

        return response()->json([
            'sales' => $sales,
            'mastCustomer' => $mastCustomer,
            'mastItemCategory' => $mastItemCategory,
            'total' => $total,
        ]);
    }
    public function edit(Request $request)
    {
        $sales_details = SalesDetails::where('sales_id', $request->id)
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')        
        ->select('sales_details.*','mast_item_registers.id as item_rg_id','mast_item_registers.part_no','mast_item_registers.box_qty','mast_units.unit_name','mast_item_groups.part_name','mast_item_groups.id as item_groups_id')
        ->get();
        
        $customer_type = MastCustomerType::where('status', 1)->get();
        $customer_type_id = Sales::where('sales.id', $request->id)
        ->join('mast_customers', 'mast_customers.id', 'sales.mast_customer_id')
        ->join('mast_customer_types', 'mast_customer_types.id', 'mast_customers.mast_customer_type_id')
        ->select('mast_customer_types.id')
        ->first();
        $customer = MastCustomer::where('status', 1)->where('mast_customer_type_id', $customer_type_id->id)->get();
        
        $data=Sales::where('id', $request->id)->first();
        return response()->json([
            'data' => $data,
            'customer' => $customer,
            'customer_type' => $customer_type,
            'customer_type_id' => $customer_type_id,
            'sales_details' => $sales_details,
        ]);
    }
    public function sales_destroy($id)
    {
        $data=SalesDetails::find($id);
        // $subTotal = $data->qty*$data->price;
        $data->delete();
        // return response()->json($subTotal);
        return response()->json('success');
    }
    /*=====================================
     *   Approve Sales
     *=====================================
     */
    function sales_approve_list () {
        $data=Sales::where('status', 0)->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.sales.sales.sales_approve',compact('data'));
    }
    public function getSalesApproveDetails(Request $request)
    {
        $data = SalesDetails::where('sales_details.sales_id', $request->id)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->select('sales_details.*','sales.inv_no','sales.inv_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();

        $store = MastWorkStation::where('id', Auth::user()->id)->first();
        $sales = Sales::where('sales.id', $request->id)
        ->join('mast_customers', 'mast_customers.id', 'sales.mast_customer_id')
        ->select('sales.*','mast_customers.name')
        ->first();
        return response()->json([
            'data' => $data,
            'sales' => $sales,
            'store' => $store->store_name,
        ]);
    }
    public function approve($id)
    {
        $data = Sales::findOrFail($id);
        $data->status = 1;
        $data->save();

        $notification=array('messege'=>'Leave approve successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function decline($id){
        $data = Sales::findOrFail($id);
        $data->status = 2;
        $data->save();

        $notification=array('messege'=>'Canceled successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    /*=====================================
     *   Customer
     *=====================================
     */
    public function indexCustomer($type)
    {
        $distributorList = MastCustomer::where('mast_customer_type_id', $type)->get();
        return view('layouts.pages.master.customer.index',compact('distributorList','type'));
    }

    public function createCustomer($type)
    {
        return view('layouts.pages.master.customer.create',compact('type'));
    }

    public function storeCustomer(Request $request)
    {
        $validated=$request -> validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $data = new MastCustomer();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->cont_designation = $request->cont_designation;
        $data->cont_person = $request->cont_person;
        $data->cont_phone = $request->cont_phone;
        $data->cont_email = $request->cont_email;
        $data->web_address = $request->web_address;
        $data->credit_limit = $request->credit_limit;
        $data->remarks = $request->remarks;
        $data->mast_customer_type_id = $request->mast_customer_type_id;
        $data->status = 1;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Distributor create save successfully.', 'alert-type' => 'success');
        return redirect()->route("customer.index", ['cat_id' => $request->mast_customer_type_id])->with($notification);
    }


    //-----------------------------------------
    public function getDeleteMaster(Request $request)
    {
        $data=Sales::find($request->id);
        $data->delete();
        return response()->json('success');
    }
}
