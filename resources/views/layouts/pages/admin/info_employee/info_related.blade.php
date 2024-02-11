<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Related Information ({{$user->name}})</h4>
                    <a href="{{route('info_employee.list')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Skip</a>
                </div>

                <div class="card-body">
                    <div id="accordion-eleven" class="accordion accordion-primary">
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <form class="form-valide" data-action="{{ route('info_employee_related.store', $user_id) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                            @csrf
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary" data-toggle="collapse" data-target="#rounded-stylish_collapseOne" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Educational Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseOne" class="accordion__body collapse show" data-parent="#accordion-eleven" style="">
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
                                            @if (count($educational) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Qualification</th>
                                                    <th>Institute Name</th>
                                                    <th>Grade</th>
                                                    <th>Passing Year</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_todo">
                                                    @foreach($educational as $row)
                                                        <tr id="row_todo_{{ $row->id}}">
                                                            <td>
                                                                @if ($row->qualification == 1) SSC 
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
                                            @if (count($work_experience) > 0)
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
                                                    @foreach($work_experience as $row)
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
                                                    <select class="form-control default-select" name="acount_type">
                                                        <option disabled selected>Please select</option>
                                                        <option value="1">Savings account</option>
                                                        <option value="2">Salary account</option>
                                                        <option value="3">Fixed deposit account</option>
                                                        <option value="4">Recurring deposit account</option>
                                                        <option value="5">NRI accounts</option>
                                                    </select>                                                    @error('acount_type')
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
                                            @if (count($info_bank) > 0)
                                            <table class="table table-bordered mt-3">
                                                <thead class="bg-dark text-white">
                                                    <th>Bank Name</th>
                                                    <th>Brance Name</th>
                                                    <th>Acount Name</th>
                                                    <th>Acount No.</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="list_work">
                                                    @foreach($info_bank as $row)
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
                                            @if (count($info_nominee) > 0)
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
                                                    @foreach($info_nominee as $row)
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