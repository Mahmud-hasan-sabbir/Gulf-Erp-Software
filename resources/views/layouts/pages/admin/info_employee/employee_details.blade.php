<x-app-layout>
    <style>
        .table thead th {
            text-transform: capitalize ;
        }
        .avatar-upload .avatar-preview {
            border-radius: 0%;
            width: 200px;
            height: 200px;
        }
        .avatar-upload .avatar-preview > div{
            border-radius: 0%;
        }
        .profile_submit{
            width: 200px;
            margin: 5px auto;
        }
        .profile_submit button{
            display: flex;
            width: 100%;
            justify-content: center;
        }
        .avatar-upload .avatar-edit input + label {
            border-radius: 0%;
            width: 200px;
            position: absolute;
            top: 156px;
            left: -177px;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f98f73;
            border-color: #d6d6d6;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-10 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="p-4 bg-dark">
                    <div class="media align-items-end profile-header">
                        <div class="profile mr-4">
                            <div class="rounded mb-2 img-thumbnail" style="width:150px;height:150px;overflow:hidden">
                                <img src="{{asset('public/images')}}/profile/{{ $user->profile_photo_path }}" alt="..." style="height: 100%;width: 100%;object-fit: cover;">
                            </div>
                            <a href="{{route('info_employee.edit', $user->id)}}" class="btn btn-primary light text-white btn-sl-sm btn-block"><i class="fa fa-pencil mr-2"></i> Edit profile</a>
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="text-white">{{$user->name}}</h4>
                            <p class="small mb-5">
                                <i class="fa fa-calendar-o mr-2"></i>
                                {{ optional($infoPersonal)->joining_date ? date("j F Y", strtotime($infoPersonal->joining_date)) : '' }}
                            </p>
                        </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link {{Session::has('messege') || $errors->any() ? '' : 'active'}}">Employee Information</a></li>
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link">Related Information</a></li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link {{Session::has('messege') || $errors->any() ? 'active' : ''}}">Setting</a></li>
                            </ul>
                            

                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade {{Session::has('messege') || $errors->any() ? '' : 'active show'}}">
                                     <!--=====// Personal Information//=====-->
                                     <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Personal Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Employee Name <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{$user->name }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Employee Code <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->employee_code }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Contact Number <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->contact_number }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Email Address <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $user->email }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal && $infoPersonal->date_of_birth)
                                                        <span>{{ date("j F Y", strtotime($infoPersonal->date_of_birth)) }}</span>
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Gender<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal && $infoPersonal->employee_gender !== null)
                                                        @if ($infoPersonal->employee_gender == 0)
                                                            <span>Male</span>
                                                        @else
                                                            <span>Female</span>
                                                        @endif
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">NID No. <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->nid_no ?? 'N/A'}}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Blood Group <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal && $infoPersonal->blood_group !== null)
                                                        @if ($infoPersonal->blood_group == 1)
                                                            <span>O Positive (0+)</span>
                                                        @elseif ($infoPersonal->blood_group == 2)
                                                            <span>O Negative (0-)</span>
                                                        @elseif ($infoPersonal->blood_group == 3)
                                                            <span>A Positive (A+)</span>
                                                        @elseif ($infoPersonal->blood_group == 4)
                                                            <span>A Negative (A-)</span>
                                                        @elseif ($infoPersonal->blood_group == 5)
                                                            <span>B Positive (B+)</span>
                                                        @elseif ($infoPersonal->blood_group == 6)
                                                            <span>B Negative (B-)</span>
                                                        @elseif ($infoPersonal->blood_group == 7)
                                                            <span>AB Positive (AB+)</span>
                                                        @elseif ($infoPersonal->blood_group == 8)
                                                            <span>AB Negative (AB-)</span>
                                                        @else
                                                            <span>Unknown Blood Group</span>
                                                        @endif
                                                    @else
                                                        <span>No Blood Group Available</span>
                                                    @endif
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Official Information//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Official Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Department<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{$data['department']->dept_name ?? 'NA' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Designation<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{$data['designation']->desig_name ?? 'NA' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Employee Type<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $data['employee_type']->cat_name ?? 'NA'  }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Work Station<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $data['work_station']->store_name ?? 'NA'  }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mobile (Official)<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->number_official ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Email (Official)<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->email_official ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Joining Data<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal && $infoPersonal->joining_date)
                                                        <span>{{ date("j F Y", strtotime($infoPersonal->joining_date)) }}</span>
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </div>                                                                                             
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Service Length<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $serviceLength ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Gross Salary <span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->gross_salary ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Reporting Boss<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $data['reporting_boss']->name ?? 'NA' }}</span></div>
                                            </div>
                                        </div>


                                    </div>
                                    <!--=====// Address//=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Address Details</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Present Address<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $data['union']->name ?? '-' }}, {{ $data['upazila']->name ?? '-' }}, {{ $data['district']->name ?? '-'}}, {{ $data['division']->name ?? '-' }}</span></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address Details<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->address_present ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Permanent Address<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $data['union_permanent']->name ?? '-' }}, {{ $data['upazila_permanent']->name ?? '-' }}, {{ $data['district_permanent']->name ?? '-' }}, {{ $data['division_permanent']->name ?? '-' }}</span></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address Details<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->address_permanent ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Other Information //=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Other Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Father Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->father_name ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Mother Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->mother_name ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Passport No.<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->passport_no ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Driving License No.<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->driving_license ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Marital Status<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7">
                                                    @if ($infoPersonal && $infoPersonal->marital_status !== null)
                                                        @if ($infoPersonal->marital_status == 0) 
                                                            Unmarried
                                                        @elseif ($infoPersonal->marital_status == 1) 
                                                            Married
                                                        @elseif ($infoPersonal->marital_status == 2) 
                                                            Divorced
                                                        @elseif ($infoPersonal->marital_status == 3) 
                                                            Widowed 
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>                                                
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Home Phone<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->house_phone ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Birth Certificate No.<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->birth_certificate_no ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=====// Emergency Contact //=====-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Emergency Contact</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Person Name<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_person_name ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Phone Number<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_phone_number ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Relationship<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_relationship ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row mb-2">
                                                <div class="col-sm-6 col-5">
                                                    <h6 class="f-w-500">Address<span class="pull-right">:</span></h6>
                                                </div>
                                                <div class="col-sm-6 col-7"><span>{{ $infoPersonal->emg_address ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="about-me" class="tab-pane fade">
                                    <!--=====// Education Information //=====-->
                                    @if (count($infoEducational) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Education Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-responsive-md">
                                                    <thead class="table-primary text-dark">
                                                        <tr>
                                                            <th>Institute Name</th>
                                                            <th>Qualification</th>
                                                            <th>Passing Year</th>
                                                            <th>Grade</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($infoEducational as $row)
                                                            <tr>
                                                                <td>{{$row->institute_name}}</td>
                                                                <td>
                                                                    @if ($row->qualification == 1)SSC
                                                                    @elseif ($row->qualification ==2)HSC
                                                                    @elseif ($row->qualification ==3)12th Stander
                                                                    @elseif ($row->qualification ==4)Graduation
                                                                    @elseif ($row->qualification ==5)Masters
                                                                    @elseif ($row->qualification ==6)Ph.D 
                                                                    @endif
                                                                </td>
                                                                <td>{{date("j F Y", strtotime($row->passing_year))}}</td>
                                                                <td>{{$row->grade}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!--=====// Work Experience Information //=====-->
                                    @if (count($infoWorkExperience) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Work Experience Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-responsive-md">
                                                    <thead class="table-primary text-dark">
                                                        <tr>
                                                            <th>Company Name</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Duration</th>
                                                            <th>Job Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($infoWorkExperience as $row)
                                                            <tr>
                                                                <td>{{$row->company_name}}</td>
                                                                <td>{{date("j F Y", strtotime($row->start_date))}}</td>
                                                                <td>{{date("j F Y", strtotime($row->end_date))}}</td>
                                                                <td>{{$row->duration}}</td>
                                                                <td>{{$row->job_description}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!--=====// Bank Information //=====-->
                                    @if (count($infoBank) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Bank Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-responsive-md">
                                                    <thead class="table-primary text-dark">
                                                        <tr>
                                                            <th>Bank Name</th>
                                                            <th>Brance Name</th>
                                                            <th>Acount Name</th>
                                                            <th>Acount No</th>
                                                            <th>Acount Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($infoBank as $row)
                                                            <tr>
                                                                <td>{{$row->bank_name}}</td>
                                                                <td>{{$row->brance_name}}</td>
                                                                <td>{{$row->acount_name}}</td>
                                                                <td>{{$row->acount_no}}</td>
                                                                <td>
                                                                    @if ($row->acount_type ==1)Savings account
                                                                    @elseif ($row->acount_type ==2)Salary account 
                                                                    @elseif ($row->acount_type ==3)Fixed deposit account
                                                                    @elseif ($row->acount_type ==4)Recurring deposit account
                                                                    @elseif ($row->acount_type ==5)NRI accounts
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!--=====// Nominee Information //=====-->
                                    @if (count($infoNominee) > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary my-3">Nominee Information</h6>
                                        </div>
                                        <!--Item-->
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-responsive-md">
                                                    <thead class="table-primary text-dark">
                                                        <tr>
                                                            <th>Nominee Name</th>
                                                            <th>NID No.</th>
                                                            <th>Relation</th>
                                                            <th>Mobile No.</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($infoNominee as $key=> $row)
                                                            <tr>
                                                                <td><div class="d-flex align-items-center"><img src="{{asset('public')}}/images/profile/nominee/{{ $row->profile_image }}" class="rounded-lg mr-2" width="24" alt=""> <span class="w-space-no">{{$row->full_name}}</span></div></td>
                                                                <td>{{$row->nid_no}}</td>
                                                                <td>{{$row->relation}}</td>
                                                                <td>{{$row->mobile_no}}</td>
                                                                <td>{{$row->nominee_percentage}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div id="profile-settings" class="tab-pane fade {{Session::has('messege') || $errors->any() ? 'active show' : ''}}">
                                     <!--=====// Personal Information//=====-->
                                     <form method="POST" action="{{ route('change.password', $user->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <!--Item-->
                                            <div class="col-lg-12">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger solid alert-dismissible fade show mt-2">
                                                        @foreach ($errors->all() as $error)
                                                            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                            <strong>Error!</strong> {{$error}}.
                                                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xl-7 col-sm-12 mt-4">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Email</label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="" value="{{$user->email }}" disabled>                                     
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Employee Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="" value="{{$user->name }}">                                     
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Contact Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" placeholder="" value="{{$user->contact_number }}">                                     
                                                        @error('contact_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="current_password" class="col-lg-5 col-form-label">Current Password
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{old('current_password')}}" autocomplete="current-password">
                                                        @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">New Password
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-7">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" autocomplete="new-password">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-sm-12 ">
                                                <div class="skip-email text-center">
                                                    <div class="avatar-upload" style="margin:5px auto">
                                                        <div class="avatar-edit">
                                                            <input type='file' class="@error('profile_photo_path') is-invalid @enderror form-control" name="profile_photo_path" id="imageUpload" accept=".png, .jpg, .jpeg" value="{{$user->profile_photo_path}}"/>
                                                            <label for="imageUpload"><i class="fa fa-camera profile_save_btn"></i></label>
                                                            @error('profile_photo_path')
                                                                <span class="invalid-feedback" role="alert" style="">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <label for="imageUpload" class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url('{{asset('public/images')}}/profile/{{ $user->profile_photo_path }}');"></div>
                                                        </label>
                                                    </div>
                                                    <div class="profile_submit">
                                                        <button class="btn btn-primary">Save</button>
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
            </div><!-- End profile widget -->
    
        </div>
    </div>
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

    {{-- <script>
        setTimeout(function() {
            swal("Error!", "Password change failed.", "error");
        }, 1000);
    </script> --}}
   
</x-app-layout>
  
