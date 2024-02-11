<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastDesignation;
use Auth;

class MastDesignationController extends Controller
{
    public function index() {
        $designation = MastDesignation::latest()->get();
        return view('layouts.pages.master.designation.index', compact('designation'));
    }

    public function create() {
        return view('layouts.pages.master.designation.create');
    }

    public function store(Request $request)
    {
        $validated=$request -> validate([
            'desig_name'=> 'required|max:255',
            'status'=> 'required',
        ]);

        $data = new MastDesignation();
        $data->desig_name =$request->desig_name;
        $data->description =$request->description;
        $data->user_id = Auth::user()->id;
        $data->status =$request->status;
        $data->save();
        $notification=array('messege'=>'Designation data save successfully.','alert-type'=>'success');
        return redirect()->route('mast_designation.index')->with($notification);
    }

    public function edit($id)
    {
        $data = MastDesignation::find($id);
        return view('layouts.pages.master.designation.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastDesignation::find($id);
        $data->desig_name =$request->desig_name;
        $data->description =$request->description;
        $data->user_id = Auth::user()->id;
        $data->status =$request->status;
        $data->save();
        $notification = array('messege' => 'Designation data update successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_designation.index')->with($notification);
    }

    public function show( $id)
    {
        $data = MastDesignation::find($id);
        return view('layouts.pages.master.designation.show', compact('data'));
    }
}
