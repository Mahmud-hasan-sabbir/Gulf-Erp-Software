<x-app-layout>
    @push('style')  
    <style>
        /*__________________Image Profile______________________*/
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 20px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 25px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #f04e23;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
    
        .avatar-edit .profile_save_btn{
            color: #ffffff;
            position: absolute;
            top: 9px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f04e23;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>

    <style>
        #multi-step-form-container {
            margin: 1rem;
        }
        .text-center {
            text-align: center;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .pl-0 {
            padding-left: 0;
        }
        .button {
            padding: 0.5rem 1.5rem;
            border: 1px solid #d1451e;
            background-color: #f04e23;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn {
            border: none;
            /* border: 1px solid #f04e23; */
            background-color: #f04e23;
        }
        .d-none {
            display: none;
        }
        .font-normal {
            font-weight: normal;
        }
        ul.form-stepper {
            counter-reset: section;
            margin-bottom: 3rem;
        }
        ul.form-stepper .form-stepper-circle {
            position: relative;
        }
        ul.form-stepper .form-stepper-circle span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
        .form-stepper-horizontal {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }
        ul.form-stepper > li:not(:last-of-type) {
            margin-bottom: 0.625rem;
            -webkit-transition: margin-bottom 0.4s;
            -o-transition: margin-bottom 0.4s;
            transition: margin-bottom 0.4s;
        }
        .form-stepper-horizontal > li:not(:last-of-type) {
            margin-bottom: 0 !important;
        }
        .form-stepper-horizontal li {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: start;
            -webkit-transition: 0.5s;
            transition: 0.5s;
        }
        .form-stepper-horizontal li:not(:last-child):after {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            height: 5px;
            content: "";
            top: 25%;
        }
        .form-stepper-horizontal li:after {
            background-color: #dee2e6;
        }
        .form-stepper-horizontal li.form-stepper-completed:after {
            background-color: #f04e23;
        }
        .form-stepper-horizontal li:last-child {
            flex: unset;
        }
        ul.form-stepper li a .form-stepper-circle {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin-right: 0;
            line-height: 1.7rem;
            text-align: center;
            background: rgba(0, 0, 0, 0.38);
            border-radius: 50%;
        }
        .form-stepper .form-stepper-active .form-stepper-circle {
            background-color: #f04e23 !important;
            color: #fff;
        }
        .form-stepper .form-stepper-active .label_bar_text {
            color: #f04e23 !important;
        }
        .form-stepper .form-stepper-active .form-stepper-circle:hover {
            background-color: #c73006 !important;
            color: #fff !important;
        }
        .form-stepper .form-stepper-unfinished .form-stepper-circle {
            background-color: #f8f7ff;
        }
        .form-stepper .form-stepper-completed .form-stepper-circle {
            background-color: #f04e23 !important;
            color: #fff;
        }
        .form-stepper .form-stepper-completed .label_bar_text {
            color: #f04e23 !important;
        }
        .form-stepper .form-stepper-completed .form-stepper-circle:hover {
            background-color: #b92c05 !important;
            color: #fff !important;
        }
        .form-stepper .form-stepper-active span.text-muted {
            color: #fff !important;
        }
        .form-stepper .form-stepper-completed span.text-muted {
            color: #fff !important;
        }
        .form-stepper .label_bar_text {
            font-size: 1rem;
            margin-top: 0.5rem;
        }
        .form-stepper a {
            cursor: default;
        }
        /*--------Alert-----------*/
        .swal2-popup .swal2-title{
            color: #5a5a5a !important;
        }
        .swal2-popup .swal2-styled.swal2-confirm{
            background-color: #f04e23 !important;
        }
    </style>
    @endpush
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Information</h4>
                </div>

                <div class="card-body">
                    <div id="multi-step-form-container">
                        <!-- Form Steps / Progress Bar -->
                        <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                            <!-- Step 1 -->
                            <li class="form-stepper-active text-center form-stepper-list" step="1">
                                <a class="mx-2">
                                    <span class="form-stepper-circle">
                                        <span>1</span>
                                    </span>
                                    <div class="label_bar_text">Introduction</div>
                                </a>
                            </li>
                            <!-- Step 2 -->
                            <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                                <a class="mx-2">
                                    <span class="form-stepper-circle text-muted">
                                        <span>2</span>
                                    </span>
                                    <div class="label_bar_text text-muted">Official Information</div>
                                </a>
                            </li>
                            <!-- Step 3 -->
                            <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                                <a class="mx-2">
                                    <span class="form-stepper-circle text-muted">
                                        <span>3</span>
                                    </span>
                                    <div class="label_bar_text text-muted">Address Details</div>
                                </a>
                            </li>
                            <!-- Step 4 -->
                            <li class="form-stepper-unfinished text-center form-stepper-list" step="4">
                                <a class="mx-2">
                                    <span class="form-stepper-circle text-muted">
                                        <span>4</span>
                                    </span>
                                    <div class="label_bar_text text-muted">Other Information</div>
                                </a>
                            </li>
                            <!-- Step 5 -->
                            <li class="form-stepper-unfinished text-center form-stepper-list" step="5">
                                <a class="mx-2">
                                    <span class="form-stepper-circle text-muted">
                                        <span>5</span>
                                    </span>
                                    <div class="label_bar_text text-muted">Document</div>
                                </a>
                            </li>
                        </ul>

                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- Step Wise Form Content -->
                        <form action="{{ route('info_employee_prsonal.store', $user->id) }}" method="POST" enctype="multipart/form-data" id="userAccountSetupForm" name="userAccountSetupForm">
                            @csrf
                            <!-- Step 1 Content -->
                            <section id="step-1" class="form-step">
                                <!-- Step 1 input fields -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Employee Name</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="" value="{{$user->name}}" disabled/>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Email</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="" value="{{$user->email}}" disabled/>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Date of Birth
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="" value="{{old('date_of_birth')}}" />
                                                @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Gender</label>
                                            <div class="col-lg-7">
                                                <select name="employee_gender" class="form-control default-select  @error('employee_gender') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                </select>                                                
                                                @error('employee_gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">NID </label>
                                            <div class="col-lg-7">
                                                <input type="tel" name="nid_no" id="nid_no" class="form-control @error('nid_no') is-invalid @enderror" placeholder="" value="{{old('nid_no')}}"/>
                                                @error('nid_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Blood Group </label>
                                            <div class="col-lg-7">
                                                <select name="blood_group" id="blood_group" class="form-control default-select @error('blood_group') is-invalid @enderror" style="height: 40px;">
                                                    <option value="" selected>Select</option>
                                                    <option value="1">O Positive (0+)</option>
                                                    <option value="2">O Negative (0-)</option>
                                                    <option value="3">A Positive (A+)</option>
                                                    <option value="4">A Negative (A-)</option>
                                                    <option value="5">B Positive (B+)</option>
                                                    <option value="6">B Negative (B-)</option>
                                                    <option value="7">AB Positive (AB+)</option>
                                                    <option value="8">AB Negative (AB-)</option>
                                                </select>
                                                @error('blood_group')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                                </div>
                            </section>
                            <!-- Step 2 Content, default hidden on page load. -->
                            <section id="step-2" class="form-step d-none">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Department
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select class="form-control default-select" id="department" name="mast_department_id">
                                                    <option value="0" selected>Please select</option>
                                                    @foreach ($department as $row)
                                                        <option value="{{$row->id}}">{{$row->dept_name}}</option>
                                                    @endforeach
                                                </select>                                                
                                                @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Designation
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select class="form-control default-select" id="designation" name="mast_designation_id">
                                                    <option value="0" selected>Please select</option>
                                                    @foreach ($designation as $row)
                                                        <option value="{{$row->id}}">{{$row->desig_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('designation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Employee Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select class="form-control default-select" id="employee_type" name="mast_employee_type_id">
                                                    <option value="0" selected>Please select</option>
                                                    @foreach ($employee_category as $row)
                                                        <option value="{{$row->id}}">{{$row->cat_name}}</option>
                                                    @endforeach
                                                </select> 
                                                @error('employee_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Work Station
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select class="form-control default-select" name="mast_work_station_id" id="work_station">
                                                    <option value="0" selected>Please select</option>
                                                    @foreach ($work_stations as $row)
                                                        <option value="{{$row->id}}">{{$row->store_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('work_station')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Mobile (Official)</label>
                                            <div class="col-lg-7">
                                                <input type="number" name="number_official" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{old('number_official')}}" />
                                                @error('number_official')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Email (Official)</label>
                                            <div class="col-lg-7">
                                                <input type="email" name="email_official" class="form-control @error('email_official') is-invalid @enderror" placeholder="" value="{{old('email_official')}}" />
                                                @error('email_official')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Joining Data
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="date" name="joining_date" id="joining_date" class="form-control @error('joining_date') is-invalid @enderror" placeholder="" value="{{old('joining_date')}}" />
                                                @error('joining_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Gross Salary
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="text" name="gross_salary" id="gross_salary" class="form-control @error('gross_salary') is-invalid @enderror" placeholder="" value="{{old('gross_salary')}}" />
                                                @error('gross_salary')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Reporting Boss</label>
                                            <div class="col-lg-7">
                                                <select name="reporting_boss" class="form-control dropdwon_select  @error('reporting_boss') is-invalid @enderror" style="height: 40px;">
                                                    <option value="" selected>Select Reporting Boss</option>  
                                                    @foreach ($reporting_boss as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('reporting_boss')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <div class="col-lg-7 ml-4">
                                                <input type="hidden" name="is_reporting_boss" value="0">
                                                <input type="checkbox" class="form-check-input" name="is_reporting_boss" value="1" id="check-reporting-boss">
                                                <label class="form-check-label" for="check-reporting-boss">Is Reporting Boss?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                                    <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                                </div>
                            </section>
                            <!-- Step 3 Content, default hidden on page load. -->
                            <section id="step-3" class="form-step d-none">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Present Address</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Division
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select name="division_present" class="form-control dropdwon_select" id="division">
                                                    <option value="" selected>Select Division</option>
                                                    @foreach($data['divisions'] as $division)
                                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('division_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">District
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select name="district_present" class="form-control dropdwon_select" id="district"></select>
                                                @error('district_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Upazila/City
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select name="upazila_present" class="form-control dropdwon_select" id="upazila"></select>
                                                @error('upazila_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Union
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <select name="union_present" class="form-control dropdwon_select" id="union"></select>
                                                @error('union_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Thana</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="thana_present" id="thana" class="form-control @error('thana_present') is-invalid @enderror" placeholder=""/>
                                                @error('thana_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Post Code</label>
                                            <div class="col-lg-7">
                                                <input type="number" name="post_code_present" id="post_code" class="form-control @error('post_code_present') is-invalid @enderror" placeholder=""/>
                                                @error('post_code_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Address Description</label>
                                            <div class="col-lg-7">
                                                <textarea name="address_present" class="form-control @error('address_present') is-invalid @enderror" rows="2" placeholder="Write your present address details!" id="present-address">{{old('address_present')}}</textarea>
                                                @error('address_present')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row mt-3">
                                            <div class="custom-control custom-checkbox checkbox-success">
                                                <input type="checkbox" class="custom-control-input" id="same-address-checkbox">
                                                <label class="custom-control-label p-1" for="same-address-checkbox">Same as permanent address?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Permanent Address</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Division</label>
                                            <div class="col-lg-7">
                                                <select name="division_permanent" class="form-control" id="permanent-division">
                                                    <option selected disabled>Select Division</option>
                                                    @foreach($data['divisions'] as $division)
                                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">District</label>
                                            <div class="col-lg-7">
                                                <select name="district_permanent" class="form-control" id="permanent-district"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Upazila/City</label>
                                            <div class="col-lg-7">
                                                <select name="upazila_permanent" class="form-control" id="permanent-upazila"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Union</label>
                                            <div class="col-lg-7">
                                                <select name="union_permanent" class="form-control" id="permanent-union"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Thana</label>
                                            <div class="col-lg-7">
                                                <input type="text" name="thana_permanent" id="permanent-thana" class="form-control @error('thana_permanent') is-invalid @enderror" placeholder=""/>
                                                @error('thana_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Post Code</label>
                                            <div class="col-lg-7">
                                                <input type="number" name="post_code_permanent" id="permanent-post_code" class="form-control @error('post_code_permanent') is-invalid @enderror" placeholder=""/>
                                                @error('post_code_permanent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Address Description</label>
                                            <div class="col-lg-7">
                                                <textarea name="address_permanent" class="form-control" rows="2" placeholder="Write your permanent address details" id="permanent-address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                                    <button class="button btn-navigate-form-step" type="button" step_number="4">Next</button>
                                </div>
                            </section>
                            <!-- Step 4 Content, default hidden on page load. -->
                            <section id="step-4" class="form-step d-none">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Father Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="test" name="father_name" id="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="" value="{{old('father_name')}}" />
                                                @error('father_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Mother Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="test" name="mother_name" id="mother_name" class="form-control @error('mother_name') is-invalid @enderror" placeholder="" value="{{old('mother_name')}}" />
                                                @error('mother_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Passport No.</label>
                                            <div class="col-lg-7">
                                                <input type="text" id="passport_no" name="passport_no" class="form-control @error('passport_no') is-invalid @enderror" placeholder="" value="{{old('passport_no')}}" />
                                                @error('passport_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Driving License No.</label>
                                            <div class="col-lg-7">
                                                <input type="text" id="driving_license" name="driving_license" class="form-control @error('driving_license') is-invalid @enderror" placeholder="" value="{{old('driving_license')}}" />
                                                @error('driving_license')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Marital Status</label>
                                            <div class="col-lg-7">
                                                <select name="marital_status" class="form-control default-select  @error('marital_status') is-invalid @enderror" style="height: 40px;">
                                                    <option value="0" selected>Unmarried</option>
                                                    <option value="1" {{ old('marital_status') == '1' ? 'selected' : '' }}>Married</option>
                                                    <option value="2" {{ old('marital_status') == '2' ? 'selected' : '' }}>Divorce</option>
                                                    <option value="3" {{ old('marital_status') == '3' ? 'selected' : '' }}>Widowed</option>
                                                </select>
                                                @error('marital_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Home Phone</label>
                                            <div class="col-lg-7">
                                                <input type="test" name="house_phone" class="form-control @error('house_phone') is-invalid @enderror" placeholder="" value="{{old('house_phone')}}" />
                                                @error('house_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Birth Certificate No.</label>
                                            <div class="col-lg-7">
                                                <input type="test" name="birth_certificate_no" id="birth_certificate_no" class="form-control @error('birth_certificate_no') is-invalid @enderror" placeholder="" value="{{old('birth_certificate_no')}}" />
                                                @error('birth_certificate_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Emergency Contact</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Person Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="test" name="emg_person_name" id="emg_person_name" class="form-control @error('emg_person_name') is-invalid @enderror" placeholder="" value="{{old('emg_person_name')}}" />
                                                @error('emg_person_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Phone Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-7">
                                                <input type="test" name="emg_phone_number" id="emg_phone_number" class="form-control @error('emg_phone_number') is-invalid @enderror" placeholder="" value="{{old('emg_phone_number')}}" />
                                                @error('emg_phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Relationship</label>
                                            <div class="col-lg-7">
                                                <input type="test" name="emg_relationship" class="form-control @error('emg_relationship') is-invalid @enderror" placeholder="" value="{{old('emg_relationship')}}" />
                                                @error('emg_relationship')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Address </label>
                                            <div class="col-lg-7">
                                                <input type="test" name="emg_address" class="form-control @error('emg_address') is-invalid @enderror" placeholder="" value="{{old('emg_address')}}" />
                                                @error('emg_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="button btn-navigate-form-step" type="button" step_number="3">Prev</button>
                                    <button class="button btn-navigate-form-step" type="button" step_number="5">Next</button>
                                </div>
                            </section>
                            <!-- Step 5 Content, default hidden on page load. -->
                            <section id="step-5" class="form-step d-none">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="skip-email text-center">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' class="@error('profile_photo_path') is-invalid @enderror form-control" name="profile_photo_path" id="imageUpload" accept=".png, .jpg, .jpeg" value="{{old('profile_photo_path')}}"/>
                                                    <label><i class="fa fa-camera profile_save_btn"></i></label>
                                                    @error('profile_photo_path')
                                                        <span class="invalid-feedback" role="alert" style="">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <label for="imageUpload" class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('{{asset('public')}}/images/profile/fix/blank_man.png');"></div>
                                                </label>
                                            </div>
                                            <h5>Profile Image Upload (Max 2MB File)</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="button btn-navigate-form-step" type="button" step_number="4">Prev</button>
                                    <button class="button submit-btn" type="submit" style="background-color: #bbbbbb" disabled>Save</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    @push('script')
    <!--Image Profile-->
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
            $('.submit-btn').css('background-color', '#68cf29');
            $(".submit-btn").removeAttr('disabled');
        });
    </script>

    <!--Form Step-->
    <script type="text/javascript">
        const navigateToFormStep = (stepNumber) => {
            /* Hide all form steps.*/
            document.querySelectorAll(".form-step").forEach((formStepElement) => {
                formStepElement.classList.add("d-none");
            });
            /*Mark all form steps as unfinished.*/
            document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
                formStepHeader.classList.add("form-stepper-unfinished");
                formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
            });
            /*Show the current form step (as passed to the function).*/
            document.querySelector("#step-" + stepNumber).classList.remove("d-none");
            /*Select the form step circle (progress bar).*/
            const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
            /*Mark the current form step as active.*/
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
            formStepCircle.classList.add("form-stepper-active");
            /**
             * Loop through each form step circles.
             * This loop will continue up to the current step number.
             * Example: If the current step is 3,
             * then the loop will perform operations for step 1 and 2.
             */
            for (let index = 0; index < stepNumber; index++) {
                /*Select the form step circle (progress bar).*/
                const formStepCircle = document.querySelector('li[step="' + index + '"]');
                /*Check if the element exist. If yes, then proceed.*/
                if (formStepCircle) {
                    /* Mark the form step as completed.*/
                    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
                    formStepCircle.classList.add("form-stepper-completed");
                }
            }
        };
        /*Select all form navigation buttons, and loop through them.*/
        document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
            /*Add a click event listener to the button.*/
            formNavigationBtn.addEventListener("click", () => {
                /*Get the value of the step.*/
                const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
                if(stepNumber == 2){
                    var dateOfBirth = document.getElementById("date_of_birth").value;
                    var nidNo = document.getElementById("nid_no").value;
                    var bloodGroup = document.getElementById("blood_group").value;
                    
                    if (dateOfBirth === "") {
                        Swal.fire(
                            'Required data missing?',
                            'Is something wrong with your form data?',
                            'question'
                        )
                        return false;
                    }else{
                        navigateToFormStep(stepNumber);
                    }
                }else if (stepNumber == 3) {
                    //--Step 2
                    var step2  = [];
                    var gross_salary = document.getElementById("gross_salary").value;
                    var joining_date = document.getElementById("joining_date").value;
                    var department = document.getElementById("department").value;
                    var designation = document.getElementById("designation").value;
                    var employee_type = document.getElementById("employee_type").value;
                    var work_station = document.getElementById("work_station").value;
                    if (gross_salary == "" || gross_salary === null || joining_date == "" || joining_date === null || department== 0 || designation== 0 || employee_type== 0 || work_station == 0) {
                        Swal.fire(
                            'Required data missing?',
                            'Is something wrong with your form data?',
                            'question'
                        )
                        return false;
                    }else{
                        navigateToFormStep(stepNumber);
                    }
                }else if (stepNumber == 4) {
                    //--Step 3
                    var division = document.getElementById("division").value;
                    var district = document.getElementById("district").value;
                    var upazila = document.getElementById("upazila").value;
                    if (division === "" || district === "" || upazila === "" || upazila == null) {
                        Swal.fire(
                            'Required data missing?',
                            'Is something wrong with your form data?',
                            'question'
                        )
                        return false;
                    }else{
                        navigateToFormStep(stepNumber);
                    }
                }else if (stepNumber == 5) {
                    //--Step 4
                    var father_name = document.getElementById("father_name").value;
                    var mother_name = document.getElementById("mother_name").value;
                    var emg_person_name = document.getElementById("emg_person_name").value;
                    var emg_phone_number = document.getElementById("emg_phone_number").value;
                    if (father_name === "" || mother_name === "" || emg_person_name === "" || emg_phone_number === "") {
                        Swal.fire(
                            'Required data missing?',
                            'Is something wrong with your form data?',
                            'question'
                        )
                        return false;
                    }else{
                        navigateToFormStep(stepNumber);
                    }
                }else {
                    /*Call the function to navigate to the target form step.*/
                    navigateToFormStep(stepNumber);
                }
                //---END Validation
            });
        });
    </script>

    <!-- Divistion -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#division').change(function(){
                var division_id = $(this).val();
                var option = '';
    
                $.ajax({
                    url : "{{ url('/get-districts') }}",
                    method : "GET",
                    data : {'division_id' : division_id},
                    dataType : 'json',
    
                    success:function(response){
                        var district_length = response.length; 
                        option += "<option selected disabled>Select District</option>";
                        for( var i = 0; i < district_length; i++){
                            var id = response[i]['id'];
                            var district_name = response[i]['name'];
                            option += "<option value='"+id+"'>"+district_name+"</option>";
                            $('#district').empty();
                        }
                        $("#district").append(option);
                        $("#permanent-district").append(option);
                    },
                    error:function(){
                        console.log("There was an error while fetching District!");
                    }
                });
            });
    
            $('#district').change(function(){
                var district_id = $(this).val();
                var upazila_option = '';
    
                $.ajax({
                    url : "{{ url('/get-upazila') }}",
                    method : "GET",
                    data : {'district_id' : district_id},
                    dataType : 'json',
    
                    success:function(upazilas){
                        upazila_option += "<option selected disabled>Select Upazila</option>";
                        for(var i = 0; i < upazilas.length; i++){
                            var upazila_id = upazilas[i]['id'];
                            var upazila_name = upazilas[i]['name'];
                            upazila_option += "<option value='"+upazila_id+"'>"+upazila_name+"</option>";
                            $('#upazila').empty();
                        }
                        $('#upazila').append(upazila_option);
                        $('#permanent-upazila').append(upazila_option);
                    },
                    error:function(){
                        console.log("There was an error while fetching Upazila!");
                    }
    
                });
            });
    
            $('#upazila').change(function(){
                var upazilas_id = $(this).val();
                var thana_option = '';
    
                $.ajax({
                    url : "{{ url('/get-thana') }}",
                    method : "GET",
                    data : {'upazilas_id' : upazilas_id},
                    dataType : 'json',
    
                    success:function(thana){
                        thana_option += "<option selected disabled>Select Union</option>";
                        for(var i = 0; i < thana.length; i++){
                            var thana_id = thana[i]['id'];
                            var thana_name = thana[i]['name'];
                            thana_option += "<option value='"+thana_id+"'>"+thana_name+"</option>";
                            $('#union').empty();
                        }
                        $('#union').append(thana_option);
                        $('#permanent-union').append(thana_option);
                    },
                    error:function(){
                        console.log("There was an error while fetching Union!");
                    }
    
                });
            });
        });
    </script>

    <!-- Divistion Copy-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#permanent-division').change(function(){
                var division_id = $(this).val();
                var option = '';
    
                $.ajax({
                    url : "{{ url('/get-districts') }}",
                    method : "GET",
                    data : {'division_id' : division_id},
                    dataType : 'json',
    
                    success:function(response){
                        var district_length = response.length; 
                        option += "<option selected disabled>Select District</option>";
                        for( var i = 0; i < district_length; i++){
                            var id = response[i]['id'];
                            var district_name = response[i]['name'];
                            option += "<option value='"+id+"'>"+district_name+"</option>";
                            $('#permanent-district').empty();
                            $('#permanent-upazila').empty();
                            $('#permanent-union').empty();
                        }
                        $("#permanent-district").append(option);
                    },
                    error:function(){
                        console.log("There was an error while fetching District!");
                    }
                });
            });
    
            $('#permanent-district').change(function(){
                var district_id = $(this).val();
                var upazila_option = '';
    
                $.ajax({
                    url : "{{ url('/get-upazila') }}",
                    method : "GET",
                    data : {'district_id' : district_id},
                    dataType : 'json',
    
                    success:function(upazilas){
                        upazila_option += "<option selected disabled>Select Upazila</option>";
                        for(var i = 0; i < upazilas.length; i++){
                            var upazila_id = upazilas[i]['id'];
                            var upazila_name = upazilas[i]['name'];
                            upazila_option += "<option value='"+upazila_id+"'>"+upazila_name+"</option>";
                            $('#permanent-upazila').empty();
                        }
                        $('#permanent-upazila').append(upazila_option);
                    },
                    error:function(){
                        console.log("There was an error while fetching Upazila!");
                    }
    
                });
            });
    
            $('#permanent-upazila').change(function(){
                var upazilas_id = $(this).val();
                var thana_option = '';
    
                $.ajax({
                    url : "{{ url('/get-thana') }}",
                    method : "GET",
                    data : {'upazilas_id' : upazilas_id},
                    dataType : 'json',
    
                    success:function(thana){
                        thana_option += "<option selected disabled>Select Union</option>";
                        for(var i = 0; i < thana.length; i++){
                            var thana_id = thana[i]['id'];
                            var thana_name = thana[i]['name'];
                            thana_option += "<option value='"+thana_id+"'>"+thana_name+"</option>";
                            $('#permanent-union').empty();
                        }
                        $('#permanent-union').append(thana_option);
                    },
                    error:function(){
                        console.log("There was an error while fetching Union!");
                    }
    
                });
            });
        });
    
        // ------Same As Permanent Address
        const presentAddressDropdown = document.getElementById("division");
        const permanentAddressDropdown = document.getElementById("permanent-division");
    
        const presentDistrictDropdown = document.getElementById("district");
        const permanentDistrictDropdown = document.getElementById("permanent-district");
    
        const presentUpazilaDropdown = document.getElementById("upazila");
        const permanentUpazilaDropdown = document.getElementById("permanent-upazila");
    
        const presentUnionDropdown = document.getElementById("union");
        const permanentUnionDropdown = document.getElementById("permanent-union");

        const presentThanaDropdown = document.getElementById("thana");
        const permanentThanaDropdown = document.getElementById("permanent-thana");
        
        const presentPostCodeDropdown = document.getElementById("post_code");
        const permanentPostCodeDropdown = document.getElementById("permanent-post_code");

        const addressPresentDropdown = document.getElementById("present-address");
        const addressPermanentDropdown = document.getElementById("permanent-address");
    
        const sameAddressCheckbox = document.getElementById("same-address-checkbox");
        sameAddressCheckbox.addEventListener("change", function() {
            if (sameAddressCheckbox.checked) {
                alert("Are you sure? Permanent address is the same as present address!");
                permanentAddressDropdown.value = presentAddressDropdown.value;
                permanentDistrictDropdown.value = presentDistrictDropdown.value;
                permanentUpazilaDropdown.value = presentUpazilaDropdown.value;
                permanentUnionDropdown.value = presentUnionDropdown.value;
                permanentThanaDropdown.value = presentThanaDropdown.value;
                permanentPostCodeDropdown.value = presentPostCodeDropdown.value;
                addressPermanentDropdown.value = addressPresentDropdown.value;
            } else {
                permanentAddressDropdown.value = "";
                permanentDistrictDropdown.value = "";
                permanentUpazilaDropdown.value = "";
                permanentUnionDropdown.value = "";
                permanentThanaDropdown.value = "";
                permanentPostCodeDropdown.value = "";
                addressPermanentDropdown.value = "";
            }
        });
    </script>

    <!-- Mask Validation-->
    <script type="text/javascript">
        $(document).ready(function() {
            const inputGS = $("#gross_salary");
            const inputNID = $("#nid_no");
            const inputBCN = $("#birth_certificate_no");
            const inputDLN = $("#driving_license");
            const inputPSN = $("#passport_no");
            
            const maskGS = new IMask(inputGS[0], { mask: "000000000" });
            const maskNID = new IMask(inputNID[0], { mask: "0000000000000" });
            const maskBCN = new IMask(inputBCN[0], { mask: "00000000000000000" });
            const maskDLN = new IMask(inputDLN[0], {
                mask: 'SSSSSSSSSSSSSSS',
                blocks: {
                    S: {
                        mask: /^[A-Za-z0-9]$/i,
                        uppercase: true,
                    },
                },
            });
            const maskPSN = new IMask(inputPSN[0], {
                mask: 'SSSSSSSSS',
                blocks: {
                    S: {
                        mask: /^[A-Za-z0-9]$/i,
                        uppercase: true,
                    },
                },
            });
            inputDLN.on("input", function() {
                inputDLN.val(inputDLN.val().toUpperCase());
            });
            inputPSN.on("input", function() {
                inputPSN.val(inputPSN.val().toUpperCase());
            });
            // $(inputNID).on("change", function() {
            //     maskNID.unmaskedValue;
            // });
        });
    </script>
    @endpush

</x-app-layout>