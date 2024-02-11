<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance List</h4>
                    <div>
                        @can('Role create') 
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Set Fingerprint</a>                   
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadFile"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Upload File</a>                   
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg_form"><i class="fa fa-plus"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Manual Attendance</a>                   
                        @endcan
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row" id="filter-data">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Employee</label>
                                <div class="col-md-7">
                                    <select name="user_id" id="user_id" class="form-control dropdwon_select">
                                        <option selected disabled>--Select--</option>
                                        @foreach($employee as $row)
                                            <option value="{{ $row->attendance_id}}">{{ $row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Start
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-01') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">End
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-t') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex justify-content-end">
                                <button id="reset" class="btn btn-sm btn-warning"><i class="ti-reload"></i><span class="btn-icon-add"></span>Reset</button>                   
                            </div>
                        </div>
                    </div>
                    <div id="attendance-list"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Attendances Application Modal -->
    <div class="modal fade bd-example-modal-lg_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                @if (session()->has('success'))
                    <strong class="text-success">{{session()->get('success')}}</strong>
                @endif
                <form class="form-valide" data-action="{{ route('manual_attendances.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Manual Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control dropdwon_select" id="employeeName" name="emp_id" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($employee as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" name="finger_id" id="finger_id">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Code</label>
                                <div class="col-lg-8">
                                    <label class="col-form-label" id="employeeCode">GULF-XXXXX</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date')}}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Attendance Type
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control default-select @error('attendance_type') is-invalid @enderror" id="attendance_type" name="attendance_type" required>
                                        <option value="P" {{ old('attendance_type') == 'P' ? 'selected' : '' }}>Present</option>
                                        <option value="A" {{ old('attendance_type') == 'A' ? 'selected' : '' }}>Absent</option>
                                    </select>
                                    @error('attendance_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">In Time (hh:mm)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="time" class="form-control @error('in_time') is-invalid @enderror" id="in_time" name="in_time" value="09:00">
                                    @error('in_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Out Time (hh:mm)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <input type="time" class="form-control @error('out_time') is-invalid @enderror" id="out_time" name="out_time" value="17:00">
                                    @error('out_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Location</label>
                                <div class="col-lg-8">
                                    <textarea  id="" cols="30" rows="2" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="Please Write Something...">{{old('location')}}</textarea>
                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Remarks</label>
                                <div class="col-lg-8">
                                    <textarea  id="" cols="30" rows="2" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Please Write Something...">{{old('description')}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Set Up Finger on Softwer -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" data-action="{{ route('setup-attendance-store') }}" method="POST" enctype="multipart/form-data" id="add-user-attendacne-id">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Setup Fingerprint ID</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control dropdwon_select" id="attendanceId" name="attendanceId" required>
                                        <option selected disabled>Select</option>
                                        @foreach ($employee as $row)
                                            <option value="{{$row->id}}">{{$row->name}} ({{$row->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Attendance ID</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control @error('attendance_id') is-invalid @enderror" id="attendance_id" name="attendance_id" value="{{old('attendance_id')}}">
                                    @error('attendance_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Set Up Upload File -->
    <div class="modal fade" id="uploadFile">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setup Fingerprint ID</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="POST" data-action="{{route('attendance.upload')}}" enctype="multipart/form-data" id="attendacne-upload">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-md-12 mb-3 mt-3">
                            <p>Please Upload CSV in Given Format <a href="{{ asset('public/attendance.csv') }}" class="text-danger" target="_blank">Sample CSV Format</a></p>
                            {{-- <p>Please Upload CSV in Given Format <a href="{{ asset('files/sample-data-sheet.csv') }}" target="_blank">Sample CSV Format</a></p> --}}
                        </div>
                        <!-- File Input -->
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <span class="text-danger">*</span>File Input (Datasheet)</label>
                            <input  type="file" class="form-control form-control-user @error('file') is-invalid @enderror" accept=".xlsx,.csv" name="file" value="{{ old('file') }}">
                            @error('file')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('script')
    <script>
        //---Save Manual Attendance Data
        var form = '#add-user-form';
        $("#loading").show();
        $(form).on('submit', function(event){
            event.preventDefault();

            var url = $(this).attr('data-action');
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
                    $("#loading").hide();
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('.bd-example-modal-lg_form').modal('hide');
                },
                error: function (xhr) {
                    $("#loading").hide();
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
        //---Save & Upgrate Attendacne ID 
        var form = '#add-user-attendacne-id';
        $("#loading").show();
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
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
                    $("#loading").hide();
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('#exampleModalCenter').modal('hide');
                },
                error: function (xhr) {
                    $("#loading").hide();
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
        //---Save & Attendacne Upload 
        var form = '#attendacne-upload';
        $("#loading").show();
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
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
                    $("#loading").hide();
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('#uploadFile').modal('hide');
                },
                error: function(xhr) {
                    $("#loading").hide();
                    var errorMessage = 'Finger ID Not Defined';

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '';

                        $.each(errors, function(key, value) {
                            errorHtml += '<li style="color:red">' + value + '</li>';
                        });

                        errorMessage = '<ul>' + errorHtml + '</ul>';
                    } else if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                    });
                }

            });
        });
        //--Get Employee List (Manual Attendance)
        var clearEmpId = $('#employeeName').html();
        $("#loading").show();
        $('#employeeName').change(function(){
            var userId = $(this).val();
            $.ajax({
                url:'{{ route('get_employee_code') }}',
                method:'GET',
                dataType:"JSON",
                data:{userId},
                success:function(response){
                    $("#loading").hide();
                    $('#employeeCode').html(response.employee_code);
                    $('#finger_id').val(response.attendance_id);
                    if(response.attendance_id == null){
                        Swal.fire(
                            'Invalid Attendaance ID',
                            'Please setup attendance ID!',
                            'question'
                        )
                        $('#employeeName').html(clearEmpId);
                        $('#employeeCode').html('GF-XXXXX');
                        $('#finger_id').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    $("#loading").hide();
                }
            });
        });
        //--Get Employee List (Set Attendance ID)
        $('#attendanceId').change(function(){
            var userId = $(this).val();
            $("#loading").show();
            $.ajax({
                url:'{{ route('get_employee_code') }}',
                method:'GET',
                dataType:"JSON",
                data:{userId},
                success:function(response){
                    $("#loading").hide();
                    $('#attendance_id').val(response.attendance_id);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    $("#loading").hide();
                }
            });
        });
        //--Get Employee List (Set Attendance ID)
        $('#attendance_type').change(function(){
            var attendanceType = $(this).val();
            if(attendanceType == 0){
                $('#in_time').val('');
                $('#out_time').val('');
            }
        });
    </script>
    
    <script>
        $(document).ready(function(){
            var user_id = $("#user_id").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            
            fetch(user_id, start_date, end_date);
        });
        
        // Fetch records
        function fetch(user_id, start_date, end_date) {
            $("#loading").show();
            $.ajax({
                url: "{{ route('get-attendance-filter') }}",
                method:'GET',
                dataType:"html",
                data: {
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date
                },
                success:function(data){
                    $("#loading").hide();
                    $('#attendance-list').html(data);
                },
                error: function(xhr, status, error) {
                    $("#loading").hide();
                    swal("Error!", "Failed to fetch data!", "error");
                }
            });
        }
        // Filter
        $('#filter-data').on('input change', '#start_date, #end_date, #user_id', function() {
            var user_id = $("#user_id").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            
            fetch(user_id, start_date, end_date);
        });
        // Reset
        var clearDropdownHtml = $('#user_id').html();
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $('#user_id').html(clearDropdownHtml);
            $('#start_date').val(startDate);
            $('#end_date').val(endDate);
            
            var user_id = $("#user_id").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            
            fetch(user_id, start_date, end_date);
        });
    </script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $("#attendance-list").on('click', '#delete_attendance', function () {
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Place your delete code here
                    $.ajax({
                        url: "{{ url('manual_attendances/delete')}}" + '/' + id,
                        method: 'DELETE',
                        type: 'DELETE',
                        success: function (response) {
                            toastr.success("Record deleted successfully!");
                            $("#row_" + id).remove();
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
                } else {
                    // User clicked "No" button, do nothing
                    swal("Your data is safe!", {
                        icon: "success",
                    });
                }
            });
            
        });

    </script>
    @endpush
</x-app-layout>

