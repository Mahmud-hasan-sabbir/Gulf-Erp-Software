<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Requstion Delivery Reports</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Customer Name</th>
                                    <th>Type</th>
                                    <th>Item</th>
                                    <th>Total Qty</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sales_tbody">
                                @foreach ($data as $keys=> $row)
                                @php
                                    $total = 0;
                                    $qty = 0;
                                    $item = 0;
                                    foreach ($row->storeTransferDetails as $key => $value) {
                                        $total += $value->qty * $value->price;
                                        $qty += $value->qty;
                                        $item += 1;
                                    }
                                @endphp
                                <tr id="row_sales_table_{{ $row->id}}">
                                    <td>{{++$keys}}</td>
                                    <td>{{$row->inv_no}}</td>
                                    <td>{{$row->inv_date}}</td>
                                    <td>{{$row->mastWorkStation->store_name ?? 'NULL'}}</td>
                                    <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                    <td id="details_data" data-id="{{ $row->id }}"><span style="cursor: pointer" class="badge badge-pill badge-success badge-rounded">{{ $item }}</span></td>
                                    <td>{{$qty }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('store-delivery.download', $row->id)}}" class="btn btn-sm btn-secondary p-1 mt-1 px-2"><i class="fa fa-print"></i></i><span class="btn-icon-add"></span>Print</a>
                                        <a href="{{ route('store-delivery-details-parsial', $row->id) }}" class="btn btn-sm btn-info p-1 mt-1 px-2"><i class="fa fa-info"></i></i><span class="btn-icon-add"></span>Details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--============//Show Modal Data//================-->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Requstion Details</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <label class="col-6 col-form-label"><strong> Invoice No :</strong></label>
                                        <label class="col-6 col-form-label" id="inv_no"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <label class="col-6 col-form-label"><strong>Invoice Date :</strong></label>
                                        <label class="col-6 col-form-label" id="inv_date"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <label class="col-6 col-form-label"><strong>To Store :</strong></label>
                                        <label class="col-6 col-form-label" id="mast_work_station_id"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <label class="col-6 col-form-label"><strong>From Store :</strong></label>
                                        <label class="col-6 col-form-label" id="from_store"></label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="items-table" class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL#</th>
                                            <th>Category</th>
                                            <th>Group Name</th>
                                            <th>Part No.</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body"></tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-4">
                                    <div class="float-right">
                                        <h6>Total <span style="border: 1px solid #2222;padding: 10px 40px;margin-left:10px" id="total">0.00</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>


<script>
    /*=======//View Details Add Modal//=========*/
    $(document).on('click', '#details_data', function() {
    var id = $(this).data('id');
    $('#table-body').empty();
        $.ajax({
            url: '{{ route('get_store_transfer_approve_details')}}',
            method: 'GET',
            dataType: "JSON",
            data: {'id': id},
            success: function(response) {
                var dataMast = response.storeTransfer;

                $('#inv_no').html(dataMast.inv_no);
                $("#inv_date").html(dataMast.inv_date);
                $("#mast_work_station_id").html(dataMast.to_store_name);
                $("#from_store").html(dataMast.from_store_name);
                $('#remarks').html(response.remarks);

                var dataDetails = response.data;
                var total = 0; // Variable to hold the total value
                $.each(dataDetails, function(index, item) {
                    var subtotal = item.qty * item.price;
                    var row = '<tr id="row_todo_'+ item.id + '">';
                    row += '<td>' + (index + 1) + '</td>'; // Add SL# column
                    row += '<td>' + item.cat_name + '</td>'; // Add Category column
                    row += '<td>' + item.part_name + '</td>'; // Add Group Name column
                    row += '<td>' + item.part_no + '</td>';
                    row += '<td>' + item.qty + '</td>';
                    row += '</tr>';
                    $('#table-body').append(row);

                    total += subtotal;
                });
                // Update the total value in the HTML
                $('#total').html(total.toFixed(2));
            },
            error: function(response) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
        $(".bd-example-modal-lg").modal('show');
    });

</script>
