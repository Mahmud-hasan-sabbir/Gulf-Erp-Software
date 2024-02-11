<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\MastDepartment;

use App\Models\User;
use Auth;

class MastDepartmentController extends Controller
{
    public function index() {
        $department = MastDepartment::latest()->with('user')->get();
        return view('layouts.pages.master.department.index', compact('department'));
    }

    public function create() {
        $data =User::orderBy('id','DESC')->where('status', 1)->get();
        return view('layouts.pages.master.department.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validated=$request -> validate([
            'dept_name'=> 'required|max:255',
            'dept_head'=> 'required',
            'status'=> 'required',
        ]);

        $data = new MastDepartment();
        $data->dept_name = $request->dept_name;
        $data->dept_head = $request->dept_head;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Department save successfully.', 'alert-type' => 'success');
        return redirect()->route('mast_department.index')->with($notification);
    }

    public function edit($id)
    {
        $data = MastDepartment::find($id);
        $users = User::latest()->get();
        return view('layouts.pages.master.department.edit', compact('data', 'users'));
    }
    
    public function update(Request $request, $id)
    {
        $data = MastDepartment::find($id);
        $data->dept_name = $request->dept_name;
        $data->dept_head = $request->dept_head;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        $data->save();
        $notification = array('messege' => 'Department data update successfully.', 'alert-type' => 'success');        
        return redirect()->route('mast_department.index')->with($notification);
    }
    public function show( $id)
    {
        $data = MastDepartment::with('user')->find($id);
        $data = MastDepartment::find($id);
        return view('layouts.pages.master.department.show', compact('data'));
    }

}
