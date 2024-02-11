<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemModels;

class MastItemModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastItemModels::latest()->get();
      
        return view('layouts.pages.master.ac_models.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemGroup =MastItemGroup::where('status', 1)->where('mast_item_category_id', 1)->orderBy('part_name', 'asc')->get();
        return view('layouts.pages.master.ac_models.create', compact('itemGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request -> validate([
            'ton'=> 'required|max:255',
            'coling_capacity'=> 'required|max:255',
            'indoor'=> 'required|max:255',
            'outdoor'=> 'required|max:255',
        ]);

        $data = new MastItemModels();   
        $data->ton = $request->ton;
        $data->coling_capacity = $request->coling_capacity;
        $data->indoor = $request->indoor;
        $data->outdoor = $request->outdoor;
        $data->full_set = $request->full_set;
        $data->mast_item_group_id = $request->mast_item_group_id;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_models.index', compact('data'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemGroup =MastItemGroup::where('status', 1)->where('mast_item_category_id', 1)->orderBy('part_name', 'asc')->get();
        
        $data = MastItemModels::find($id);
        return view('layouts.pages.master.ac_models.show', compact('data','itemGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemGroup =MastItemGroup::where('status', 1)->where('mast_item_category_id', 1)->orderBy('part_name', 'asc')->get();

        $data = MastItemModels::find($id);
        return view('layouts.pages.master.ac_models.edit', compact('data','itemGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MastItemModels::find($id);
        $data->ton = $request->ton;
        $data->coling_capacity = $request->coling_capacity;
        $data->indoor = $request->indoor;
        $data->outdoor = $request->outdoor;
        $data->full_set = $request->full_set;
        $data->mast_item_group_id = $request->mast_item_group_id;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Data update successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_models.index', compact('data'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
