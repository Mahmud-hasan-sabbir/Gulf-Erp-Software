<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\InfoOther;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::findOrFail(Auth::user()->id);
        $infoPersonal = $user->infoPersonal;
        $infoFamily = $user->infoFamily;
        $infoAcademic = $user->infoAcademic;
        $infoOther = $user->infoOther;

        return view('profile.show', compact('user','infoPersonal','infoFamily','infoAcademic','infoOther'));
    }
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'batch' => $request->batch,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
        ]);

        // if($request->has('password')){
        //     $user->update(['password' => bcrypt('password')]);
        // }

        $notification=array('messege'=>'User data updated!','alert-type'=>'success');
        return back()->with($notification);
    }
    /*________________________________________ */
    public function info_other_update(Request $request, InfoOther $id)
    {
        $id->update([
            // 'designation'=> $request->designation,
            // 'company_name'=> $request->company_name,
            'about_me'=> $request->about_me,
            // 'nick_name'=> $request->nick_name,
            // 'phone_number'=> $request->phone_number,
            // 'cover_photo'=> $request->cover_photo,
            // 'favorite'=> $request->favorite,

            'facebook_url'=> $request->facebook_url,
            'youtube_url'=> $request->youtube_url,
            'instagram_url'=> $request->instagram_url,
            'twitter_url'=> $request->twitter_url,
            'linkedin_url'=> $request->linkedin_url,
        ]);
        
        $notification=array('messege'=>'Personal information updated!','alert-type'=>'success');
        return back()->with($notification);
    }
    
}
