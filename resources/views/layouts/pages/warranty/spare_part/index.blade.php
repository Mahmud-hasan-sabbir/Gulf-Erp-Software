<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Spare Parts Requisition</h4>
                    <button type="button" id="open_modal" class="btn btn-sm btn-primary p-1 px-2"><i class="fa  fa-plus"></i></i><span class="btn-icon-add"></span>Create</button>
                </div>
                <div class="card-body" id="reload">           
                    <div class="form-group row">
                        <label class="col-md-2 mt-2"><h5>Start Date: </h5></label>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="end_date" placeholder="Enter Date.." id="date">
                        </div>
                        <label class="col-md-2 mt-2"><h5>End Date: </h5></label>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="end_date" placeholder="Enter Date.." id="dateTwo">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Requ No</th>
                                        <th>Requ Date</th>
                                        <th>Tracking No</th>
                                        <th>Tech Name</th>
                                        <th>Complaint Date</th>
                                        <th>Complaint Name</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                    <tbody id="purchase_tbody">

                                        @foreach($spare as $item)
                                        
                                        <tr id="row_purchase_table_{{ $item->id}}">
                                            <td>{{ $item->requ_no}}</td>
                                            <td>{{ $item->requ_date}}</td>
                                            <td>{{ $item->issueNo->id ?? 'null'}}</td>
                                            <td>{{ $item->tech_id ?? 'null'}}</td>
                                            <td>{{ $item->issueNo->issue_date ?? 'null'}}</td>
                                            <td>{{ $item->issueNo->issue_no ?? 'null'}}</td>
                                            <td>@if($item->status == 0)
                                              <span class="badge light badge-warning">
                                                <i class="fa fa-circle text-warning mr-1"></i>Pending
                                              </span>
                                                @elseif($item->status == 1)
                                                <span class="badge light badge-success">
                                                    <i class="fa fa-circle text-success mr-1"></i>Successful
                                                </span>
                                                @elseif($item->status == 2)
                                             <span class="badge light badge-danger">
                                             <i class="fa fa-circle text-danger mr-1"></i>Refund
                                            </span>
                                            @endif
                                            </td>
                                            <td style="width:210px;text-align:right">
                                                <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $item->id }}"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>

                                                <button type="button" class="btn btn-sm btn-info p-1 px-2" id="view_data" data-id="{{ $item->id }}"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button>
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Spare Parts Requisition
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('sparepart-requisition.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="requ_id" id="requ_id">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Complaint ID</label>
                                    <div class="col-md-7">
                                        <select name="complaint_id" id="complaintID" class="form-control dropdwon_select" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach($data as $row)
                                                <option value="{{ $row->id}}">{{ $row->issue_no}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Complaint Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="date" name="issueDate" id="join" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" readonly id="customerName" name="customName" style="border: none"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Technician Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="tech_id" id="tecnicianName" class="form-control dropdwon_select" required>
                                        <option selected disabled>--Select--</option>
                                        @foreach($tecnicianName as $row)
                                            <option value="{{ $row->id}}">{{ $row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Requisition No.</label>
                                    <div class="col-md-7">

                                     <label class="col-md-5 col-form-label" id="requ_no">REQU-</label>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Requisition Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="date" name="requ_date" id="requ_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Technician Observe</label>
                                    <div class="col-md-10">
                                        <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 45px;"></textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="20%">Item Code</th>
                                                <th width="20%">Item Name</th>
                                                <th width="15%">Pkg</th>
                                                <th width="15%">Unit</th>
                                                <th width="15%">Qty</th> 
                                                <th width="15%" class="text-center table_action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</x-app-layout>




<script type="text/javascript">
    /*=======//Show Modal//=========*/
    $(document).on('click','#open_modal',function(){
        // alert('hi');
        $(".bd-example-modal-lg").modal('show');
        //----Open New Add Row
        var tableBody = $('#table-body');
        tableBody.empty();
        addRow(0);
        //--Dropdwon Search Fix
        $('.dropdwon_select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
        
        $("#requ_id").val('');
        $(".table_action").show();
        $(".submit_btn").show();
        $("#id").val("");
       
    });

    /*=======//Save Data //=========*/
    $(document).ready(function(){
        var form = '#add-user-form';
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            var allSubValuesNotNull = true;
            $('.val_part_number').each(function() {
                var value = $(this).val();
                if (value === null || value === '') {
                    allSubValuesNotNull = false;
                    return false;
                }
            });
            $('.val_quantity').each(function() {
                var value = $(this).val();
                if (value === null || value === '') {
                    allSubValuesNotNull = false;
                    return false;
                }
            });
           
            if (allSubValuesNotNull) {
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
                        swal("Success Message Title", "Well done, you pressed a button", "success");
                        $(".bd-example-modal-lg").modal('hide');


                        var storePurchase = response.storePurchase;
                        
                        var i = 0;++i;
                        var row = '<tr id="row_purchase_table_'+ storePurchase.id + '" role="row" class="odd">';
                        row += '<td>' + storePurchase.requ_no + '</td>';
                        row += '<td>' + storePurchase.requ_date + '</td>';
                        row += '<td>' + response.complaintType.name + '</td>';
                        row += '<td>' + response.complaintType.phone + '</td>';
                        row += '<td>' + storePurchase.remarks + '</td>';
                        row += '<td>';
                        if(storePurchase.status == 0)
                            row += '<span class="badge light badge-warning"><i class="fa fa-circle text-warning mr-1"></i>Pending</span>';
                        else if(storePurchase.status == 1)
                            row += '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Successful</span>';
                        else if(storePurchase.status == 2)
                            row += '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Canceled</span>';
                        
                        row += '</td>';
                        row += '<td><button type="button" id="open_modal" class="btn btn-sm btn-primary p-1 px-2"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>Create</button></td>';
                        row += '<td class="d-flex"><button type="button" class="btn btn-sm btn-success p-1 px-2 mr-1" id="edit_data" data-id="'+storePurchase.id+'"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button><button type="button" class="btn btn-sm btn-info p-1 px-2" id="view_data" data-id="'+storePurchase.id+'"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button></td>';

                        if($("#requ_id").val()){
                            $("#row_purchase_table_" + storePurchase.id).replaceWith(row);
                        }else{
                            $("#purchase_tbody").prepend(row);
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
                            title: 'Error!',
                            html: '<ul>' + errorHtml + '</ul>',
                            text: 'All input values are not null or empty.',
                        });
                    }
                });
            } else {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
    });

    /*========//Edit Data//=========*/
    $(document).on('click', '#edit_data', function(){
        var id = $(this).data('id');

        $.ajax({
            url: '{{ route('spare_requisition_edit')}}', 
            method: 'GET',
            dataType: "JSON",
            data: {id: id},
            success: function(response) {
                showData(response, 1);              
            },
            error: function(xhr, status, error) {
             console.log(error);
            }
        });
    });

    /*========//View Data//=========*/
    $(document).on('click', '#view_data', function(){
        var id = $(this).data('id');
        
        $.ajax({
            url:'{{ route('spare_requisition_edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{id:id},
            success:function(response){
                showData(response, 2);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
  

    function showData(response, check) {
        $(".bd-example-modal-lg").modal('show');
        $(".modal-footer").show();
        
        //--Get Master Data
        var spot = response.spot;

        $('#requ_id').val(response.spot.id);

        $('#requ_no').html(response.spot.requ_no);
        $('#requ_date').val(response.spot.requ_date);
        $('#tecnicianName').val(response.spot.make_name.name);
        $('#remarks').val(response.spot.remarks);
        $('#join').val(response.spot.issue_no.issue_date);
        $('#customerName').val(response.spot.mast_customer.name);
        
        //--Get Supplier Data

        var com_id = response.compliant;
        var complaint_type = $('#complaintID');
        complaint_type.empty();
        complaint_type.append('<option selected disabled>--Select--</option>');

        $.each(com_id, function(index, option) {
            var selected = (option.id == response.spot.issue_no.id) ? 'selected' : '';
            complaint_type.append('<option value="' + option.id + '" ' + selected + '>' + option.issue_no + '</option>');
        });

        //--Get Technician Data

        var user_id = response.user_data;
        var user_name = $('#tecnicianName');
       
        user_name.empty();
        user_name.append('<option selected disabled>--Select--</option>');

        $.each(user_id, function(index, option){
            var selected = (option.id == response.spot.make_name.id) ? 'selected' : '';
            user_name.append('<option value="' + option.id +'" '+ selected + '>' + option.name + '</option>');
        });

        if(check == 1){
            $(".modal-title").html('Spare Part Details View');

            $("#requ_id").prop("disabled", false);
            $('#requ_no').prop("disabled", false);
            $("#requ_date").prop("disabled", false);
            $('#remarks').prop("disabled", false);
            $('#tecnicianName').prop("disabled", false);
            $('#join').prop("disabled", false);
            $('#customerName').prop("disabled", false);

            
            $(".table_action").show();
            $('.submit_btn').show();
        }else{
            $("#requ_id").prop("disabled", true);
            $('#requ_no').prop("disabled", true);
            $("#requ_date").prop("disabled", true);
            $('#remarks').prop("disabled", true);
            $('#tecnicianName').prop("disabled", true);
            $('#join').prop("disabled", true);
            $('#customerName').prop("disabled", false);

            $("#complaintID").prop("disabled", true);
            $('.table_action').hide();
            $('.submit_btn').hide();
        }

                //--Table Purchase Details

                var tableBody = $('#table-body');
                tableBody.empty();
                var purchaseDetails = response.purchase_details;

                var i = 0;

                if(check == 1){ //Edit - 1
                    $.each(purchaseDetails, function(index, item) {

                        var newRow = $('<tr id="row_todo_'+ item.id + '">' +
                            '<input type="hidden" name="editFile['+i+'][id]" id="salesDetailsId" value="' + item.id + '">' +
                            '<td>'+
                                '<select id="item_category" class="form-control dropdwon_select val_item_category">' +
                                '<option selected disabled>--Select--</option>' +
                                '@foreach($item_group as $data)' +
                                    '<option value="{{ $data->id }}" data-part_name="{{ $data->part_name }}" ' + ('{{ $data->id }}' == item.item_group_id ? 'selected' : '') + '>' + '{{ $data->part_name }}' + '</option>' +
                                '@endforeach' +
                                '</select>' +
                            '</td>' +
                            '<td><select id="partNumber" name="editFile['+i+'][item_id]" class="form-control dropdwon_select val_part_number"></select></td>' +
                            '<td><input type="text" name="" REQUISITION-NO id="packageSize" class="form-control" value="' + item.box_qty + '"></td>' +
                            '<td><input type="text" name="" readonly id="unit" class="form-control" value="' + item.unit_name + '"></td>' +
                            '<td><input type="number" name="editFile['+i+'][qty]" id="" class="form-control quantity val_quantity"  value="'+ item.qty +'"></td>' +
                            '<td class="text-center">' +
                                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs edit_add_hide" onClick="addRow(0)"><span class="fa fa-plus"></span></button>' +
                                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0" id="delete_data" data-id="' + item.id +'"><span class="fa fa-trash"></span></button>' +
                            '</td>'+
                        '</tr>');
                        

                        $('#items-table tbody').append(newRow);

                        var currentRow = $(newRow);
                        var partNumberSelect = currentRow.find('.val_part_number');

                        $.ajax({
                            url: '{{ route('edit-part-id')}}',
                            method: 'GET',
                            dataType: 'JSON',
                            data: { 'part_id': item.item_group_id},
                            
                            success: function(data) {
                                // partNumberSelect.append('<option value="" selected>--Select--</option>');

                                $.each(data, function(index, option) {
                                    var selected = (option.id == item.item_rg_id) ? 'selected' : '';
                                    partNumberSelect.append('<option value="' + option.id + '" ' + selected + '>' + option.part_no + '</option>');
                                });
                            },
                            error: function() {
                                alert('Fail');
                            }
                        });
                    });
                    i++;
                }

        if(check == 2){ //View - 2
            $.each(purchaseDetails, function(index, item) {
                
                var row = '<tr id="row_todo_'+ item.part_name + '">';
                row += '<td>' + item.part_name + '</td>';
                row += '<td>' + item.part_no + '</td>';
                row += '<td>' + item.box_qty + '</td>';
                row += '<td>' + item.unit_name + '</td>';
                row += '<td>' + item.qty + '</td>';
                row += '</tr>';
                tableBody.prepend(row);

            });
           
        }
    }

    /*========//Delete Data//========*/
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $("body").on('click','#delete_data',function(){
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
                    url: "{{ url('inv_purchase/destroy')}}" + '/' + id,
                    method: 'DELETE',
                    type: 'DELETE',
                    success: function(response) {
                        toastr.success("Record deleted successfully!");
                        $("#row_todo_" + id).remove();
                        $('#table-body').closest('tr').remove();
                        updateSubtotal(0);

                        var countTrData = parseInt($('#items-table tbody tr .countTdData').length);
                        if(countTrData < 1 ){
                            $(".bd-example-modal-lg").modal('hide');
                            deleteMasterData();
                        }
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
            } 
            else 
            {
                // User clicked "No" button, do nothing
                swal("Your data is safe!", {
                    icon: "success",
                });
            }
        });
    });

    function deleteMasterData(){
        var id = $('#requ_id').val();
        $.ajax({
            url:'{{ route('getDelete-master-purchase')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id':id},
            success:function(response){
                swal("Your data save successfully", "Well done, you pressed a button", "success")
                    .then(function() {
                        location.reload();
                    });
            },
            error:function(){
                alert('Fail');
            }
        });
    }
</script>

<script type="text/javascript">
    //======Add ROW
    var count = 0;
    $("#items-table").on("click", ".add-row", function() {
        var allValuesNotNull = true;
        $('.val_part_number').each(function() {
            var value = $(this).val();
            if (value === null || value === '') {
                allValuesNotNull = false;
                return false;
            }
        });
        $('.val_quantity').each(function() {
            var value = $(this).val();
            if (value === null || value === '') {
                allValuesNotNull = false;
                return false;
            }
        });
        
        if (allValuesNotNull) {
            ++count;
            addRow(count);
        } else {
            swal("Error!", "All input values are not null or empty.", "error");
        }
    });
    function addRow(i){
        var newRow = $('<tr>' +
            '<td>'+
                '<select id="item_category" class="form-control dropdwon_select val_item_category">' +
                '<option selected disabled>--Select--</option>' +
                '@foreach($item_group as $data)' +
                    '<option value="{{ $data->id}}">{{ $data->part_name}}</option>' +
                    '@endforeach' +
                '</select>' +
            '</td>' +
            '<td><select id="partNumber" name="moreFile['+i+'][item_id]" class="form-control dropdwon_select val_part_number"></select></td>' +
            '<td><input type="text" name="" readonly id="packageSize" class="form-control"></td>' +
            '<td><input type="text" name="" readonly id="unit" class="form-control"></td>' +
            '<td><input type="number" name="moreFile['+i+'][qty]" id="qty" class="form-control quantity val_quantity"></td>' +
            '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
            '</td>'+
        '</tr>');
        

        $('.edit_add_hide').hide();
        $('#items-table tbody').append(newRow);

        //--Dropdwon Search Fix
        newRow.find('.dropdwon_select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
    }
    //======Remove ROW
    $('#items-table').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        updateSubtotal(0);
    });

</script>

<script type="text/javascript">
    //======Get Item Group All Data
    $(document).on('change','#item_category',function(){
        var partId = $(this).val();
        var currentRow = $(this).closest("tr");
        $.ajax({
            url:'{{ route('get-part-id')}}',
            method:'GET',
            dataType:"html",
            data:{'part_id':partId},
            success:function(data){
                console.log(data)
                currentRow.find('#partNumber').html(data);
            },
            error:function(){
                alert('Fail');
            }
        });
    });
    //======Show Single Row Data
    $(document).on('change','#partNumber', function(){
        var partNumber_id = $(this).val();
        var currentRows = $(this).closest("tr"); 
        
        $.ajax({
            url:'{{ route('get-part-number')}}',
            method:'GET',
            dataType:"JSON",
            data:{'part_id':partNumber_id},
            success:function(data){
                console.log(data)
                currentRows.find('#packageSize').val(data.box_qty);
                currentRows.find('#unit').val(data.unit.unit_name);
                currentRows.find('.quantity').focus();
            }
        });
    });
    //======Duplicates Part Number Validation
    $(document).on('change','.val_part_number', function() {
        var dropdownValues = $('.val_part_number').map(function() {
            return $(this).val();
        }).get();

        var hasDuplicates = new Set(dropdownValues).size !== dropdownValues.length;
        if (hasDuplicates) {
            Swal.fire({
                icon: 'error',
                title: 'Duplicate Values',
                text: 'Duplicate values are not allowed in the partNumber dropdown.',
            });

            //--Reset Option
            var $currentRow = $(this).closest('tr');
            var itemCategoryValue = $currentRow.find('.val_item_category').val();
            var currentRow = $(this).closest("tr");
            $.ajax({
                url:'{{ route('get-part-id')}}',
                method:'GET',
                dataType:"html",
                data:{'part_id':itemCategoryValue},
                success:function(data){
                    console.log(data)
                    currentRow.find('#partNumber').html(data);
                },
                error:function(){
                    alert('Fail');
                }
            });
        }
    });

    //======Validation Message
    @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'save':
                swal("Success Message Title", "Well done, you pressed a button", "success");
                break;
            case 'fail':
                swal("Error!", "{{ Session::get('messege') }}", "error");
                $('.bd-example-modal-lg').modal('show');
                break;
        }
    @endif

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
    
    document.getElementById('dateTwo').value = c_date;
</script>


<script>
    var d = new Date();
    var yr = d.getFullYear();
    var month = d.getMonth() + 1;

    if (month < 10) {
        month = '0' + month;
    }

    var date = '01'; // Always set the date to 01 for the first day of the month

    var c_date = yr + '-' + month + '-' + date;
    document.getElementById('date').value = c_date;
</script>

<script>
    $(document).on('change','#complaintID',function () {
        var id = $(this).val();
        

        $.ajax({
            url:'{{route('get-complaint-Name')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id': id},
            success: function(response){

                $('#join').val(response.desig.issue_date);
                $('#customerName').val(response.desig.name);
                
                
             }
        });
    });
</script>