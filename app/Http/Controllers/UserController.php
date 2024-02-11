<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use App\Models\Admin\Contact;
use DB;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:User access'])->only(['index']);
        $this->middleware(['permission:User create'])->only(['create']);
        $this->middleware(['permission:User edit'])->only(['edit']);
        $this->middleware(['permission:User delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->get();
        $inactiveUsers = $data->where('status', false)->count();
        $admin = $data->where('is_admin', true)->count();
        $customers = $data->where('is_admin', false)->count();

        $userData = ['customers' => $customers, 'admin' => $admin, 'inactive' => $inactiveUsers];
        $users = User::with('roles')->latest()->paginate(20);

        return view('user.index', compact(['users', 'userData']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_if(!auth()->user()->can('create user'), 403);

        $roles = Role::latest()->get();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
            'profile_photo_path' => 'image|mimes:jpg,png,jpeg,gif,svg'
            // 'student_image' =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();
        request()->student_image->move(public_path('profile'), $file_name);

        $user = User::create([
            'name' => $request->name,
            'batch' => $request->batch,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'profile_photo_path' => $file_name,

            'email_verified_at' => '2023-01-01',
            'is_admin' => '1',
            'pune_member' => '1',
        ]);

        $user->syncRoles($request->roles);

        $notification=array('messege'=>'User created successfully!','alert-type'=>'success');
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        $data = $user->roles()->pluck('id')->toArray();
        return view('user.edit', compact(['user', 'roles', 'data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => "required|email|unique:users,email,$user->id",
        ]);


        if($request->hasFile("profile_photo_path")){
            if (File::exists("public/profile/".$user->profile_photo_path)) {
                File::delete("public/profile/".$user->profile_photo_path);
            }
            $file=$request->file("profile_photo_path");
            $user->profile_photo_path=time()."_".$file->getClientOriginalName();
            $file->move(\public_path("/profile"),$user->profile_photo_path);
            $request['profile_photo_path']=$user->profile_photo_path;
        }

        $user->update([
            'name' => $request->name,
            'batch' => $request->batch,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'status' => $request->status,
            'cm_adviser' => $request->cm_adviser,
            'cm_ecommittee' => $request->cm_ecommittee,
            'cm_welfare' => $request->cm_welfare,
            'profile_photo_path' => $user->profile_photo_path,
        ]);

        $user->syncRoles($request->roles);

        // if($request->has('password')){
        //     $user->update(['password' => bcrypt('password')]);
        // }

        $notification=array('messege'=>'User data updated!','alert-type'=>'success');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $notification=array('messege'=>'Delete user successfully!','alert-type'=>'success');
        return back()->with($notification);
    }
}
