<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarcodeExport;
use App\Exports\ItemExport;
use PDF;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastSupplier;
use App\Models\Inventory\Purchase;
use App\Models\Inventory\PurchaseDetails;
use App\Models\Inventory\StoreTransfer;
use App\Models\Inventory\StoreTransferDetails;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Models\SlMovement;
use App\Models\User;
use App\Helpers\Helper;

class ReportsController extends Controller
{
    /**___________________________________________________________________
     * Inventory => Report
     * ___________________________________________________________________
     */
    //--------- Purchase Receive
    public function parsialPurchaseDetails(){
        $data = Purchase::where('status', 4)->whereIn('is_parsial', [0, 1])->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.reports.purchase-recived',compact('data'));
    }
    public function generatePurchaseReceive($id){
        $purchase = Purchase::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 1)
        ->join('purchases', 'purchases.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'))->setPaper('a4', 'portrait');
        return $pdf->download('Purchase-Receive.pdf');
        // return view('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'));
    }
    public function generatePurchaseReceiveDetails($date, $id){
        $purchase = Purchase::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 1)->whereDate('sl_movements.created_at', $date)
        ->join('purchases', 'purchases.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'))->setPaper('a4', 'portrait');
        return $pdf->download($date . '.pdf');
        // return view('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'));
    }
    
    //--------Sales Delivery
    public function salesDeliveryDetails(){
        $data= Sales::where('status', 4)->whereIn('is_parsial', [0, 1])->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.reports.sales-delivery',compact('data'));
    }
    public function generateSalesDelivery($id){
        $purchase = Sales::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 2)
        ->join('sales', 'sales.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-sales-delivery', compact('purchase','data'))->setPaper('a4', 'portrait');
        return $pdf->download('Sales-Delivery.pdf');
        // return view('layouts.pages.export.parsial-sales-delivery', compact('purchase','data'));
    }
    public function generateSalesDeliveryDetails($date, $id){
        $purchase = Sales::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 2)->whereDate('sl_movements.created_at', $date)
        ->join('sales', 'sales.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-sales-delivery', compact('purchase','data'))->setPaper('a4', 'portrait');
        return $pdf->download($date . '.pdf');
        // return view('layouts.pages.export.parsial-sales-delivery', compact('purchase','data'));
    }
    //--------Store Delivery
    public function storeDelivery(){
        $data= StoreTransfer::where('status', 3)->whereIn('is_parsial', [0, 1])->where('from_store_id', Auth::user()->mast_work_station_id)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.reports.requstion-delivery',compact('data'));
    }
    public function generateStoreDelivery($id){
        $storeTransfer = StoreTransfer::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 3)
        ->join('store_transfers', 'store_transfers.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-store-delivery', compact('storeTransfer','data'))->setPaper('a4', 'portrait');
        return $pdf->download('Store-Delivery.pdf');
        // return view('layouts.pages.export.parsial-store-delivery', compact('storeTransfer','data'));
    }
    public function generateStoreDeliveryDetails($date, $id){
        $storeTransfer = StoreTransfer::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 3)->whereDate('sl_movements.created_at', $date)
        ->join('store_transfers', 'store_transfers.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-store-delivery', compact('storeTransfer','data'))->setPaper('a4', 'portrait');
        return $pdf->download($date . '.pdf');
        // return view('layouts.pages.export.parsial-store-delivery', compact('storeTransfer','data'));
    }
    /**___________________________________________________________________
     * Sales
     * ___________________________________________________________________
     */



     
    /**___________________________________________________________________
     * Dwonload File, Excel, Pdf
     * ___________________________________________________________________
     */
    
    
    
    
}
