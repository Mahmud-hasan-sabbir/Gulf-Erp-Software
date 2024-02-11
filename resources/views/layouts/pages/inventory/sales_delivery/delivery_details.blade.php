<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Delivery Details</h4>
                    <a href="{{ route('sales-delivery.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong> Order No :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->inv_no}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Order Date :</strong></label>
                                <label class="col-6 col-form-label">{{date("j F, Y", strtotime($sales->inv_date))}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Customer Name :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->mastCustomer->name}}</label>
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
                                <th>Deli. Qty</th>
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
                                    <td>{{$row->deli_qty ?? '0' }}</td>
                                    <td>{{$row->qty * $row->price}}</td>
                                    <td class="text-right">
                                        @if ($row->qty == $row->deli_qty)  
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Successful
                                        </span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $row->id }}"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add</button>
                                            {{-- <button type="button" class="btn btn-sm btn-primary p-1 px-2" id="upload_excel" data-id="{{ $row->id }}"><i class="fa fa-paperclip"></i></i><span class="btn-icon-add"></span>Upload</button> --}}
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

    <!--============//Excel Upload Modal Data//================-->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">SL No. Upload Excel File</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-2">
                    <label class=col-form-label>Please Upload CSV in Given <a href="#" class="text-danger">Format</a></label>
                    <div class="row">
                        <label class="col-md-4 col-form-label">Upload Excel File</label>
                        <div class="col-md-8">
                            <input type="file" name="sl_no" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--============//Add Sl No. Modal Data//================-->
    <div class="modal fade" id="modalGrid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Delivery </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('sales-delivery.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Invoice No.</strong> </label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="inv_no"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Invoice Date</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="inv_date"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label px-0"><strong>Invoice Type</strong></label>
                                    <div class="col-md-7">
                                        <label class=col-form-label id="inv_type"></label>
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
                                        <label class=col-form-label id="getPartNo"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label px-0"><strong>Remarks</strong></label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" id="remarks" disabled></textarea>
                                    </div>
                                </div>
                            </div> 
                            <input type="hidden" id="workStationId" name="mast_work_station_id" value="{{ Auth::user()->mast_work_station_id }}">
                            
                            <input type="hidden" id="itemRegisterId" name="item_register_id">
                            <input type="hidden" id="getDeliQty">
                            <input type="hidden" id="qty">
                            <input type="hidden" id="deliQty" name="deli_qty">
                            <input type="hidden" id="salesId" name="sales_id">
                            <input type="hidden" id="mastCustomerId" name="mast_customer_id">
                            <input type="hidden" id="salesDetailsId" name="sales_details_id">
                            <input type="hidden" id="price" name="price">
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
            url:'{{ route('get_sales_details')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id': id},
            success:function(response){
                $('#inv_no').html(response.inv_no);
                $("#inv_type").html(response.cat_name);
                $("#inv_date").html(response.inv_date);
                $("#mast_customer_id").html(response.name);
                $('#remarks').html(response.remarks);

                //---SetUp
                $('#itemRegisterId').val(response.item_register_id);
                $('#qty').val(response.qty);
                $('#getDeliQty').val(response.deli_qty);
                $('#deliQty').val(response.deli_qty + 1);
                $('#getPartNo').html(response.part_no);
                $('#salesId').val(response.sales_id);
                $('#mastCustomerId').val(response.mast_customer_id);
                $('#salesDetailsId').val(response.id);
                $('#price').val(response.price);

                var storeId= $('#workStationId').val();

                getSlNo(response.item_register_id, storeId);
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
        $("#modalGrid").modal('show');
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

    $(document).on('change','#workStationId', function() {
        var valItemRegisterId = parseInt($('#itemRegisterId').val());
        var storeId= $('#workStationId').val();
        getSlNo(valItemRegisterId, storeId);
    });
    
    //-----Get Serial Number
    function getSlNo(item_register_id, storeId) {
        var currentRow = $('#items-table tbody').find("tr:last");
        var dataArray = [1, 3, 4];
        $.ajax({
            url:'{{ route('get-serial-no')}}',
            method:'GET',
            dataType:"JSON",
            data:{'mast_item_register_id':item_register_id, 'mast_work_station_id':storeId, 'reference_type_id':dataArray, 'status': 1},
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
    /*=======//GRN Purchase Upload Modal//=========*/
    $(document).on('click','#upload_excel', function(){
        var id = $(this).data('id');
        $("#exampleModalCenter").modal('show');
    });
    /*=======//GRN Purchase Save Data//=========*/
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
            }
        });
        if (allValuesNotNull) {
            
            var qty = parseInt($('#qty').val());
            var checkDeliQty = parseInt($('#getDeliQty').val());
            var checkQty = qty - checkDeliQty;
            var rowCount = parseInt($('#items-table tbody tr').length) + 1;
            if(checkQty >= rowCount){
                ++count;
                addRow(count);
                //--------------------
                var valItemRegisterId = parseInt($('#itemRegisterId').val());
                var storeId= $('#workStationId').val();
                getSlNo(valItemRegisterId, storeId);
                //--------------------
                var qtyResult = checkDeliQty + rowCount;
                $('#deliQty').val(qtyResult);
            }else{
                Swal.fire(
                    'Done',
                    'Your already fill up all data!',
                    'question'
                )
            }
        } else {
            swal("Error!", "All input values are not null or empty.", "error");
        }
    });

    function addRow(i){
        var rowCount = parseInt($('#items-table tbody tr').length) + 1;
        var newRow = $('<tr>' +
            '<td><label class=col-form-label>'+rowCount+'</label></td>' +
            '<td><select id="serialNumber" name="moreFile['+i+'][serial_no]" class="form-control dropdwon_select val_serial_no"></select></td>' +
            '<td class="text-center">' +
                '<button type="button" title="Add New" class="btn btn-icon btn-outline-warning border-0 btn-xs add-row"><span class="fa fa-plus"></span></button>' +
                '<button type="button" title="Remove" class="btn btn-icon btn-outline-danger btn-xs border-0 remove-row"><span class="fa fa-trash"></span></button>' +
            '</td>'+
        '</tr>');
    
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
        var removeDeliQty= $('#deliQty').val(); 
        $('#deliQty').val(removeDeliQty - 1);
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
                data:{'item_register_id':valItemRegisterId, 'storeId':storeId},
                data:{'mast_item_register_id':valItemRegisterId, 'mast_work_station_id':storeId, 'reference_type_id':[1, 3], 'status': 1},
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



