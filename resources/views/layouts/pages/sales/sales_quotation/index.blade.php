<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if($type == 1) AC Sales Quotation List
                        @elseif($type == 2) AC Spare Parts Quotation List
                        @else Car Spare Parts Quotation List 
                        @endif
                    </h4>
                    <button id="open_modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Invoice No</th>
                                <th>Invoice Date</th>
                                <th>Customer Name</th>
                                <th>Invoice Type</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="sales_tbody">
                                @foreach ($data as $key=> $row)
                                @php
                                    $total = 0;
                                    foreach ($row->quotationDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                    }
                                @endphp
                                <tr id="row_master_table_{{ $row->id}}">
                                    <td></td>
                                    <td>{{$row->quot_no}}</td>
                                    <td>{{$row->quot_date}}</td>
                                    <td>{{$row->mastCustomer->name ?? 'NULL'}}</td>
                                    <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                    <td>{{$total }}</td>
                                    <td>@if($row->status == 0)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i>Pending
                                        </span>
                                        @elseif($row->status == 2)
                                        <span class="badge light badge-danger">
                                            <i class="fa fa-circle text-danger mr-1"></i>Canceled
                                        </span>
                                        @else
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Successful
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $row->id }}"  {{$row->status !=0 ? 'disabled':''}}><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>
                                        <button type="button" class="btn btn-sm btn-info p-1 px-2" id="view_data" data-id="{{ $row->id }}"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button>
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
                        @if($type == 1) AC Sales Quotation
                        @elseif($type == 2) AC spare parts Sales
                        @else Car spare parts Sales
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('sales_quotation.store', $type) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <input type="hidden" name="sal_id" id="sal_id">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Customer Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select id="mast_customer_type" class="form-control dropdwon_select" required>
                                        <option selected disabled>--Select--</option>
                                        @foreach($customer_type as $row)
                                            <option value="{{ $row->id}}">{{ $row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="mast_customer_id" id="mast_customer_id" class="form-control dropdwon_select"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Invoice Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="date" name="inv_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">VAT</label>
                                    <div class="col-md-7">
                                        <input type="text" name="vat" id="vat" class="form-control" value="{{ old('vat') ? old('vat'): ''}}" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Invoice Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="mast_item_category_id" id="mast_item_category_id" class="form-control dropdwon_select" disabled>
                                            <option selected disabled>--Select--</option>
                                            @foreach ($item_category as $row)
                                                <option value="{{$row->id}}" {{$row->id == $type ? 'selected': '' }}>{{$row->cat_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">TAX</label>
                                    <div class="col-md-7">
                                        <input type="text" name="tax" id="tax" class="form-control" value="{{ old('tax') ? old('tax'): '' }}" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Remarks</label>
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
                                    <table id="items-table" class="table table-bordered mb-0">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th width="20%">Part Name</th>
                                                <th width="15%">Part No</th>
                                                <th width="10%">Pkg. Qty.</th>
                                                <th width="10%">Unit</th>
                                                <th width="10%">Qty</th>
                                                <th width="12%">Price</th>
                                                <th width="13%">Subtotal</th>
                                                <th width="10%" class="text-center table_action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12" id="edit_add_show" style="display: none">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success rounded-0" onClick="addRow(0)"><span class="fa fa-plus mr-1"></span> ADD ITEM</button>
                                </div>
                            </div>
                            <div class="col-md-12 pt-4">
                                <div class="d-flex justify-content-end">
                                    <h6>Total <span style="border: 1px solid #2222;padding: 10px 40px;margin-left:10px" id="total">0.00</span></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
                
                <p id="errorMessage" style="display: none; color: red;">Duplicate Item Selected</p>
            </div>
        </div>
    </div>


</x-app-layout>
<script type="text/javascript">
    //======Get Master Customer Type
    $(document).on('change','#mast_customer_type',function(){
        var partId = $(this).val();
        $('#loading').show();
        $.ajax({
            url:'{{ route('get-customer-data')}}',
            method:'GET',
            dataType:"html",
            data:{'part_id':partId},
            success:function(data){
                $('#mast_customer_id').html(data);
                $('#loading').hide();
            },
            error:function(){
                alert('Fail');
                $('#loading').hide();
            }
        });
    });
</script>
<script type="text/javascript">
    /*=======//Show Modal//=========*/
    var getCustomerType = $('#mast_customer_type').html();
    $(document).on('click','#open_modal',function(){
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
        
        $("#sal_id").val('');
        $('#inv_no').prop("disabled", false);
        $("#inv_date").prop("disabled", false);
        $("#vat").prop("disabled", false);
        $("#tax").prop("disabled", false);
        $('#remarks').prop("disabled", false);
        $('#mast_customer_type').prop("disabled", false);
        $('#mast_customer_id').prop("disabled", false);
        $('#mast_customer_type').html(getCustomerType);
        $('#mast_customer_id').html('');
        $('#total').text("0.00");

        $(".modal-title").html('@if($type == 1) Add AC Sales Quotation @elseif($type == 2) Add AC Spare Parts Quotation @else Add Car Spare Parts Quotation @endif');
        $(".bd-example-modal-lg").modal('show');
        $(".table_action").show();
        $(".submit_btn").show();
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
            $('.val_price').each(function() {
                var value = $(this).val();
                if (value === null || value === '') {
                    allSubValuesNotNull = false;
                    return false;
                }
            });
            if (allSubValuesNotNull) {
                $('#loading').show();
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
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        $(".bd-example-modal-lg").modal('hide');
                        $('#loading').hide();

                        var add_sales = response.sales;

                        var row = '<tr id="row_master_table_'+ add_sales.id + '" role="row" class="odd">';
                        row += '<td></td>';
                        row += '<td>' + add_sales.quot_no + '</td>';
                        row += '<td>' + add_sales.quot_date + '</td>';
                        row += '<td>' + response.mastCustomer.name + '</td>';
                        row += '<td>' + response.mastItemCategory.cat_name + '</td>';
                        row += '<td>' + response.total + '</td>';
                        row += '<td>';
                        if(add_sales.status == 0)
                            row += '<span class="badge light badge-warning"><i class="fa fa-circle text-warning mr-1"></i>Pending</span>';
                        else if(add_sales.status == 1)
                            row += '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Successful</span>';
                        else if(add_sales.status == 2)
                            row += '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Canceled</span>';
                        row += '</td>';
                        row += '<td class="text-right"><button type="button" class="btn btn-sm btn-success p-1 px-2 mr-1" id="edit_data" data-id="'+add_sales.id+'"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button><button type="button" class="btn btn-sm btn-info p-1 px-2" id="view_data" data-id="'+add_sales.id+'"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button></td>';

                        if($("#sal_id").val()){
                            $("#row_master_table_" + add_sales.id).replaceWith(row);
                        }else{
                            $("#sales_tbody").prepend(row);
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
        $('#loading').show();
        $.ajax({
            url:'{{ route('sales_quotation.edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{id:id},
            success:function(response){
                showData(response, 1);
                $('#loading').hide();
            },
            error: function(xhr, status, error) {
                console.log(error);
                $('#loading').hide();
            }
        });
    });
    /*========//View Data//=========*/
    $(document).on('click', '#view_data', function(){
        var id = $(this).data('id');
        $('#loading').show();
        $.ajax({
            url:'{{ route('sales_quotation.edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{id:id},
            success:function(response){
                showData(response, 2);
                $('#loading').hide();
            },
            error: function(xhr, status, error) {
                console.log(error);
                $('#loading').hide();
            }
        });
    });

    function showData(response, check) {
        $(".bd-example-modal-lg").modal('show');
        $(".modal-footer").show();
        
        //--Get Master Data
        var data = response.data;

        $("#sal_id").val(data.id);
        $('#inv_no').html(data.quot_no);
        $("#inv_date").val(data.quot_date);
        $("#vat").val(data.vat);
        $("#tax").val(data.tax);
        $('#remarks').html(data.remarks);

        if(check == 1){
            $(".modal-title").html('@if($type == 1) AC Sales Quotation Edit @elseif($type == 2) AC Spare Parts Quotation Edit @else Car Spare Parts Quotation Edit @endif');

            $("#sal_id").prop("disabled", false);
            $('#inv_no').prop("disabled", false);
            $("#inv_date").prop("disabled", false);
            $("#vat").prop("disabled", false);
            $("#tax").prop("disabled", false);
            $('#remarks').prop("disabled", false);
            $('#mast_customer_type').prop("disabled", false);
            $('#mast_customer_id').prop("disabled", false);

            
            $(".table_action").show();
            $('.submit_btn').show();
        }else{
            $(".modal-title").html('@if($type == 1) AC Sales Quotation View @elseif($type == 2) AC Spare Parts Quotation View @else Car Spare Parts Quotation View @endif');

            $("#sal_id").prop("disabled", true);
            $('#inv_no').prop("disabled", true);
            $("#inv_date").prop("disabled", true);
            $("#vat").prop("disabled", true);
            $("#tax").prop("disabled", true);
            $('#remarks').prop("disabled", true);
            $('#mast_customer_type').prop("disabled", true);
            $('#mast_customer_id').prop("disabled", true);

            $('.table_action').hide();
            $('.submit_btn').hide();
        }

        //--Get Customer Type Data
        var customer_type = response.customer_type;
        var customer_type_dr = $('#mast_customer_type');
        customer_type_dr.empty();
        customer_type_dr.append('<option disabled>--Select--</option>');
        $.each(customer_type, function(index, option) {
            var selected = (option.id == response.customer_type_id.id) ? 'selected' : '';
            customer_type_dr.append('<option value="' + option.id + '" ' + selected + '>' + option.name + '</option>');
        });

        //--Get Supplier Data
        var customer = response.customer;
        var customer_dr = $('#mast_customer_id');
        customer_dr.empty();
        customer_dr.append('<option>Select an Supplier</option>');
        $.each(customer, function(index, option) {
            var selected = (option.id == data.mast_customer_id) ? 'selected' : '';
            customer_dr.append('<option value="' + option.id + '" ' + selected + '>' + option.name + '</option>');
        });
        //--Tabel Sales Details
        var tableBody = $('#table-body');
        tableBody.empty();
        var salesDetails = response.sales_details;
        var total = 0;
        var i = 0;
        if(check == 1){ //Edit - 1
            $.each(salesDetails, function(index, item) {
                var subtotal = item.qty * item.price;
                var newRow = $('<tr id="row_todo_'+ item.id + '">' +
                    '<input type="hidden" name="editFile['+i+'][id]" value="' + item.id + '">' +
                    '<td>'+
                        '<select id="item_category" class="form-control dropdwon_select val_item_category">' +
                        '<option selected disabled>--Select--</option>' +
                        '@foreach($item_group as $data)' +
                            '<option value="{{ $data->id }}" data-part_name="{{ $data->part_name }}" ' + ('{{ $data->id }}' == item.item_groups_id ? 'selected' : '') + '>' + '{{ $data->part_name }}' + '</option>' +
                        '@endforeach' +
                        '</select>' +
                    '</td>' +
                    '<td><select id="partNumber" name="editFile['+i+'][item_id]" class="form-control dropdwon_select val_part_number"></select></td>' +
                    '<td><input type="text" name="" readonly id="packageSize" class="form-control" value="' + item.box_qty + '"></td>' +
                    '<td><input type="text" name="" readonly id="unit" class="form-control" value="' + item.unit_name + '"></td>' +
                    '<td><input type="number" name="editFile['+i+'][qty]" id="" class="form-control quantity val_quantity" placeholder="0.00" value="'+ item.qty +'"></td>' +
                    '<td><input type="number" name="editFile['+i+'][price]" id="price" class="form-control price val_price" placeholder="0.00" value="'+ item.price +'"></td>' +
                    '<td class="subtotal">'+ subtotal +'</td>' +
                    '<td class="text-center countTdData">' +
                        '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs edit_add_hide" onClick="addRow(0)"><span class="fa fa-plus"></span></button>' +
                        '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0" id="delete_data" data-id="' + item.id +'"><span class="fa fa-trash"></span></button>' +
                    '</td>'+
                '</tr>');

                if ($("#id").val()) {
                    $("#row_todo_" + item.id).replaceWith(newRow);
                } else {
                    tableBody.append(newRow);
                }

                var currentRow = $(newRow);
                var partNumberSelect = currentRow.find('.val_part_number');
                $.ajax({
                    url: '{{ route('edit-part-id')}}',
                    method: 'GET',
                    dataType: 'JSON',
                    data: { 'part_id': item.item_groups_id },
                    success: function(data) {
                        partNumberSelect.append('<option value="" selected>--Select--</option>');

                        $.each(data, function(index, option) {
                            var selected = (option.id == item.item_rg_id) ? 'selected' : '';
                            partNumberSelect.append('<option value="' + option.id + '" ' + selected + '>' + option.part_no + '</option>');
                        });
                    },
                    error: function() {
                        alert('Fail');
                    }
                });
                i++;
                $(this).find('.subtotal').text(subtotal.toFixed(2));
                total += subtotal;
            });
            $('#total').text(total.toFixed(2));

            var rowCount = parseInt($('#items-table tbody tr').length);
            var countTrData = parseInt($('#items-table tbody tr .countTdData').length);
            if(rowCount < 0 || countTrData < 1 ){
                $('#edit_add_show').show();
            }else{
                $('#edit_add_show').hide();
            }
        }
        if(check == 2){ //View - 2
            $.each(salesDetails, function(index, item) {
                var subtotal = item.qty * item.price;
                var row = '<tr id="row_todo_'+ item.id + '">';
                row += '<td>' + item.part_name + '</td>';
                row += '<td>' + item.part_no + '</td>';
                row += '<td>' + item.box_qty + '</td>';
                row += '<td>' + item.unit_name + '</td>';
                row += '<td>' + item.qty + '</td>';
                row += '<td>' + item.price + '</td>';
                row += '<td>'+ subtotal +'</td>';
                row += '</tr>';
                tableBody.prepend(row);

                $(this).find('.subtotal').text(subtotal.toFixed(2));
                total += subtotal;
            });
            $('#total').text(total.toFixed(2));
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
                    url: "{{ url('sales/destroy')}}" + '/' + id,
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
            } else {
                // User clicked "No" button, do nothing
                swal("Your data is safe!", {
                    icon: "success",
                });
            }
        });
        
    });
    function deleteMasterData(){
        var id = $('#sal_id').val();
        $.ajax({
            url:'{{ route('getDelete-master-sales')}}',
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
        $('.val_price').each(function() {
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
            '<td><input type="number" name="moreFile['+i+'][qty]" id="" class="form-control quantity val_quantity" placeholder="0.00"></td>' +
            '<td><input type="number" name="moreFile['+i+'][price]" id="price" class="form-control price val_price" placeholder="0.00"></td>' +
            '<td class="subtotal">0.00</td>' +
            '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
            '</td>'+
        '</tr>');

        $('.edit_add_hide').hide();
        var rowCount = parseInt($('#items-table tbody tr').length);
        var countTrData = parseInt($('#items-table tbody tr .countTdData').length);
        if(rowCount < 0){
            $('#edit_add_show').show();
        }else{
            $('#edit_add_show').hide();
        }

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
        
        var rowCount = parseInt($('#items-table tbody tr td .add-row').length);
        var countTrData = parseInt($('#items-table tbody tr .countTdData').length);
        if(rowCount < 1 || countTrData < 1 ){
            $('#edit_add_show').show();
        }else{
            $('#edit_add_show').hide();
        }
    });
    //======Total Count
    $('#items-table').on('input', '.quantity, .price', function() {
        updateSubtotal(0);
    });
    function updateSubtotal(update_subTotal) {
        var total = 0;
        $('#items-table tbody tr').each(function() {
            var quantity = parseFloat($(this).find('.quantity').val()) || 0;
            var price = parseFloat($(this).find('.price').val()) || 0;
            var subtotal = quantity * price;
            $(this).find('.subtotal').text(subtotal.toFixed(2));
            total += subtotal;
        });
        var update_total = total - update_subTotal;
        $('#total').text(update_total.toFixed(2));
    }
</script>
<script type="text/javascript">
    //======Get Item Group All Data
    $(document).on('change','#item_category',function(){
        var partId = $(this).val();
        var currentRow = $(this).closest("tr");
        $('#loading').show();
        $.ajax({
            url:'{{ route('get-part-id')}}',
            method:'GET',
            dataType:"html",
            data:{'part_id':partId},
            success:function(data){
                console.log(data)
                currentRow.find('#partNumber').html(data);
                $('#loading').hide();
            },
            error:function(){
                alert('Fail');
                $('#loading').hide();
            }
        });
    });
    //======Show Single Row Data
    $(document).on('change','#partNumber', function(){
        var partNumber_id = $(this).val();
        var currentRows = $(this).closest("tr"); 
        $('#loading').show();
        $.ajax({
            url:'{{ route('get-part-number')}}',
            method:'GET',
            dataType:"JSON",
            data:{'part_id':partNumber_id},
            success:function(data){
                $('#loading').hide();
                currentRows.find('#packageSize').val(data.box_qty);
                currentRows.find('#unit').val(data.unit.unit_name);
                currentRows.find('#price').val(data.price);
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






