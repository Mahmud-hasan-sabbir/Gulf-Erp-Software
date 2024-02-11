<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Technician Information List</h4>
                    <div>
                        <button type="button" data-toggle="modal"  data-target=".setup-modal" class="btn btn-sm btn-info p-1 px-2" ><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Setup</button>
                        <button type="button" id="open_modal" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add New</button>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($technician as $item )
                                <tr>
                                    <td>{{ $item->employeeName->employee_code }}</td>
                                    <td>{{ $item->employeeName->name }}</td>
                                    <td>{{ $item->mastDepartment->dept_name }}</td>
                                    <td>{{ $item->mastDesignation->desig_name }}</td>
                                    <td>@if($item->status == 0)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i> Non-Technician
                                        </span>
                                        @elseif($item->status == 1)
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i> Technician
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <button type="button" id="edit_data" data-id="{{ $item->emp_id }}" class="btn btn-sm btn-secondary p-1 px-2" ><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Setup modal open-->
    <div class="modal fade setup-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setup Technician</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('setup.technician') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Services Technician
                                    </label>
                                    <div class="col-md-7">
                                        <select name="services_technician" class="form-control dropdwon_select" required>
                                            <option selected disabled>Select Technician</option>
                                            @foreach ($designation as $item )
                                                <option value="{{ $item->id }}" {{ $item->id == $setup->services_technician ? 'selected' :'' }}>{{ $item->desig_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Install Technician
                                    </label>
                                    <div class="col-md-7">
                                        <select name="install_technician" class="form-control dropdwon_select" required>
                                            <option selected disabled>Select Technician</option>
                                            @foreach ($designation as $item )
                                                <option value="{{ $item->id }}" {{ $item->id == $setup->services_technician ? 'selected' :'' }}>{{ $item->desig_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Modal open-->
    <div class="modal fade bd-example-modal-lg" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Technician update List </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body py-2 px-4">
                    <form class="form-valide" data-action="{{ route('technician.update') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Employee</label>
                                    <div class="col-md-7">
                                        <select id="employee" name="employee_id" class="form-control dropdwon_select">
                                            <option selected disabled>Select a Employee</option>
                                            @foreach ($employees as $data )
                                                <option value="{{ $data->id }}" >{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Designation
                                    </label>
                                    <div class="col-md-7">
                                        <select id="mast_designation_id" name="mast_designation_id" class="form-control dropdwon_select">
                                            <option>Select a Designation</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Department
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" name="" id="department" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Join Date

                                    </label>
                                    <div class="col-md-7">
                                        <input type="text"  name="" id="joinDate" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @push('script')
    <script type="text/javascript">
        var employee = $('#employee').html();
        /*=======// Open Modal //=======*/
        $(document).on('click','#open_modal',function(){

            $(".modal-title").html('Add New Technician');
            $(".bd-example-modal-lg").modal('show');
            //--Dropdwon Search Fix
            $('#employee').html(employee);
            $('#joinDate').val('');
            $('#mast_designation_id').val('');
            $('#department').val('');

            //--Dropdwon Search Fix
            $('.dropdwon_select').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
        });

        /*=======// Save Data //=======*/
        $(document).ready(function(){
            var form = '#add-user-form';
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
                        $(".bd-example-modal-lg").modal('hide');
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        .then(function() {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li style="color:red">' + value + '</li>';
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: '<ul>' + errorHtml + '</ul>',
                            text: 'All input values are not null or empty.',
                        });
                    }
                });
            });
        });

        /*=======// Edit add button //=======*/
        $(document).on('click', '#edit_data', function(){
            var employeeId = $(this).data('id');
            getEmployee(employeeId);
            $(".bd-example-modal-lg").modal('show');
        });

        /*=======// Get Employee Data //=======*/
        $(document).on('change','#employee',function () {
            var employeeId = $(this).val();
            getEmployee(employeeId);
        });

        function getEmployee(id){
            $.ajax({
                url:'{{route('get-employee-personal-info')}}',
                method:'GET',
                dataType:"JSON",
                data:{'id': id},
                success: function(response){
                    $('#joinDate').val(response.personalDetails.joining_date);
                    $('#department').val(response.personalDetails.mast_department.dept_name);

                    //---Employee
                    var employee_name = response.employee;
                    var employeeName = $('#employee');
                    employeeName.empty();
                    employeeName.append('<option disabled>--Select--</option>');
                    $.each(employee_name, function(index, option) {
                        var selected = (option.id == response.personalDetails.emp_id) ? 'selected' : '';
                        employeeName.append('<option value="' + option.id + '" ' + selected + '>' + option.name + '</option>');
                    });

                    //---Designation
                    var designation_name = response.designation;
                    var designation_type = $('#mast_designation_id');
                    designation_type.empty();
                    designation_type.append('<option disabled>--Select--</option>');
                    $.each(designation_name, function(index, option) {
                        var selected = (option.id == response.personalDetails.mast_designation.id) ? 'selected' : '';
                        designation_type.append('<option value="' + option.id + '" ' + selected + '>' + option.desig_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    </script>
    @endpush


</x-app-layout>