<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastCustomer;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Models\Sales\SalesReturn;
use App\Models\Sales\SalesReturnDetails;
use App\Models\SlMovement;
use App\Helpers\Helper;

class SalesReturnController extends Controller
{
    function index() {
        $data = Sales::whereIn('status', [3,4])->whereIn('is_parsial', [0,1])->orderBy('id', 'asc')->get();
        return view('layouts.pages.sales.sales_return.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->has('moreFile') && is_array($request->moreFile) || $request->has('editFile') && is_array($request->editFile)) {
                $return_no = Helper::IDGenerator(new SalesReturn, 'return_no', 5, 'RT-NO'); /* Generate id */

                if ($request->sales_return_id) {
                    $salesReturn = SalesReturn::findOrFail($request->sales_return_id);
                } else {
                    $salesReturn = new SalesReturn();
                    $salesReturn->return_no = $return_no;
                }
                $salesReturn->return_date = date('Y-m-d');
                $salesReturn->remarks = $request->remarks;
                $salesReturn->sales_id = $request->sales_id;
                $salesReturn->mast_work_station_id = Auth::user()->mast_work_station_id;
                $salesReturn->status = 0;
                $salesReturn->user_id = Auth::user()->id;
                $salesReturn->save();

                $salesUpdate = Sales::findOrFail($request->sales_id);
                $salesUpdate->is_return = 1;
                $salesUpdate->save();

                if (!empty($request->moreFile) && is_array($request->moreFile)) {
                    foreach ($request->moreFile as $item) {
                        if (isset($item['qty']) && is_numeric($item['qty'])) {
                            $data = new SalesReturnDetails();
                            $data->sales_return_id = $salesReturn->id;
                            $data->price = $item['price'];
                            $data->qty = $item['qty'];
                            $data->rcv_qty = 0;
                            $data->mast_item_register_id = $item['mast_item_register_id'];
                            $data->status = 1;
                            $data->user_id = Auth::user()->id;
                            $data->save();
                        }
                    }
                }

                if (!empty($request->editFile) && is_array($request->editFile)) {
                    foreach ($request->editFile as $i => $item) {
                        if (isset($item['qty']) && is_numeric($item['qty'])) {
                            $data = SalesReturnDetails::find($item['id']);
                            $data->sales_return_id = $salesReturn->id;
                            $data->price = $item['price'];
                            $data->qty = $item['qty'];
                            $data->rcv_qty = 0;
                            $data->mast_item_register_id = $item['mast_item_register_id'];
                            $data->status = 1;
                            $data->user_id = Auth::user()->id;
                            $data->save();
                        }
                    }
                }

                return response()->json([
                    'data' => $data,
                    'salesReturn' => $salesReturn,
                ]);
            } else {
                // Handle empty or missing moreFile data, for example:
                return response()->json(['error' => 'No data to save.']);
            }
        } catch (\Exception $e) {
            // Handle any exception that might occur during the save process.
            return response()->json(['error' => 'An error occurred while saving the data.']);
        }
    }

    /**___________________________________________________________________
     * Ajax Get Data & Show
     * ___________________________________________________________________
     */
    function getSalesDeliveryDetails(Request $request) {

        $data = SalesDetails::where('sales_details.sales_id', $request->id)->where('sales_details.deli_qty', '!=', 0)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->select('sales_details.*','sales.inv_no','sales.inv_date','mast_item_registers.part_no', 'mast_item_groups.part_name','mast_item_categories.cat_name')
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
    function getReturnDetailsCheck(Request $request) {
        $dataCheck = SalesReturnDetails::where('mast_item_register_id', $request->id)
            ->where('sales_return_id', $request->sales_return_id)
            ->first();
    
        return response()->json($dataCheck);
    }
}
