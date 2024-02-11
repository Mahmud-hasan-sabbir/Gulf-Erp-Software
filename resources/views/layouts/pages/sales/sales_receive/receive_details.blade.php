<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Receive Details</h4>
                    <a href="{{ route('sales-return.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong> Return No :</strong></label>
                                <label class="col-6 col-form-label">{{$mastData->return_no}}</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Return Date :</strong></label>
                                <label class="col-6 col-form-label">{{date("j F, Y", strtotime($mastData->return_date))}}</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Customer Name :</strong></label>
                                <label class="col-6 col-form-label">{{$mastData->name}}</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Store Name :</strong></label>
                                <label class="col-6 col-form-label">{{$mastData->mastWorkStation->store_name}}</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Category</th>
                                <th>Group Name</th>
                                <th>Part No.</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Rcv. Qty</th>
                                <th>Total</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->cat_name}}</td>
                                    <td>{{$row->part_name}}</td>
                                    <td>{{$row->part_no}}</td>
                                    <td>{{$row->price}}</td>
                                    <td>{{$row->qty}}</td>
                                    <td>{{$row->rcv_qty ?? '0' }}</td>
                                    <td>{{$row->qty * $row->price}}</td>
                                    <td class="text-right">
                                        @if ($row->qty == $row->rcv_qty)  
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Successful
                                        </span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $row->id }}"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add New</button>
                                        @endif
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

    <!--============//Add Sl No. Modal Data//================-->
    <div class="modal fade" id="modalGrid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sales Return </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('sales-receive.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Return No.</strong> </label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="return_no"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Return Date</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="return_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Customer</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="mast_customer_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Part No.</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="part_no"></label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="workStationId" name="mast_work_station_id" value="{{ Auth::user()->mast_work_station_id }}">
                            
                            <input type="hidden" id="itemRegisterId" name="item_register_id">
                            <input type="hidden" id="getRcvQty">
                            <input type="hidden" id="qty">
                            <input type="hidden" id="rcvQty" name="rcv_qty">
                            <input type="hidden" id="salesReturnId" name="sales_return_id">
                            <input type="hidden" id="salesReturnDetailsId" name="sales_return_details_id">
                        </div>

                        <div class="row">
                            <div class="col-md-12 pl-0">
                                <!--=====//Table//=====-->
                                <div class="table-responsive">
                                    <table id="items-table" class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="10%">SL#</th>
                                                <th width="65%">Serial No.</th>
                                                <th width="25%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body"></tbody>
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
    /*=======//GRN Purchase Add Modal//=========*/
    $(document).on('click','#edit_data', function(){
        var id = $(this).data('id');
        $.ajax({
            url:'{{ route('get-sales-receive-page')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id': id},
            success:function(response){

                $("#modalGrid").modal('show');

                var dataMast = response.data;
                $('#return_no').html(dataMast.return_no);
                $("#return_date").html(dataMast.return_date);
                $("#mast_customer_id").html(dataMast.name);
                $("#store_name").html(dataMast.store_name);
                
                //---SetUp
                $('#itemRegisterId').val(dataMast.mast_item_register_id);
                $('#qty').val(dataMast.qty);
                $('#getRcvQty').val(dataMast.rcv_qty);
                $('#rcvQty').val(dataMast.rcv_qty + 1);
                $('#part_no').html(dataMast.part_no);
                $('#salesReturnId').val(dataMast.sales_return_id);
                $('#salesReturnDetailsId').val(dataMast.id);

                var storeId= $('#workStationId').val();
                getSlNo(dataMast.mast_item_register_id, storeId);
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
        //--Dropdwon Search Fix
        $('.dropdwon_select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
        var tbody = $('#table-body');
        tbody.empty();
        addRow(0);
    });

    /*=========// Get Serial Number //=========*/
    function getSlNo(item_register_id, storeId) {
        var currentRow = $('#items-table tbody').find("tr:last");
        $.ajax({
            url:'{{ route('get-serial-no')}}',
            method:'GET',
            dataType:"JSON",
            data:{'mast_item_register_id':item_register_id, 'mast_work_station_id':storeId, 'reference_type_id':[2], 'status': 0},
            success:function(response){
                //--Get Serial Number
                var data_sl = response.data;
                var serial_number_dr = $('#items-table tbody').find("tr:last #serialNumber")
                serial_number_dr.empty();
                serial_number_dr.append('<option selected disabled>--Select--</option>');
                $.each(data_sl, function(index, option) {
                    serial_number_dr.append('<option value="' + option.id + '">' + option.serial_no + '</option>');
                });

            },
            error:function(){
                alert('Fail');
            }
        });
    }

    /*===========// Save Data//===========*/
    var form = '#add-user-form';
    $(form).on('submit', function(event){
        event.preventDefault();
        var url = $(this).attr('data-action');

        //--Validation then save
        var allValuesNotNull = true;
        $('.val_serial_no').each(function() {
            var value = $(this).val();
            if (value === null || value === '') {
                allValuesNotNull = false;
                return false;
            }
        });
        if (allValuesNotNull) {
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
                    $("#modalGrid").modal('hide');
                    swal("Your data save successfully", "Well done, you pressed a button", "success")
                    .then(function() {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    swal({
                        title: "No Data Found",
                        text: "There are no details available for this item.",
                        icon: "warning",
                        button: "OK",
                        dangerMode: true,
                    });
                }
            });
        } else {
            swal("Error!", "All input values are not null or empty.", "error");
        }
    });
</script>



<script type="text/javascript">
    //======Add ROW
    var count = 0;
    $('#items-table').on('click', '.add-row', function() {
        var allValuesNotNull = true;
        $('.val_serial_no').each(function() {
            var value = $(this).val();
            if (value === null || value === '') {
                allValuesNotNull = false;
                return false;
                alert('hi');
            }
        });
        if (allValuesNotNull) {
            var qty = parseInt($('#qty').val());
            var checkDeliQty = parseInt($('#getRcvQty').val());
            var checkQty = qty - checkDeliQty;
            var rowCount = parseInt($('#items-table tbody tr').length) + 1;
            if (checkQty >= rowCount) {
                ++count;
                addRow(count);
                //--------------------
                var valItemRegisterId = parseInt($('#itemRegisterId').val());
                var storeId = $('#workStationId').val();
                getSlNo(valItemRegisterId, storeId);
                //--------------------
                var qtyResult = checkDeliQty + rowCount;
                $('#rcvQty').val(qtyResult);
            } else {
                Swal.fire(
                    'Done',
                    'You have already filled up all data!',
                    'question'
                );
            }
        } else {
            Swal.fire('Error!', 'All input values are not null or empty.', 'error');
        }
    });

    function addRow(i) {
        var rowCount = parseInt($('#items-table tbody tr').length) + 1;
        var newRow = $('<tr>' +
            '<td><label class="col-form-label">' + rowCount + '</label></td>' +
            '<td><select id="serialNumber" name="moreFile[' + i + '][serial_no]" class="form-control dropdwon_select val_serial_no"></select></td>' +
            '<td class="text-center">' +
            '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
            '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
            '</td>' +
            '</tr>');

        $('#items-table tbody').append(newRow);
        //--Dropdwon Search Fix
        newRow.find('.dropdwon_select').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
    }

    //======Remove ROW
    $('#items-table').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        var removeDeliQty= $('#rcvQty').val(); 
        $('#rcvQty').val(removeDeliQty - 1);
    });

    //======Duplicates Part Number Validation
    $(document).on('change','.val_serial_no', function() {
        var dropdownValues = $('.val_serial_no').map(function() {
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
            $(this).val('');

            // Fetch new data for the current row
            var valItemRegisterId = parseInt($('#itemRegisterId').val());
            var storeId= $('#workStationId').val();
            var currentRow = $(this).closest('tr');
            var serialNumberDropdown = currentRow.find('.dropdwon_select.val_serial_no');
            serialNumberDropdown.empty();
            $.ajax({
                url: '{{ route('get-serial-no')}}',
                method: 'GET',
                dataType: "JSON",
                data:{'mast_item_register_id':valItemRegisterId, 'mast_work_station_id':storeId, 'reference_type_id':[2], 'status': 0},
                success: function(response) {
                    var data_sl = response.data;
                    serialNumberDropdown. append('<option selected>--Select--</option>');
                    $.each(data_sl, function(index, option) {
                        serialNumberDropdown.append('<option value="' + option.id + '">' + option.serial_no + '</option>');
                    });
                },
                error: function() {
                    alert('Failed to fetch data.');
                }
            }); 
            
        }
    });
    

</script>





