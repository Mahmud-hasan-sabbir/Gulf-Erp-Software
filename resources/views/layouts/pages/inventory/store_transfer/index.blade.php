<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if($type == 1) AC Requsition List
                        @elseif($type == 2) AC Spare Parts Requsition List
                        @else Car Spare Parts Requsition List 
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
                                <th>Store Name</th>
                                <th>Invoice Type</th>
                                <th>Receive</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody id="sales_tbody">
                                @foreach ($data as $key=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $rec = 0;
                                    $item = 0;
                                    foreach ($row->storeTransferDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $rec += $value->deli_qty;
                                        $item += 1;
                                    }

                                    $slMovement = DB::table('sl_movements')->where('reference_id', $row->id)->where('reference_type_id', 3);
                                    $checkStockQuery = clone $slMovement;
                                    $checkDeliveryQuery = clone $slMovement;
                                    $checkReceiveQuery = clone $slMovement;

                                    $checkStock = $checkStockQuery->where('status', 0)->count();
                                    $checkReceive = $checkReceiveQuery->where('status', 1)->count();
                                    $checkDelivery = $checkDeliveryQuery
                                    ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
                                    ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
                                    ->select('sl_movements.*', 'mast_item_registers.part_no', 'mast_item_groups.part_name')
                                    ->orderByRaw('CASE WHEN sl_movements.status = 1 THEN 0 ELSE 1 END, sl_movements.status ASC')
                                    ->orderBy('mast_item_registers.part_no', 'asc')
                                    ->get();

                                @endphp

                                <tr id="row_master_table_{{ $row->id}}">
                                    <td></td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{$row->inv_date}}</td>
                                    <td>{{$row->fromWorkStation->store_name ?? 'NULL'}}</td>
                                    <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                    <td>{{$qty }} / {{$checkReceive}}</td>
                                    <td>@if($row->status == 0)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i>Pending
                                        </span>
                                        @elseif($row->status == 1)
                                        <span class="badge light badge-info">
                                            <i class="fa fa-circle text-info mr-1"></i>In Stock
                                        </span>
                                        @elseif($row->status == 2 || $row->status == 3)
                                        <span class="badge light badge-info">
                                            <i class="fa fa-circle text-info mr-1"></i>In Transit
                                        </span>
                                        @elseif($row->status == 4)
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Successful
                                        </span>
                                        @else
                                        <span class="badge light badge-danger">
                                            <i class="fa fa-circle text-danger mr-1"></i>Canceled
                                        </span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-end">
                                        @if($row->status == 0)
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2 m-1" id="edit_data" data-id="{{ $row->id }}" {{$row->status !=0 ? 'disabled':''}} style="width:75px"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>
                                        @elseif($row->status == 2 || $row->status == 3)
                                        <button type="button" class="btn btn-sm btn-secondary p-1 px-2 m-1" data-toggle="modal" data-target="#exampleModalCenter{{ $key }}" style="width:92px;position: relative;"><i class="fa fa-random"></i></i><span class="btn-icon-add"></span>Receive 
                                            @if ($checkStock != 0)
                                            <span style="position: absolute; background: #ff0000; border-radius: 100%; width: 20px; top: -10px; left:-10px">{{$checkStock}}</span>
                                            @endif
                                        </button>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-info p-1 px-2 m-1" id="view_data" data-id="{{ $row->id }}" style="width:75px"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button>
                                    
                                    
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{ $key }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Item Receive History</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                         <!--=====//Table//=====-->
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th width="35%">Part Name</th>
                                                                        <th width="30%">Part No.</th>
                                                                        <th width="20%">Serial No.</th>
                                                                        <th width="15%">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($checkDelivery as $value)
                                                                        <tr>
                                                                            <td>{{ $value->part_name }}</td>
                                                                            <td>{{ $value->part_no }}</td>
                                                                            <td>{{ $value->serial_no }}</td>
                                                                            <td>
                                                                                @if($value->status == 0)
                                                                                <span class="badge light badge-warning">
                                                                                    <i class="fa fa-circle text-warning mr-1"></i>Pending
                                                                                </span>
                                                                                @elseif($value->status == 1)
                                                                                <span class="badge light badge-success">
                                                                                    <i class="fa fa-circle text-success mr-1"></i>Received
                                                                                </span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                        @if($row->status == 2 || $row->status == 3)
                                                        <div>
                                                            <form action="{{route('store_transfer.receive', $row->id)}}" method="post">
                                                                <button type="submit" class="btn btn-primary" {{$checkStock != 0 ? '' : 'disabled'}}>Receive Item</button>
                                                                @csrf
                                                                @method('PATCH')
                                                            </form>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if($type == 1) AC Sales
                        @elseif($type == 2) AC spare parts Sales
                        @else Car spare parts Sales
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('store_transfer.store', $type) }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <input type="hidden" name="store_transfer_id" id="storeTransferId">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Form Store
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="from_store_id" class="form-control dropdwon_select" id="from_store_id">
                                            @foreach ($store as $item)
                                                <option value="{{$item->id}}">{{$item->store_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Store Name</label>
                                    <div class="col-md-7">
                                        <select class="form-control dropdwon_select" disabled>
                                            @foreach ($store as $item)
                                                <option value="{{$item->id}}" {{$item->id == Auth::user()->mast_work_station_id ? 'selected':''}}>{{$item->store_name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-control" name="mast_work_station_id" value="{{ Auth::user()->mast_work_station_id }}">
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
                                    <label class="col-md-5 col-form-label">Invoice Type</label>
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
                                                <th width="23%">Part Name</th>
                                                <th width="15%">Part No</th>
                                                <th width="15%">Pkg. Qty.</th>
                                                <th width="15%">Unit</th>
                                                <th width="15%">Qty</th>
                                                <th width="12%" class="text-center table_action">Action</th>
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
    var getWorkStation = $('#mast_work_station_id').html();
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
        
        $("#storeTransferId").val('');
        $('#inv_no').prop("disabled", false);
        $("#inv_date").prop("disabled", false);
        $("#vat").prop("disabled", false);
        $("#tax").prop("disabled", false);
        $('#remarks').prop("disabled", false);
        $('#from_store_id').prop("disabled", false);
        $('#mast_work_station_id').html(getWorkStation);

        $(".modal-title").html('@if($type == 1) Add AC Requsition @elseif($type == 2) Add AC Spare Parts Requsition @else Add Car Spare Parts Requsition @endif');
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

                        var add_mastRow = response.transferStore;

                        var row = '<tr id="row_master_table_'+ add_mastRow.id + '" role="row" class="odd">';
                        row += '<td></td>';
                        row += '<td>' + add_mastRow.inv_no + '</td>';
                        row += '<td>' + add_mastRow.inv_date + '</td>';
                        row += '<td>' + response.mastWorkStation.store_name + '</td>';
                        row += '<td>' + response.mastItemCategory.cat_name + '</td>';
                        row += '<td>' + response.qty + ' / 0 </td>';
                        row += '<td>';
                        if(add_mastRow.status == 0)
                            row += '<span class="badge light badge-warning"><i class="fa fa-circle text-warning mr-1"></i>Pending</span>';
                        else if(add_mastRow.status == 1)
                            row += '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Successful</span>';
                        else if(add_mastRow.status == 2)
                            row += '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Canceled</span>';
                        row += '</td>';
                        row += '<td  class="d-flex justify-content-end"><button type="button" class="btn btn-sm btn-success p-1 px-2 m-1" id="edit_data" data-id="'+add_mastRow.id+'"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button><button type="button" class="btn btn-sm btn-info p-1 px-2 m-1" id="view_data" data-id="'+add_mastRow.id+'"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button></td>';

                        if($("#storeTransferId").val()){
                            $("#row_master_table_" + add_mastRow.id).replaceWith(row);
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
        $.ajax({
            url:'{{ route('store_transfer.edit')}}',
            method:'GET',
            dataType:"JSON",
            data:{id:id},
            success:function(response){
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
            url:'{{ route('store_transfer.edit')}}',
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
        var data = response.data;

        $("#storeTransferId").val(data.id);
        $('#inv_no').html(data.inv_no);
        $("#inv_date").val(data.inv_date);
        $("#vat").val(data.inv_date);
        $("#tax").val(data.inv_date);
        $('#remarks').html(data.remarks);

        if(check == 1){ //edit => 1
            $(".modal-title").html('@if($type == 1) AC Requsition Edit @elseif($type == 2) AC Spare Parts Requsition Edit @else Car Spare Parts Requsition Edit @endif');

            $("#storeTransferId").prop("disabled", false);
            $('#inv_no').prop("disabled", false);
            $("#inv_date").prop("disabled", false);
            $("#vat").prop("disabled", false);
            $("#tax").prop("disabled", false);
            $('#remarks').prop("disabled", false);
            $('#from_store_id').prop("disabled", false);
            $('#mast_work_station_id').prop("disabled", false);

            
            $(".table_action").show();
            $('.submit_btn').show();
        }else{ //View => 2
            $(".modal-title").html('@if($type == 1) AC Requsition View @elseif($type == 2) AC Spare Parts Requsition View @else Car Spare Parts Requsition View @endif');

            $("#storeTransferId").prop("disabled", true);
            $('#inv_no').prop("disabled", true);
            $("#inv_date").prop("disabled", true);
            $("#vat").prop("disabled", true);
            $("#tax").prop("disabled", true);
            $('#remarks').prop("disabled", true);
            $('#from_store_id').prop("disabled", true);
            $('#mast_work_station_id').prop("disabled", true);

            $('.table_action').hide();
            $('.submit_btn').hide();
        }

        //--Get Store Data
        var get_store = response.store;
        var work_stationr_dr = $('#mast_work_station_id');
        work_stationr_dr.empty();
        work_stationr_dr.append('<option disabled>--Select--</option>');
        $.each(get_store, function(index, option) {
            var selected = (option.id == data.mast_work_station_id) ? 'selected' : '';
            work_stationr_dr.append('<option value="' + option.id + '" ' + selected + '>' + option.store_name + '</option>');
        });

        
        //--Tabel Sales Details
        var tableBody = $('#table-body');
        tableBody.empty();
        var store_transferDetails = response.store_transfer;
        var total = 0;
        var i = 0;
        if(check == 1){ //Edit - 1
            $.each(store_transferDetails, function(index, item) {
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
            $.each(store_transferDetails, function(index, item) {
                var subtotal = item.qty * item.price;
                var row = '<tr id="row_todo_'+ item.id + '">';
                row += '<td>' + item.part_name + '</td>';
                row += '<td>' + item.part_no + '</td>';
                row += '<td>' + item.box_qty + '</td>';
                row += '<td>' + item.unit_name + '</td>';
                row += '<td>' + item.qty + '</td>';
                row += '</tr>';
                tableBody.prepend(row);

                $(this).find('.subtotal').text(subtotal.toFixed(2));
                total += subtotal;
            });
            $('#total').text(total.toFixed(2));
            
            $('#edit_add_show').hide();
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
                    url: "{{ url('store/transfer/destroy')}}" + '/' + id,
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
        var id = $('#storeTransferId').val();
        $.ajax({
            url:'{{ route('getDelete-master-storeTransfer')}}',
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