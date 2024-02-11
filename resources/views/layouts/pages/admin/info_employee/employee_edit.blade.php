<x-app-layout>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Employee Information</h4>
                    <a href="{{route('info_employee.list')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Employee List</a>
                </div>

                <div class="card-body">
                    <div id="accordion-eleven" class="accordion accordion-primary">
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- Step Wise Form Content -->
                        <form action="{{ route('info_employee.update', $data['user']->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary {{ Session::has('messege') ? '' :'collapsed'}}" data-toggle="collapse" data-target="#rounded-stylish_collapseZero" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Personal Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseZero" class="accordion__body collapse {{ Session::has('messege') ? 'show' :''}}" data-parent="#accordion-eleven" style="">
                                    <!-- Step 1 input fields {Personal}-->
                                    <div class="row pb-0 accordion__body--text">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Employee Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="" value="{{$data['user']->name}}" disabled/>
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
                                                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="" value="{{$data['user']->email}}" disabled/>
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
                                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="" value="{{$data['infoPersonal']->date_of_birth ?? ''}}" />
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
                                                    <select name="employee_gender" class="form-control default-select @error('employee_gender') is-invalid @enderror" style="height: 40px;">
                                                        <option value="0" {{ optional($data['infoPersonal'])->employee_gender == 0 ? 'selected' : '' }}>Male</option>
                                                        <option value="1" {{ optional($data['infoPersonal'])->employee_gender == 1 ? 'selected' : '' }}>Female</option>
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
                                                <label class="col-lg-4 col-form-label">NID
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="number" name="nid_no" id="nid_no" class="form-control @error('nid_no') is-invalid @enderror" placeholder="XXX-XXX-XXXX" value="{{ optional($data['infoPersonal'])->nid_no }}" />
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
                                                <label class="col-lg-4 col-form-label">Blood Group
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select name="blood_group" id="blood_group" class="form-control default-select @error('blood_group') is-invalid @enderror" style="height: 40px;">
                                                        <option value="" selected>Select</option>
                                                        <option value="1" {{ optional($data['infoPersonal'])->blood_group == 1 ? 'selected' : '' }}>O Positive (0+)</option>
                                                        <option value="2" {{ optional($data['infoPersonal'])->blood_group == 2 ? 'selected' : '' }}>O Negative (0-)</option>
                                                        <option value="3" {{ optional($data['infoPersonal'])->blood_group == 3 ? 'selected' : '' }}>A Positive (A+)</option>
                                                        <option value="4" {{ optional($data['infoPersonal'])->blood_group == 4 ? 'selected' : '' }}>A Negative (A-)</option>
                                                        <option value="5" {{ optional($data['infoPersonal'])->blood_group == 5 ? 'selected' : '' }}>B Positive (B+)</option>
                                                        <option value="6" {{ optional($data['infoPersonal'])->blood_group == 6 ? 'selected' : '' }}>B Negative (B-)</option>
                                                        <option value="7" {{ optional($data['infoPersonal'])->blood_group == 7 ? 'selected' : '' }}>AB Positive (AB+)</option>
                                                        <option value="8" {{ optional($data['infoPersonal'])->blood_group == 8 ? 'selected' : '' }}>AB Negative (AB-)</option>
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
                                    <!-- Step 2 input fields {Personal}-->
                                    <div class="row py-0 accordion__body--text">
                                        <div class="col-lg-12">
                                            <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Official Information</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Department
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select class="form-control default-select" id="department" name="mast_department_id">
                                                        <option value="0" {{ optional($data['department'])->id == 0 ? 'selected' : '' }}>Please select</option>
                                                        @foreach ($old_data['department'] as $row)
                                                            <option value="{{ $row->id }}" {{ optional($data['department'])->id == $row->id ? 'selected' : '' }}>
                                                                {{ $row->dept_name }}
                                                            </option>
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
                                                        <option value="0" {{ optional($data['designation'])->id == 0 ? 'selected' : '' }}>Please select</option>
                                                        @foreach ($old_data['designation'] as $row)
                                                            <option value="{{ $row->id }}" {{ optional($data['designation'])->id == $row->id ? 'selected' : '' }}>
                                                                {{ $row->desig_name }}
                                                            </option>
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
                                                        <option value="0" {{ optional($data['employee_type'])->id == 0 ? 'selected' : '' }}>Please select</option>
                                                        @foreach ($old_data['employee_type'] as $row)
                                                            <option value="{{ $row->id }}" {{ optional($data['employee_type'])->id == $row->id ? 'selected' : '' }}>
                                                                {{ $row->cat_name }}
                                                            </option>
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
                                                        <option value="0" {{ optional($data['work_station'])->id == 0 ? 'selected' : '' }}>Please select</option>
                                                        @foreach ($old_data['work_station'] as $row)
                                                            <option value="{{ $row->id }}" {{ optional($data['work_station'])->id == $row->id ? 'selected' : '' }}>
                                                                {{ $row->store_name }}
                                                            </option>
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
                                                    <input type="number" name="number_official" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{ optional($data['infoPersonal'])->number_official ?? '' }}" />
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
                                                    <input type="email" name="email_official" class="form-control @error('email_official') is-invalid @enderror" placeholder="" value="{{ optional($data['infoPersonal'])->email_official ?? '' }}" />
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
                                                    <input type="date" name="joining_date" id="joining_date" class="form-control @error('joining_date') is-invalid @enderror" placeholder="" value="{{ optional($data['infoPersonal'])->joining_date ?? '' }}" />
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
                                                    <input type="number" name="gross_salary" id="gross_salary" class="form-control @error('gross_salary') is-invalid @enderror" placeholder="" value="{{ optional($data['infoPersonal'])->gross_salary ?? '' }}" />
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
                                                    <select name="reporting_boss" class="form-control dropdwon_select @error('reporting_boss') is-invalid @enderror" style="height: 40px;">
                                                        <option value="" selected>Select Reporting Boss</option>
                                                        @foreach ($old_data['reporting_boss'] as $row)
                                                            <option value="{{ $row->id }}" {{ optional($data['reporting_boss'])->id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
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
                                                    <input type="checkbox" class="form-check-input" name="is_reporting_boss" value="1" {{ optional($data['infoPersonal'])->is_reporting_boss ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="check-reporting-boss">Is Reporting Boss?</label>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 3 input fields {Personal}-->
                                    <div class="row py-0 accordion__body--text">
                                        <div class="col-lg-12">
                                            <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Address Details</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Present Address</label>
                                                <div class="col-lg-7">
                                                    <textarea name="address_present" class="form-control @error('address_present') is-invalid @enderror" rows="2" placeholder="Write your present address details!" id="address-present">{{ $data['infoPersonal']->address_present ?? '' }}</textarea>
                                                    @error('address_present')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Permanent Address</label>
                                                <div class="col-lg-7">
                                                    <textarea name="address_permanent" class="form-control @error('address_permanent') is-invalid @enderror" rows="2" placeholder="Write your permanent address details!" id="address-permanent">{{ $data['infoPersonal']->address_permanent ?? '' }}</textarea>
                                                    @error('address_permanent')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 4 input fields {Personal}-->
                                    <div class="row py-0 accordion__body--text">
                                        <div class="col-lg-12">
                                            <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Other Information</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Father Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="test" name="father_name" id="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->father_name ?? '' }}" />
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
                                                    <input type="test" name="mother_name" id="mother_name" class="form-control @error('mother_name') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->mother_name ?? '' }}"/>
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
                                                    <input type="number" name="passport_no" class="form-control @error('passport_no') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->passport_no ?? '' }}" />
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
                                                    <input type="number" name="driving_license" class="form-control @error('driving_license') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->driving_license ?? '' }}" />
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
                                                    <select name="marital_status" class="form-control default-select @error('marital_status') is-invalid @enderror" style="height: 40px;">
                                                        <option value="0" {{ optional($data['infoPersonal'])->marital_status == '0' ? 'selected' : '' }}>Unmarried</option>
                                                        <option value="1" {{ optional($data['infoPersonal'])->marital_status == '1' ? 'selected' : '' }}>Married</option>
                                                        <option value="2" {{ optional($data['infoPersonal'])->marital_status == '2' ? 'selected' : '' }}>Divorce</option>
                                                        <option value="3" {{ optional($data['infoPersonal'])->marital_status == '3' ? 'selected' : '' }}>Widowed</option>
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
                                                    <input type="test" name="house_phone" class="form-control @error('house_phone') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->house_phone ?? '' }}" />
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
                                                    <input type="test" name="birth_certificate_no" class="form-control @error('birth_certificate_no') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->birth_certificate_no ?? '' }}" />
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
                                                    <input type="test" name="emg_person_name" id="emg_person_name" class="form-control @error('emg_person_name') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->emg_person_name ?? '' }}" />
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
                                                    <input type="test" name="emg_phone_number" id="emg_phone_number" class="form-control @error('emg_phone_number') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->emg_phone_number ?? '' }}" />
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
                                                    <input type="test" name="emg_relationship" class="form-control @error('emg_relationship') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->emg_relationship ?? '' }}" />
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
                                                <label class="col-lg-4 col-form-label">Address</label>
                                                <div class="col-lg-7">
                                                    <input type="test" name="emg_address" class="form-control @error('emg_address') is-invalid @enderror" placeholder="" value="{{ $data['infoPersonal']->emg_address ?? '' }}" />
                                                    @error('emg_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group row">
                                                <div class="col-lg-4 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                        <!-- 
                        =======================================================
                        Related Information
                        =======================================================
                        -->
                        <form class="form-valide" data-action="{{ route('info_employee_related.store', $data['user']->id) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                            @csrf
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseOne" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Educational Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseOne" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Educational Information-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Institute Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('institute_name') is-invalid @enderror" id="institute_name" name="institute_name" placeholder="" value="{{old('institute_name')}}">                                     
                                                    @error('institute_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label" for="qualification">Qualification
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select class="form-control default-select" name="qualification">
                                                        <option disabled selected>Please select</option>
                                                        <option value="1">SSC</option>
                                                        <option value="2">HSC</option>
                                                        <option value="3">12th Stander</option>
                                                        <option value="4">Graduation</option>
                                                        <option value="5">Masters</option>
                                                        <option value="6">Ph.D</option>
                                                    </select>                                                    
                                                    @error('qualification')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Passing Year
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('passing_year') is-invalid @enderror" id="passing_year" name="passing_year" placeholder="" value="{{old('passing_year')}}"/>                         
                                                    @error('passing_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Grade
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" placeholder="" value="{{old('grade')}}">                                     
                                                    @error('grade')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6"></div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-7 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12" id="educational">
                                            @if (count($data['infoEducational']) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Qualification</th>
                                                    <th>Institute Name</th>
                                                    <th>Grade</th>
                                                    <th>Passing Year</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_todo">
                                                    @foreach($data['infoEducational'] as $row)
                                                        <tr id="row_todo_{{ $row->id}}">
                                                            <td>
                                                                @if ($row->qualification == 1)SSC 
                                                                @elseif ($row->qualification == 2)HSC
                                                                @elseif ($row->qualification == 3)12th Stander
                                                                @elseif ($row->qualification == 4)Graduation
                                                                @elseif ($row->qualification == 5)Masters
                                                                @elseif ($row->qualification == 6)Ph.D
                                                                @endif
                                                            </td>
                                                            <td>{{ $row->institute_name}}</td>
                                                            <td>{{ $row->grade}}</td>
                                                            <td>{{ $row->passing_year}}</td>
                                                            <td width="90">
                                                                <button type="button" id="delete_todo" data-id="{{ $row->id }}" class="btn btn-sm btn-danger ml-1">Delete</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--info collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseTwo" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Work experience</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseTwo" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Work experience-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Company Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" placeholder="" value="{{old('company_name')}}"/>                         
                                                    @error('company_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Designation
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="" value="{{old('designation')}}"/>                         
                                                    @error('designation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Start Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="" value="{{old('start_date')}}">                                     
                                                    @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">End Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" placeholder="" value="{{old('end_date')}}">                                     
                                                    @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Job Description</label>
                                                <div class="col-lg-7">
                                                    <textarea class="form-control @error('job_description') is-invalid @enderror" rows="1" id="job_description" name="job_description" placeholder="" spellcheck="false">{{old('job_description')}}</textarea>                                                    
                                                    @error('job_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-7 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12" id="work_experience">
                                            @if (count($data['infoWorkExperience']) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Company Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Duration</th>
                                                    <th>Designation</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_work">
                                                    @foreach($data['infoWorkExperience'] as $row)
                                                        <tr id="row_work_experience_{{ $row->id}}">
                                                            <td>{{ $row->company_name}}</td>
                                                            <td>{{ $row->start_date}}</td>
                                                            <td>{{ $row->end_date}}</td>
                                                            <td>{{ $row->duration}}</td>
                                                            <td>{{ $row->designation}}</td>
                                                            <td width="90">
                                                                <button type="button" id="delete_experience" data-id="{{ $row->id }}" class="btn btn-sm btn-danger ml-1">Delete</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseThree" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Banking Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseThree" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Banking Information-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Bank Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" placeholder="" value="{{old('bank_name')}}"/>                         
                                                    @error('bank_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Branch Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('brance_name') is-invalid @enderror" id="brance_name" name="brance_name" placeholder="" value="{{old('brance_name')}}"/>                         
                                                    @error('brance_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Account Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('acount_name') is-invalid @enderror" id="acount_name" name="acount_name" placeholder="" value="{{old('acount_name')}}"/>                         
                                                    @error('acount_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Account No.
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="number" class="form-control @error('acount_no') is-invalid @enderror" id="acount_no" name="acount_no" placeholder="" value="{{old('acount_no')}}"/>                         
                                                    @error('acount_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Account Type</label>
                                                <div class="col-lg-7">
                                                    <select class="form-control default-select" name="acount_type" >
                                                        <option disabled selected>Please select</option>
                                                        <option value="1">Savings account</option>
                                                        <option value="2">Salary account</option>
                                                        <option value="3">Fixed deposit account</option>
                                                        <option value="4">Recurring deposit account</option>
                                                        <option value="5">NRI accounts</option>
                                                    </select>
                                                    @error('acount_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-7 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12" id="info_bank">
                                            @if (count($data['infoBank']) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Bank Name</th>
                                                    <th>Brance Name</th>
                                                    <th>Acount Name</th>
                                                    <th>Acount No.</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_work">
                                                    @foreach($data['infoBank'] as $row)
                                                        <tr id="row_info_bank_{{ $row->id}}">
                                                            <td>{{ $row->bank_name}}</td>
                                                            <td>{{ $row->brance_name}}</td>
                                                            <td>{{ $row->acount_name}}</td>
                                                            <td>{{ $row->acount_no}}</td>
                                                            <td width="90">
                                                                <button type="button" id="delete_info_bank" data-id="{{ $row->id }}" class="btn btn-sm btn-danger ml-1">Delete</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--info collapsed" data-toggle="collapse" data-target="#rounded-stylish_collapseFour" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Nominee Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseFour" class="accordion__body collapse" data-parent="#accordion-eleven" style="">
                                    <!--Nominee Information-->
                                    <div class="row accordion__body--text">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Nominee Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" placeholder="" value="{{old('full_name')}}"/>                         
                                                    @error('full_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">NID
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="number" class="form-control @error('nid_no') is-invalid @enderror" id="nid_no" name="nid_no" placeholder="" value="{{old('nid_no')}}"/>                         
                                                    @error('nid_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Relation
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('relation') is-invalid @enderror" id="relation" name="relation" placeholder="" value="{{old('relation')}}">                                     
                                                    @error('relation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Mobile No.
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" placeholder="" value="{{old('mobile_no')}}">                                     
                                                    @error('mobile_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Nominee Percentage
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control @error('nominee_percentage') is-invalid @enderror" id="nominee_percentage" name="nominee_percentage" placeholder="" value="100">                                     
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        @error('nominee_percentage')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-5 col-form-label">Upload Picture
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image" placeholder="" value="{{old('profile_image')}}">                                     
                                                    @error('profile_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6"></div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <div class="col-lg-7 ml-auto">
                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12" id="info_nominee">
                                            @if (count($data['infoNominee']) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Nominee Name</th>
                                                    <th>NID No.</th>
                                                    <th>Relation</th>
                                                    {{-- <th>Mobile No</th> --}}
                                                    <th>Percentage</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_work">
                                                    @foreach($data['infoNominee'] as $row)
                                                        <tr id="row_nominee_{{ $row->id}}">
                                                            <td>
                                                                <div class="media style-1">
                                                                    <img src="{{asset('public')}}/images/profile/nominee/{{ $row->profile_image }}" class="img-fluid mr-2" alt="">
                                                                    <div class="media-body">
                                                                        <h6>{{ $row->full_name}}</h6>
                                                                        <span>{{ $row->mobile_no}}</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $row->nid_no}}</td>
                                                            <td>{{ $row->relation}}</td>
                                                            {{-- <td>{{ $row->mobile_no}}</td> --}}
                                                            <td>{{ $row->nominee_percentage}}</td>
                                                            <td width="90">
                                                                <button type="button" id="delete_nominee" data-id="{{ $row->id }}" class="btn btn-sm btn-danger ml-1">Delete</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <!--____________// CURD OPARATION \\____________-->
    <script type="text/javascript">
        $(document).ready(function(){
            //---Save Data
            var form = '#add-user-form';
            $(form).on('submit', function(event){
                event.preventDefault();

                var url = $(this).attr('data-action');
                var src = $('#redirect').attr('redirect-action');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        $(form).trigger("reset");
                        // alert(response.success);
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        // window.location.href = src;


                        if(response.institute_name){
                            var row = '<tr id="row_todo_'+ response.id + '">';
                            row += '<td> @if ('+response.qualification == 1 +') SSC  @elseif ('+response.qualification == 2 +')HSC @elseif ('+response.qualification == 3 +')12th Stander @elseif ('+response.qualification == 4 +')Graduation @elseif ('+response.qualification == 5 +')Masters @elseif ('+response.qualification == 6 +')Ph.D @endif </td>';
                            row += '<td>' + response.institute_name + '</td>';
                            row += '<td>' + response.grade + '</td>';
                            row += '<td>' + response.passing_year + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_todo" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>' + '</td>';

                            if($("#id").val()){
                                $("#row_todo_" + response.id).replaceWith(row);
                            }else{
                                $("#list_todo").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                            $("#educational").load(" #educational");
                            $("#form_todo").load(" #form_todo");
                        }
                        if(response.company_name){
                            var row = '<tr id="row_work_experience_'+ response.id + '">';
                            row += '<td>' + response.company_name + '</td>';
                            row += '<td>' + response.start_date + '</td>';
                            row += '<td>' + response.end_date + '</td>';
                            row += '<td>' + response.job_description + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_experience" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                            $("#work_experience").load(" #work_experience");
                            if($("#id").val()){
                                $("#row_work_experience_" + response.id).replaceWith(row);
                            }else{
                                $("#list_work").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                        }
                        if(response.bank_name){
                            var row = '<tr id="row_info_bank_'+ response.id + '">';
                            row += '<td>' + response.bank_name + '</td>';
                            row += '<td>' + response.brance_name + '</td>';
                            row += '<td>' + response.acount_name + '</td>';
                            row += '<td>' + response.acount_no + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_info_bank" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                            $("#info_bank").load(" #info_bank");
                            if($("#id").val()){
                                $("#row_info_bank_" + response.id).replaceWith(row);
                            }else{
                                $("#list_work").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                        }
                        if(response.full_name){
                            var row = '<tr id="row_nominee_'+ response.id + '">';
                            row += '<td>' + response.full_name + '</td>';
                            row += '<td>' + response.nid_no + '</td>';
                            row += '<td>' + response.relation + '</td>';
                            row += '<td>' + response.mobile_no + '</td>';
                            row += '<td>' + response.nominee_percentage + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_nominee" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                            $("#info_nominee").load(" #info_nominee");
                            if($("#id").val()){
                                $("#row_nominee_" + response.id).replaceWith(row);
                            }else{
                                $("#list_work").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                            
                        }
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li style="color:red">' + value + '</li>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Required data missing?',
                            html: '<ul>' + errorHtml + '</ul>',
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $("body").on('click','#delete_todo',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/education/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                success: function(response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_todo_" + id).remove();
                    $("#educational").load(" #educational");
                },
                error: function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        $("body").on('click','#delete_experience',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/experience/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                success: function (response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_todo_" + id).remove();
                    $("#work_experience").load(" #work_experience");
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        $("body").on('click','#delete_info_bank',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/info_bank/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                success: function (response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_info_bank_" + id).remove();
                    $("#info_bank").load(" #info_bank");
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        $("body").on('click','#delete_nominee',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/info_nominee/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                dataType: 'json',               
                success: function (response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_nominee_" + id).remove();
                    $("#info_nominee").load(" #info_nominee");
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
    @endpush
</x-app-layout>