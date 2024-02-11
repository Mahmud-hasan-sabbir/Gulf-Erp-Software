<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Admin\InfoPersonal;
use App\Models\Admin\InfoEducational;
use App\Models\Admin\InfoWorkExperience;
use App\Models\Admin\InfoBank;
use App\Models\Admin\InfoNominee;
use App\Models\Admin\SalaryStructure;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastEmployeeType;
use App\Models\Master\MastWorkStation;
use App\Models\User;
use App\Helpers\Helper;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class InfoEmployeeController extends Controller
{
    /**___________________________________________________________________
     * Employee List
     * ____________________________________________________________________
     */
    public function employee_list()
    {
        $user = User::whereNotIn('id', [1,2])->where('status', 1)->get();
        return view('layouts.pages.admin.info_employee.employee_list',compact('user'));
    }
    public function employee_details($id)
    {
        $user = User::findOrFail($id);
        $infoEducational = $user->infoEducational;
        $infoWorkExperience = $user->infoWorkExperience;
        $infoBank = $user->infoBank;
        $infoNominee = $user->infoNominee;
        //--Personal Information
        $infoPersonal = InfoPersonal::where('emp_id', $id)->first();
        
        $reporting_boss = optional($infoPersonal)->reportingBoss;
        $department = optional($infoPersonal)->mastDepartment;
        $designation = optional($infoPersonal)->mastDesignation;
        $employee_type = optional($infoPersonal)->mastEmployeeType;
        $work_station = optional($infoPersonal)->mastWorkStation;
    
        $joiningDate = optional($infoPersonal)->joining_date;
        $serviceLength = $joiningDate ? $this->calculateServiceLength($joiningDate) : null;

        //---Address (Division)
        $divisions = DB::table('divisions')->where('id', optional($infoPersonal)->division_present)->first();
        $districts = DB::table('districts')->where('id', optional($infoPersonal)->district_present)->first();
        $upazilas = DB::table('upazilas')->where('id', optional($infoPersonal)->upazila_present)->first();
        $unions = DB::table('unions')->where('id', optional($infoPersonal)->union_present)->first();
        $divisions_permanent = DB::table('divisions')->where('id', optional($infoPersonal)->division_permanent)->first();
        $districts_permanent = DB::table('districts')->where('id', optional($infoPersonal)->district_permanent)->first();
        $upazilas_permanent = DB::table('upazilas')->where('id', optional($infoPersonal)->upazila_permanent)->first();
        $unions_permanent = DB::table('unions')->where('id', optional($infoPersonal)->union_permanent)->first();
    
        $data = [
            'department' => $department,
            'designation' => $designation,
            'employee_type' => $employee_type,
            'work_station' => $work_station,
            'reporting_boss' => $reporting_boss,
            'division' => $divisions,
            'district' => $districts,
            'upazila' => $upazilas,
            'union' => $unions,
            'division_permanent' => $divisions_permanent,
            'district_permanent' => $districts_permanent,
            'upazila_permanent' => $upazilas_permanent,
            'union_permanent' => $unions_permanent,
        ];
        return view('layouts.pages.admin.info_employee.employee_details', compact('user','serviceLength','infoPersonal','infoEducational','infoWorkExperience','infoBank','infoNominee','data'));
    }
    public function calculateServiceLength($joiningDate)
    {
        $joiningDate = Carbon::parse($joiningDate);
        $currentDate = Carbon::now();

        $serviceLength = $joiningDate->diffInYears($currentDate) . ' years, ' . $joiningDate->diffInMonths($currentDate) % 12 . ' months';

        return $serviceLength;
    }
    public function profileUpdate(Request $request, $id)
    {
        //----------User Update
        $user = User::findorfail($id);
        if($request->hasFile("profile_photo_path")){
            if (File::exists("public/images/profile/".$user->profile_photo_path)) {
                File::delete("public/images/profile/".$user->profile_photo_path);
            }
            //get filename with extension
            $filenamewithextension = $request->file('profile_photo_path')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('profile_photo_path')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File
            $request->file('profile_photo_path')->move('public/images/profile/', $filenametostore); //--Upload Location
            // $request->file('profile_image')->storeAs('public/profile_images', $filenametostore);
            //Resize image here
            $thumbnailpath = public_path('images/profile/'.$filenametostore); //--Get File Location
            // $thumbnailpath = public_path('storage/images/profile/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(1200, 850, function($constraint) {
                $constraint->aspectRatio();
            }); 
            $img->save($thumbnailpath);

            //---Data Save
            $user->profile_photo_path = $filenametostore;
        }
        if($request->password){
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'password' => 'required|min:8',
            ]);
        
            if ($validator->fails()) {
                $notification=array('messege'=>'The validator failed.','alert-type'=>'fail');
                return back()->with($notification)->withErrors($validator)->withInput();
            }
            if (Hash::check($request->current_password, $user->password)) {
                $user->name = $request->name;
                $user->contact_number = $request->contact_number;
                $user->password = Hash::make($request->password);
                $user->save();
    
                $notification=array('messege'=>'User update successfully!','alert-type'=>'update');
                return redirect()->back()->with($notification);
            }
        }else{
            $user->name = $request->name;
            $user->contact_number = $request->contact_number;
            $user->save();

            $notification=array('messege'=>'User update successfully!','alert-type'=>'update');
            return redirect()->back()->with($notification); 
        }
        $notification=array('messege'=>'The current password is incorrect.','alert-type'=>'fail');
        $current_password=array('current_password'=>'The current password is incorrect.');
        return back()->with($notification)->withErrors($current_password)->withInput($current_password);
    }
    /**___________________________________________________________________
     * Employee Personal Information Update
     * ____________________________________________________________________
     */
    public function employee_edit($id)
    {
        $divisions = DB::table('divisions')->get();
        $department =MastDepartment::where('status', 1)->get();
        $designation =MastDesignation::where('status', 1)->get();
        $employee_type =MastEmployeeType::where('status', 1)->get();
        $work_station =MastWorkStation::where('status', 1)->get();
        $reporting_boss = InfoPersonal::where('is_reporting_boss', 1)->join('users', 'users.id', 'info_personals.emp_id')->select('users.name')->get();


        $old_data = [
            'divisions' => $divisions,
            'department' => $department,
            'designation' => $designation,
            'employee_type' => $employee_type,
            'work_station' => $work_station,
            'reporting_boss' => $reporting_boss,
        ];

        $user = User::findOrFail($id);
        $infoEducational = $user->infoEducational;
        $infoWorkExperience = $user->infoWorkExperience;
        $infoBank = $user->infoBank;
        $infoNominee = $user->infoNominee;
        
        //--Personal Information
        $infoPersonal = InfoPersonal::where('emp_id', $id)->first();
        $reporting_boss = optional($infoPersonal)->reportingBoss;
        $department = optional($infoPersonal)->mastDepartment;
        $designation = optional($infoPersonal)->mastDesignation;
        $employee_type = optional($infoPersonal)->mastEmployeeType;
        $work_station = optional($infoPersonal)->mastWorkStation;

        //---Address (Divistion)
        $divisions = DB::table('divisions')->where('id', optional($infoPersonal)->division_present)->first();
        $districts = DB::table('districts')->where('id', optional($infoPersonal)->district_present)->first();
        $upazilas = DB::table('upazilas')->where('id', optional($infoPersonal)->upazila_present)->first();
        $unions = DB::table('unions')->where('id', optional($infoPersonal)->thana_present)->first();
        $divisions_permanent = DB::table('divisions')->where('id', optional($infoPersonal)->division_permanent)->first();
        $districts_permanent = DB::table('districts')->where('id', optional($infoPersonal)->district_permanent)->first();
        $upazilas_permanent = DB::table('upazilas')->where('id', optional($infoPersonal)->upazila_permanent)->first();
        $unions_permanent = DB::table('unions')->where('id', optional($infoPersonal)->thana_permanent)->first();
        $data = [
            'user' => $user,
            'infoPersonal' => $infoPersonal,
            'infoEducational' => $infoEducational,
            'infoWorkExperience' => $infoWorkExperience,
            'infoBank' => $infoBank,
            'infoNominee' => $infoNominee,
            
            'department' => $department,
            'designation' => $designation,
            'employee_type' => $employee_type,
            'work_station' => $work_station,
            'reporting_boss' => $reporting_boss,
            
            'division' => $divisions,
            'district' => $districts,
            'upazila' => $upazilas,
            'union' => $unions,

            'division_permanent' => $divisions_permanent,
            'district_permanent' => $districts_permanent,
            'upazila_permanent' => $upazilas_permanent,
            'union_permanent' => $unions_permanent,
        ];
        return view('layouts.pages.admin.info_employee.employee_edit', compact('data','old_data'));
    }
    public function employee_update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = InfoPersonal::where('emp_id', $id)->first();
            $data->user_id = Auth::user()->id;
            
            $data->date_of_birth=$request->date_of_birth;
            $data->employee_gender=$request->employee_gender;
            $data->nid_no=$request->nid_no;
            $data->blood_group=$request->blood_group;
            $data->mast_department_id=$request->mast_department_id;
            $data->mast_designation_id=$request->mast_designation_id;
            $data->mast_employee_type_id=$request->mast_employee_type_id;
            $data->mast_work_station_id=$request->mast_work_station_id;

            $data->number_official=$request->number_official;
            $data->email_official=$request->email_official;
            $data->joining_date=$request->joining_date;
            $data->is_reporting_boss=$request->is_reporting_boss;
            $data->gross_salary=$request->gross_salary;
            $data->reporting_boss=$request->reporting_boss;

            // $data->division_present=$request->division_present;
            // $data->district_present=$request->district_present;
            // $data->upazila_present=$request->upazila_present;
            // $data->thana_present=$request->thana_present;
            $data->address_present=$request->address_present;
            // $data->division_permanent=$request->division_permanent;
            // $data->district_permanent=$request->district_permanent;
            // $data->upazila_permanent=$request->upazila_permanent;
            // $data->thana_permanent=$request->thana_permanent;
            $data->address_permanent=$request->address_permanent;

            $data->passport_no=$request->passport_no;
            $data->driving_license=$request->driving_license;
            $data->marital_status=$request->marital_status;
            $data->house_phone=$request->house_phone;
            $data->father_name=$request->father_name;
            $data->mother_name=$request->mother_name;
            $data->birth_certificate_no=$request->birth_certificate_no;
            $data->emg_person_name=$request->emg_person_name;
            $data->emg_phone_number=$request->emg_phone_number;
            $data->emg_relationship=$request->emg_relationship;
            $data->emg_address=$request->emg_address;
            $data->save();

            // Commit if everything is successful
            DB::commit();
            
            $notification=array('messege'=>'Personal info save successfully!','alert-type'=>'success');
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('An error occurred: ' . $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }
    /**___________________________________________________________________
     * Employee Register Process
     * ____________________________________________________________________
     */
    public function employee_create()
    {
        $user = User::whereNotIn('id', [1,2])->where( 'is_admin', '==', 0)->orWhere('status', '==', 0)->get();
        return view('layouts.pages.admin.info_employee.employee_register',compact('user'));
    }
    public function employee_register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|email|unique:users,email',
        ]);
        $employee_codes = Helper::IDGenerator(new User, 'employee_code', 5, 'GF'); /* Generate id */

        $user= new User();
        $user->employee_code= $employee_codes;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->contact_number=$request->contact_number;
        $user->password=bcrypt($request->password);
        $user->status='0';
        $user->is_admin='0';
        $user->email_verified_at='2023-01-01';
        $user->save();
        
        $notification=array('messege'=>'User created successfully!','alert-type'=>'success');
        return redirect()->route('info_employee_prsonal.create', $user->id)->with($notification);
    }
    public function employee_destroy($id)
    {
        User::destroy($id);
        $notification=array('messege'=>'User delete successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    /**___________________________________________________________________
     * Personal Information
     * ____________________________________________________________________
     */
    public function personal_create($id){
        $data = DB::table('divisions')->get();
        $divisions = DB::table('divisions')->count('id');
        $districts = DB::table('districts')->count('id');
        $upazilas = DB::table('upazilas')->count('id');
        $unions = DB::table('unions')->count('id');

        $data = [
            'division' => $divisions,
            'divisions' => $data,
            'district' => $districts,
            'upazila' => $upazilas,
            'union' => $unions,
        ];
        $emp_id = $id;
        $user_id = Auth::user()->id;
        $user=User::find($id);
        $reporting_boss = InfoPersonal::where('is_reporting_boss', 1)->join('users', 'users.id', 'info_personals.emp_id')->select('users.name')->get();
        $department =MastDepartment::where('status', 1)->get();
        $designation =MastDesignation::where('status', 1)->get();
        $employee_category =MastEmployeeType::where('status', 1)->get();
        $work_stations =MastWorkStation::where('status', 1)->get();

        return view('layouts.pages.admin.info_employee.info_personal',compact('data','user','reporting_boss','department','designation','employee_category','work_stations'));
    }
    public function personal_store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //----------User Update
            $user = User::findorfail($id);
            if($request->hasFile("profile_photo_path")){
                if (File::exists("public/images/profile/".$user->profile_photo_path)) {
                    File::delete("public/images/profile/".$user->profile_photo_path);
                }
                //get filename with extension
                $filenamewithextension = $request->file('profile_photo_path')->getClientOriginalName();
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $request->file('profile_photo_path')->getClientOriginalExtension();
                //filename to store
                $filenametostore = $filename.'_'.time().'.'.$extension;
                //Upload File
                $request->file('profile_photo_path')->move('public/images/profile/', $filenametostore); //--Upload Location
                // $request->file('profile_image')->storeAs('public/profile_images', $filenametostore); //--Orginal Img Save
                //Resize image here
                $thumbnailpath = public_path('images/profile/'.$filenametostore); //--Get File Location
                // $thumbnailpath = public_path('storage/images/profile/'.$filenametostore);
                $img = Image::make($thumbnailpath)->resize(1200, 850, function($constraint) {
                    $constraint->aspectRatio();
                }); 
                $img->save($thumbnailpath);
            }
            $user->update([
                'profile_photo_path' => $filenametostore,
                'mast_work_station_id' => $request->mast_work_station_id,
                'status' => 1,
            ]);

            //----------Personal Info
            $data= new InfoPersonal();
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            
            $data->date_of_birth=$request->date_of_birth;
            $data->employee_gender=$request->employee_gender;
            $data->nid_no=$request->nid_no;
            $data->blood_group=$request->blood_group;
            $data->mast_department_id=$request->mast_department_id;
            $data->mast_designation_id=$request->mast_designation_id;
            $data->mast_employee_type_id=$request->mast_employee_type_id;
            $data->mast_work_station_id=$request->mast_work_station_id;

            $data->number_official=$request->number_official;
            $data->email_official=$request->email_official;
            $data->joining_date=$request->joining_date;
            $data->is_reporting_boss=$request->is_reporting_boss;
            $data->gross_salary=$request->gross_salary;
            $data->reporting_boss=$request->reporting_boss;

            $data->division_present=$request->division_present;
            $data->district_present=$request->district_present;
            $data->upazila_present=$request->upazila_present;
            $data->union_present=$request->union_present;
            $data->thana_present=$request->thana_present;
            $data->post_code_present=$request->post_code_present;
            $data->address_present=$request->address_present;
            $data->division_permanent=$request->division_permanent;
            $data->district_permanent=$request->district_permanent;
            $data->upazila_permanent=$request->upazila_permanent;
            $data->union_permanent=$request->union_permanent;
            $data->thana_permanent=$request->thana_permanent;
            $data->post_code_permanent=$request->post_code_permanent;
            $data->address_permanent=$request->address_permanent;

            $data->passport_no=$request->passport_no;
            $data->driving_license=$request->driving_license;
            $data->marital_status=$request->marital_status;
            $data->house_phone=$request->house_phone;
            $data->father_name=$request->father_name;
            $data->mother_name=$request->mother_name;
            $data->birth_certificate_no=$request->birth_certificate_no;
            $data->emg_person_name=$request->emg_person_name;
            $data->emg_phone_number=$request->emg_phone_number;
            $data->emg_relationship=$request->emg_relationship;
            $data->emg_address=$request->emg_address;
            $data->save();

            //------Salary Structure
            $salary = new SalaryStructure();
            $salary->gross_salary = $data->gross_salary;
            $salary->basic = $data->gross_salary * 0.60; // 60% of the gross salary
            $salary->house_rent = $salary->basic * 0.40; // 40% of the basic salary
            $salary->medical = $salary->basic * 0.15; // 15% of the basic salary
            $salary->conveyance = $salary->basic * 0.10; // 10% of the basic salary
            $salary->additional = $data->gross_salary - ($salary->basic + $salary->house_rent + $salary->medical + $salary->conveyance);
            $salary->emp_id = $id;
            $salary->user_id = Auth::user()->id;
            $salary->status = 1;
            $salary->save();
            
            // Commit if everything is successful
            DB::commit();

            $notification=array('messege'=>'Personal info save successfully!','alert-type'=>'success');
            return redirect()->route('info_employee_related.create', $id)->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Cash transaction error: ' . $e->getMessage());
            return 'An error occurred during the cash transaction: ' . $e->getMessage();
        }
    }
    /**___________________________________________________________________
     * Related Information
     * ____________________________________________________________________
     */
    public function related_create($id)
    {
        $user =User::findorfail($id);
        $educational =InfoEducational::orderBy('id','DESC')->where('emp_id', $id)->get();
        $work_experience =InfoWorkExperience::orderBy('id','DESC')->where('emp_id', $id)->get();
        $info_bank =InfoBank::orderBy('id','DESC')->where('emp_id', $id)->get();
        $info_nominee =InfoNominee::orderBy('id','DESC')->where('emp_id', $id)->get();
        $user_id = $id;

        return view('layouts.pages.admin.info_employee.info_related',compact('user','educational','work_experience','info_bank','user_id','info_nominee'));
    }

    public function related_store(Request $request, $id) 
    {
        $educational = InfoEducational::where('emp_id', $id)->first();
        $work_experience = InfoWorkExperience::where('emp_id', $id)->first();
        $bank = InfoBank::where('emp_id', $id)->first();
        $nominee = InfoNominee::where('emp_id', $id)->first();

        if($request->institute_name != null){
            $validator = Validator::make($request->all(), [
                'qualification' => 'required',
                'institute_name' => 'required',
                'passing_year' => 'required',
                'grade' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($work_experience && $bank && $nominee){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            $data= new InfoEducational();
            $data->qualification=$request->qualification;
            $data->institute_name=$request->institute_name;
            $data->passing_year=$request->passing_year;
            $data->grade=$request->grade;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }elseif($request->company_name){
            $validator = Validator::make($request->all(), [
                'company_name' => 'required',
                'designation' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($educational && $bank && $nominee){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            $data= new InfoWorkExperience();
            $data->company_name=$request->company_name;
            $data->designation=$request->designation;
            $data->start_date=$request->start_date;
            $data->end_date=$request->end_date;
            $data->job_description=$request->job_description;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }elseif ($request->bank_name) {
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required',
                'brance_name' => 'required',
                'acount_name' => 'required',
                'acount_no' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($work_experience && $educational && $nominee){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            $data= new InfoBank();
            $data->bank_name=$request->bank_name;
            $data->brance_name=$request->brance_name;
            $data->acount_name=$request->acount_name;
            $data->acount_no=$request->acount_no;
            $data->acount_type=$request->acount_type;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }elseif($request->full_name){
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'nid_no' => 'required',
                'relation' => 'required',
                'mobile_no' => 'required',
                'profile_image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            if($work_experience && $bank && $educational){
                $user =User::findorfail($id);
                $user->is_admin = 1;
                $user->save();
            }
            if($request->hasFile("profile_image")){
                $file=$request->file("profile_image");
                $imageName=time()."_".$file->getClientOriginalName();
                $file->move(\public_path("images/profile/nominee"),$imageName);
                $request['profile_image']=$imageName;
            }
            $data= new InfoNominee();
            $data->full_name=$request->full_name;
            $data->nid_no=$request->nid_no;
            $data->relation=$request->relation;
            $data->mobile_no=$request->mobile_no;
            $data->nominee_percentage=$request->nominee_percentage;
            $data->profile_image=$imageName;
            $data->emp_id= $id;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json($data);
        }else{
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        }
    }
    public function info_education_destroy($id)
    {
        // InfoEducational::destroy($id);
        $data=InfoEducational::find($id);
        $data->delete();
        return response()->json('success');
    }
    public function info_experience_destroy($id)
    {
        $data=InfoWorkExperience::find($id);
        $data->delete();
        return response()->json('success');
    }
    public function info_bank_destroy($id)
    {
        $data=InfoBank::find($id);
        $data->delete();
        return response()->json('success');
    }
    public function info_nominee_destroy($id)
    {
        $data=InfoNominee::find($id);
        //-------Eloquent ORM
        if (File::exists("public/images/profile/nominee/".$data->profile_image)) {
            File::delete("public/images/profile/nominee/".$data->profile_image);
        }
        $data->delete();
        return response()->json('success');
    }
    /**___________________________________________________________________
     * 
     * ____________________________________________________________________
     */

}
