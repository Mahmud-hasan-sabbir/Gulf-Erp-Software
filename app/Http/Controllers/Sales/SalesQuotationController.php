<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastCustomerType;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Models\Sales\Quotation;
use App\Models\Sales\QuotationDetails;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberApproved;

class SalesQuotationController extends Controller
{
    public function index($type)
    {   
        $item_group = MastItemGroup::where('mast_item_category_id', $type)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->where('mast_customer_type_id', $type)->get();
        $customer_type = MastCustomerType::where('status', 1)->get();
        $item_category = MastItemCategory::where('status', 1)->get();
        
        $data=Quotation::where('mast_item_category_id', $type)->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.sales.sales_quotation.index',compact('type','data','item_group','customer','customer_type','item_category'));
    }
    public function store(Request $request, $type)
    {
        DB::beginTransaction();

        try {
            $invoice_codes = Helper::IDGenerator(new Quotation, 'quot_no', 5, 'GIAL'); /* Generate id */

            $sal_id = $request->sal_id;
            if (isset($sal_id)) {
                $sales = Quotation::findOrFail($sal_id);
            } else {
                $validator = Validator::make($request->all(), [
                    'inv_date' => 'required',
                    'mast_customer_id' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                $sales = new Quotation();
                $sales->quot_no = $invoice_codes;
            }

            $sales->quot_date = $request->inv_date;
            $sales->vat = $request->vat;
            $sales->tax = $request->tax;
            $sales->remarks = $request->remarks;
            $sales->status = 0;
            $sales->is_sales = 0;
            $sales->mast_item_category_id = $type;
            $sales->mast_customer_id = $request->mast_customer_id;
            $sales->user_id = Auth::user()->id;
            $sales->save();

            if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
                foreach ($request->moreFile as $item) {
                    $data = new QuotationDetails();
                    $data->mast_item_register_id = $item['item_id'];
                    $data->mast_item_category_id = $sales->mast_item_category_id;
                    $data->qty = $item['qty'];
                    $data->status = 0;
                    $data->price = $item['price'];

                    $data->status = 1;
                    if (isset($sal_id)) {
                        $data->quotation_id = $sal_id;
                    } else {
                        $data->quotation_id = $sales->id;
                    }
                    $data->user_id = Auth::user()->id;
                    $data->save();
                }
            }

            if (isset($request->editFile[0]['item_id']) && !empty($request->editFile[0]['item_id'])) {
                foreach ($request->editFile as $item) {
                    $data = QuotationDetails::findOrFail($item['id']);

                    $data->mast_item_register_id = $item['item_id'];
                    $data->mast_item_category_id = $sales->mast_item_category_id;
                    $data->qty = $item['qty'];
                    $data->price = $item['price'];
                    $data->status = 0;
                    if (isset($sal_id)) {
                        $data->quotation_id = $sal_id;
                    } else {
                        $data->quotation_id = $sales->id;
                    }
                    $data->user_id = Auth::user()->id;
                    $data->save();
                }
            }

            if (isset($sal_id)) {
                $new_sales = Quotation::where('id', $sal_id)->first();
            } else {
                $new_sales = Quotation::where('id', $sales->id)->first();
            }
            $mastCustomer = $new_sales->mastCustomer;
            $mastItemCategory = $new_sales->mastItemCategory;
            $quotationDetails = $new_sales->quotationDetails;

            $total = 0;
            foreach ($quotationDetails as $key => $value) {
                $total += $value->qty * $value->price;
            }

            // Mail Send
            $mailData = [
                'title' => 'Sales Quotation',
                'body' => 'This Is body',
            ];
            Mail::to($new_sales->mastCustomer->email)->send(new MemberApproved($mailData));
            
            // Commit the transaction if everything is successful
            DB::commit();

            return response()->json([
                'sales' => $sales,
                'mastCustomer' => $mastCustomer,
                'mastItemCategory' => $mastItemCategory,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            // Handle any unexpected exceptions here
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function edit(Request $request)
    {
        $sales_details = QuotationDetails::where('quotation_id', $request->id)
        ->join('mast_item_registers', 'mast_item_registers.id', 'quotation_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('quotations', 'quotations.id', 'quotation_details.quotation_id')
        ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')        
        ->select('quotation_details.*','mast_item_registers.id as item_rg_id','mast_item_registers.part_no','mast_item_registers.box_qty','mast_units.unit_name','mast_item_groups.part_name','mast_item_groups.id as item_groups_id')
        ->get();
        
        $customer_type = MastCustomerType::where('status', 1)->get();
        $customer_type_id = Quotation::where('quotations.id', $request->id)
        ->join('mast_customers', 'mast_customers.id', 'quotations.mast_customer_id')
        ->join('mast_customer_types', 'mast_customer_types.id', 'mast_customers.mast_customer_type_id')
        ->select('mast_customer_types.id')
        ->first();
        $customer = MastCustomer::where('status', 1)->where('mast_customer_type_id', $customer_type_id->id)->get();
        
        $data=Quotation::where('id', $request->id)->first();
        return response()->json([
            'data' => $data,
            'customer' => $customer,
            'customer_type' => $customer_type,
            'customer_type_id' => $customer_type_id,
            'sales_details' => $sales_details,
        ]);
    }
    public function quotation_destroy($id)
    {
        $data=Quotation::find($id);
        // $subTotal = $data->qty*$data->price;
        $data->delete();
        // return response()->json($subTotal);
        return response()->json('success');
    }
    /*=====================================
     *   Approve Sales
     *=====================================
     */
    function quotation_approve_list () {
        $data= Quotation::where('status', 0)->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.sales.sales_quotation.quotation_approve',compact('data'));
    }
    public function getQuotationDetails(Request $request)
    {
        $data = QuotationDetails::where('quotation_details.quotation_id', $request->id)
        ->join('quotations', 'quotations.id', 'quotation_details.quotation_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'quotation_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'quotations.mast_item_category_id')
        ->select('quotation_details.*','quotations.quot_no','quotations.quot_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();

        $store = MastWorkStation::where('id', Auth::user()->id)->first();
        $quotation = Quotation::where('quotations.id', $request->id)
        ->join('mast_customers', 'mast_customers.id', 'quotations.mast_customer_id')
        ->select('quotations.*','mast_customers.name')
        ->first();
        return response()->json([
            'data' => $data,
            'quotation' => $quotation,
            'store' => $store->store_name,
        ]);
    }
    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ref_date' => 'required',
            'ref_no' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quotation = Quotation::findOrFail($request->set_id);
        $quotation->is_sales = 1;
        $quotation->status = 1;
        $quotation->save();

        $sales = new Sales();
        $sales->inv_date = date('Y-m-d');
        $sales->inv_no = $quotation->quot_no;
        $sales->ref_date = $request->ref_date;
        $sales->ref_no = $request->ref_no;
        $sales->vat = $quotation->vat;
        $sales->tax = $quotation->tax;
        $sales->remarks = $quotation->remarks;
        $sales->quotation_id = $quotation->id;
        $sales->mast_item_category_id = $quotation->mast_item_category_id;
        $sales->mast_customer_id = $quotation->mast_customer_id;
        $sales->user_id = Auth::user()->id;
        $sales->status = 1;
        $sales->save();

        $salesDetails = QuotationDetails::where('quotation_id', $request->set_id)->get();
        foreach ($salesDetails as $item) {
            $data = new SalesDetails();
            $data->mast_item_register_id = $item['mast_item_register_id'];
            $data->mast_item_category_id = $sales->mast_item_category_id;
            $data->price = $item['price'];
            $data->qty = $item['qty'];
            $data->deli_qty = 0;
            $data->status = 1;
            $data->sales_id = $sales->id;
            $data->user_id = Auth::user()->id;
            $data->save();
        }

        //Mail Send
        $mailData =[
            'title' => 'Your work order approve successfully',
            'body' => 'This Is body',
        ];
        Mail::to($quotation->mastCustomer->email)->send(new MemberApproved($mailData));

        return response()->json($quotation);
    }


    public function decline($id){
        $data = Quotation::findOrFail($id);
        $data->status = 2;
        $data->save();

        $notification=array('messege'=>'Canceled successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    

    //-----------------------------------------
    public function getCustomerData(Request $request)
    {
        $data = MastCustomer::where('status', 1)->where('mast_customer_type_id', $request->part_id)->get();
        return view('layouts.pages.sales.sales.load-customer',compact('data'));
    }
    public function getDeleteMaster(Request $request)
    {
        $data=Quotation::find($request->id);
        $data->delete();
        return response()->json('success');
    }
}
