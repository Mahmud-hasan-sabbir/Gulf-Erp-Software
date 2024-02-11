<?php

namespace App\Http\Controllers\Inventory;

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
use App\Models\Master\MastCustomerType;
use App\Models\Inventory\StoreTransfer;
use App\Models\Inventory\StoreTransferDetails;
use App\Models\SlMovement;
use App\Helpers\Helper;

class StoreTransferController extends Controller
{
    public function index($type)
    {
        $item_group = MastItemGroup::where('mast_item_category_id', $type)->orderBy('part_name', 'asc')->get();
        $store = MastWorkStation::where('status', 1)->orderBy('store_name', 'asc')->get();
        $item_category = MastItemCategory::where('status', 1)->get();
        
        $data=StoreTransfer::where('mast_item_category_id', $type)->where('mast_work_station_id', Auth::user()->mast_work_station_id)->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.inventory.store_transfer.index',compact('type','data','item_group','store','item_category'));
    }

    public function store(Request $request, $type)
    {
        $invoice_codes = Helper::IDGenerator(new StoreTransfer, 'inv_no', 5, 'INV-NO'); /* Generate id */
        
        $storeTransferId= $request->store_transfer_id;
        if(isset($storeTransferId)){
            $transferStore = StoreTransfer::findOrFail($storeTransferId);
        }else{
            $validator = Validator::make($request->all(), [
                'inv_date' => 'required',
                'from_store_id' => 'required',
                'mast_work_station_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $transferStore = new StoreTransfer();
            $transferStore->inv_no = $invoice_codes;
        }
        $transferStore->inv_date = $request->inv_date;
        $transferStore->remarks = $request->remarks;
        $transferStore->status = 0; // Pendding => 0 || In Stock => 1 || In Transit => Parsial-> 2, 3 || Receive => 4 || Cencel => 5
        $transferStore->mast_item_category_id = $type;
        $transferStore->from_store_id = $request->from_store_id;
        $transferStore->mast_work_station_id = $request->mast_work_station_id;
        $transferStore->user_id = Auth::user()->id;
        $transferStore->save();


        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){
                $data = new StoreTransferDetails();
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->deli_qty = 0;
                
                $data->status = 1;
                if(isset($storeTransferId)){
                    $data->store_transfer_id = $storeTransferId;
                }else{
                    $data->store_transfer_id = $transferStore->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        if (isset($request->editFile[0]['item_id']) && !empty($request->editFile[0]['item_id'])) {
            foreach($request->editFile as $item){
                $data = StoreTransferDetails::findOrFail($item['id']);

                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->deli_qty = 0;
                $data->status = 1;
                if(isset($storeTransferId)){
                    $data->store_transfer_id = $storeTransferId;
                }else{
                    $data->store_transfer_id = $sales->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }

        if(isset($storeTransferId)){
            $new_sales = StoreTransfer::where('id', $storeTransferId)->first();
        }else{
            $new_sales = StoreTransfer::where('id', $transferStore->id)->first();
        }
        $mastWorkStation = $new_sales->mastWorkStation;
        $mastItemCategory = $new_sales->mastItemCategory;
        $storeTransferDetails = $new_sales->storeTransferDetails;

        // $total = 0;
        $qty = 0;
        foreach ($storeTransferDetails as $key => $value) {
            // $total += $value->qty * $value->price;
            $qty += $value->qty;  
        }

        return response()->json([
            'transferStore' => $transferStore,
            'mastWorkStation' => $mastWorkStation,
            'mastItemCategory' => $mastItemCategory,
            'qty' => $qty,
        ]);
    }
    public function edit(Request $request)
    {
        $store_transfer = StoreTransferDetails::where('store_transfer_id', $request->id)
        ->join('mast_item_registers', 'mast_item_registers.id', 'store_transfer_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('store_transfers', 'store_transfers.id', 'store_transfer_details.store_transfer_id')
        ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')        
        ->select('store_transfer_details.*','mast_item_registers.id as item_rg_id','mast_item_registers.part_no','mast_item_registers.box_qty','mast_units.unit_name','mast_item_groups.part_name','mast_item_groups.id as item_groups_id')
        ->get();
        $store = MastWorkStation::where('status', 1)->orderBy('store_name', 'asc')->get();
        $data=StoreTransfer::where('id', $request->id)->first();
        return response()->json([
            'data' => $data,
            'store' => $store,
            'store_transfer' => $store_transfer,
        ]);
    }
    public function storeDetailsDestroy($id)
    {
        $data=StoreTransferDetails::find($id);
        $data->delete();
        return response()->json('success');
    }
    public function getSalesDetails(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return response()->json($data);
    }
    /*=====================================
     *   Approve Store Transfer
     *=====================================
     */
    function storeTransferApprove () {
        $data=StoreTransfer::where('status', 0)->where('from_store_id', Auth::user()->mast_work_station_id)->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.inventory.store_transfer.store_transfer_approve',compact('data'));
    }
    public function getStoreTransferApproveDetails(Request $request)
    {
        $data = StoreTransferDetails::where('store_transfer_details.store_transfer_id', $request->id)
        ->join('store_transfers', 'store_transfers.id', 'store_transfer_details.store_transfer_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'store_transfer_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'store_transfers.mast_item_category_id')
        ->select('store_transfer_details.*','store_transfers.inv_no','store_transfers.inv_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();

        $storeTransfer = StoreTransfer::where('store_transfers.id', $request->id)
        ->join('mast_item_categories', 'mast_item_categories.id', 'store_transfers.mast_item_category_id')
        ->join('mast_work_stations as from_station', 'from_station.id', 'store_transfers.from_store_id')
        ->join('mast_work_stations as to_station', 'to_station.id', 'store_transfers.mast_work_station_id')
        ->select('store_transfers.*', 'mast_item_categories.cat_name', 'from_station.store_name as from_store_name', 'to_station.store_name as to_store_name')
        ->first();

        return response()->json([
            'data' => $data,
            'storeTransfer' => $storeTransfer,
        ]);
    }

    public function approve($id)
    {
        $data = StoreTransfer::findOrFail($id);
        $data->status = 1; // Pendding => 0 || In Stock => 1 || In Transit => Parsial->2, 3 || Receive => 4 || Cencel => 5
        $data->save();

        $notification=array('messege'=>'Approve successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function decline($id){
        $data = StoreTransfer::findOrFail($id);
        $data->status = 5; // Pendding => 0 || In Stock => 1 || In Transit => Parsial->2, 3 || Receive => 4 || Cencel => 5
        $data->save();

        $notification=array('messege'=>'Canceled successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    public function receive($id){
        DB::beginTransaction();
        try {
            $deliveryCheck = SlMovement::where('reference_id', $id)->where('reference_type_id', 3)->count();
            //--- Store Transfer Update Status
            $data = StoreTransfer::findOrFail($id);
            $qty = 0;
            foreach ($data->storeTransferDetails as $key => $value) {
                $qty += $value->qty;
            }

            if($deliveryCheck == $qty){
                $data->status = 4;
            }
            $data->save();
        
            // Update the status of SlMovement objects
            $dataUpdate = SlMovement::where('reference_id', $id)->where('reference_type_id', 3)->get();
            foreach ($dataUpdate as $item) {
                $item->status = 1;
                $item->save();
            }

            DB::commit();
            $notification = array('message' => 'Canceled successfully!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while saving data: ' . $e->getMessage());
        }
    }
    
    /*=====================================
     *   Ajax Call Data Change
     *=====================================
     */
    public function getDeleteMaster(Request $request)
    {
        $data=StoreTransfer::find($request->id);
        $data->delete();
        return response()->json('success');
    }
}

