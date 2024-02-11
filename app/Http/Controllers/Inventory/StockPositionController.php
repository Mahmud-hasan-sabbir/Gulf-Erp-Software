<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastSupplier;
use App\Models\SlMovement;

class StockPositionController extends Controller
{
    public function index(){
        $category = MastItemCategory::where('status', 1)->get();
        $store = MastWorkStation::where('status', 1)->get();

        $data = DB::table('mast_item_categories')
        ->join('mast_item_groups', 'mast_item_categories.id', '=', 'mast_item_groups.mast_item_category_id')
        ->join('mast_item_registers', 'mast_item_groups.id', '=', 'mast_item_registers.mast_item_group_id')
        ->where('mast_item_categories.id', 1)
        ->select('mast_item_registers.*', 'mast_item_groups.part_name')
        ->get();


        return view('layouts.pages.inventory.stock_position.index',compact('category', 'store', 'data'));
    }
}
