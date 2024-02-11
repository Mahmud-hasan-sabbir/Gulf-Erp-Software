<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastItemCategory;
use Auth;

class MastItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MastItemCategory::latest()->get();
        return view('layouts.pages.master.item_category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.master.item_category.create');
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
            'cat_name'=> 'required|max:255',
        ]);
        $data = new MastItemCategory();
        $data->cat_name = $request->cat_name;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Item Category data save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_category.index', compact('data'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MastItemCategory::find($id);
        return view('layouts.pages.master.item_category.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MastItemCategory::find($id);
        return view('layouts.pages.master.item_category.edit', compact('data'));
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
        
        $data = MastItemCategory::find($id);
        $data->cat_name = $request->cat_name;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Item Category data update successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_item_category.index', compact('data'))->with($notification);
        
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
