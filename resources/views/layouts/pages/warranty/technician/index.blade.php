<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Technician Information List</h4>
                    <button type="button" data-toggle="modal"  data-target=".add-modal" class="btn btn-sm btn-success p-1 px-2" ><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Add</button>
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
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($technician as $item )
                                <tr>
                                    <td>{{ $item->user->employee_code }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->mastDepartment->dept_name }}</td>
                                    <td>{{ $item->mastDesignation->desig_name }}</td>
                                    <td>@if($item->status == 0)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i>non technician
                                        </span>
                                        @elseif($item->status == 1)
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>technician
                                        </span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" id="edit_data" data-toggle="modal" data-id="{{ $item->id }}"  data-target=".bd-example-modal-lg" class="btn btn-sm btn-info p-1 px-2" ><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>
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


    <!-- add modal open-->
<div class="modal fade add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                   Technician New List
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
                <div class="modal-body">
                    <form class="form-valide" data-action="{{ route('submit.technician') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <input type="hidden" name="sal_id" id="sal_id">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Employee Name
                                        </label>
                                        <div class="col-md-7">
                                            <select id="tecnicianName" name="employee_id" class="form-control dropdwon_select" required>
                                                <option selected disabled>-- Select a technician name--</option>
                                                @foreach ($tecnicianName as $data )
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
                                            <select id="designationName" name="designationId" class="form-control dropdwon_select" required>
                                                    <option>-- select a designation --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Join Date

                                        </label>
                                        <div class="col-md-7">
                                            <input type="text"  name="vat" id="join" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Assign Date
                                        </label>
                                        <div class="col-md-7">
                                            <input type="date" name="assignDate" id="date" class="form-control" value="">
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
</div>

<!--edit modal open-->

<div class="modal fade bd-example-modal-lg" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                   Technician update List
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
                <div class="modal-body">
                    <form class="form-valide" data-action="{{ route('update.designation') }}" method="POST" enctype="multipart/form-data" id="add-user-form-two">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <input type="hidden" name="sal_id" id="edit_sal_id" value="">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Employee Name
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" readonly  name="tecName" id="tecName" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Designation
                                        </label>
                                        <div class="col-md-7">
                                            <select id="designationType" name="designation" class="form-control dropdwon_select" required>
                                                    <option>-- select a designation --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Department
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" readonly  name="vat" id="department" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Join Date

                                        </label>
                                        <div class="col-md-7">
                                            <input type="text"  name="vat" id="joinDate" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Assign Date
                                        </label>
                                        <div class="col-md-7">
                                            <input type="date" name="assignDate" id="datetwo" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">submit</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

</x-app-layout>


<script>
    $(document).on('change','#tecnicianName',function () {
        var tecnicianId = $(this).val();


        $.ajax({
            url:'{{route('get-designation-Name')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id': tecnicianId},
            success: function(response){

                $('#join').val(response.desig.joining_date);

                var designation_name = response.designation;
                var designation_type = $('#designationName');
                    designation_type.empty();
                    designation_type.append('<option disabled>--Select--</option>');
                $.each(designation_name, function(index, option) {
                var selected = (option.id == response.desig.mast_designation.id) ? 'selected' : '';
                designation_type.append('<option value="' + option.id + '" ' + selected + '>' + option.desig_name + '</option>');
                 });

             }
        });
    });
</script>

<!---ajax data save add button-->
<script>
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
                    $('.add-modal').modal('hide');
                    console.log(response);
                    location.reload();

                }
                });
            });
    });
</script>

<!---edit code-->

<script>
    $(document).on('click', '#edit_data', function(){
       var id = $(this).data('id');

       $.ajax({
           url:'{{ route('technician.edit')}}',
           method:'GET',
           dataType:"JSON",
           data:{'id':id},
           success:function(response){
               console.log(response);
               $('#joinDate').val(response.getTechnicianData.joining_date);
               $('#tecName').val(response.getTechnicianData.user.name);
               $('#department').val(response.getTechnicianData.mast_department.dept_name);
               $('#assignDate').val(response.getTechnicianData.joining_date);
               $('#edit_sal_id').val(response.getTechnicianData.id);

               var designation_name = response.designation;
                var designation_type = $('#designationType');
               designation_type.empty();
                designation_type.append('<option disabled>--Select--</option>');
               $.each(designation_name, function(index, option) {
               var selected = (option.id == response.getTechnicianData.mast_designation.id) ? 'selected' : '';
               designation_type.append('<option value="' + option.id + '" ' + selected + '>' + option.desig_name + '</option>');
                });

           }
       });
   });
</script>

<!--edit data save ajax-->

<script>
    $(document).ready(function(){
    var form = '#add-user-form-two';
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
                    $('.bd-example-modal-lg').modal('hide');
                    console.log(response);
                    location.reload();
                }
                });
            });
    });
</script>

<script>
    var d = new Date()
    var yr =d.getFullYear();
    var month = d.getMonth()+1

    if(month<10){
        month='0'+month
    }

    var date =d.getDate();
    if(date<10)
    {
        date='0'+date
    }

    var c_date = yr+"-"+month+"-"+date;
    document.getElementById('date').value = c_date;
</script>

<script>
    var d = new Date()
    var yr =d.getFullYear();
    var month = d.getMonth()+1

    if(month<10){
        month='0'+month
    }

    var date =d.getDate();
    if(date<10)
    {
        date='0'+date
    }

    var c_date = yr+"-"+month+"-"+date;
    document.getElementById('datetwo').value = c_date;
</script>









