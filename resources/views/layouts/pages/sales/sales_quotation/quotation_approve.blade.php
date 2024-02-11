<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Quotation Approve</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Customer Name</th>
                                    <th>Invoice Type</th>
                                    <th>Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                    @php
                                        $total = 0;
                                        foreach ($row->quotationDetails as $value) {
                                            $total += $value->qty * $value->price;
                                        }
                                    @endphp
                                    <tr id="row_todo_{{$row->id}}">
                                        <td>{{++$key}}</td>
                                        <td id="details_data" data-id="{{ $row->id }}" style="cursor: pointer" class="text-info">{{$row->quot_no}}</td>
                                        <td>{{$row->quot_date}}</td>
                                        <td>{{$row->mastCustomer->name ?? 'NULL'}}</td>
                                        <td>{{$row->mastItemCategory->cat_name ?? 'NULL'}}</td>
                                        <td>{{$total }}</td>
                                        <td class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-info p-1 mr-1" data-id="{{ $row->id }}" id="open_model">Approve</button>                   
                                            <form action="{{route('sales_quotation.canceled', $row->id)}}" method="post">
                                                <button class="btn btn-sm btn-danger p-1">Canceled</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
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
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sales Quotation Details</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 pr-0">
                                    <div class="row">
                                        <label class="col-5 col-form-label"><strong> Invoice No :</strong></label>
                                        <label class="col-7 col-form-label" id="inv_no"></label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 px-0">
                                    <div class="row">
                                        <label class="col-6 col-form-label"><strong>Invoice Date :</strong></label>
                                        <label class="col-6 col-form-label" id="inv_date"></label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 px-0">
                                    <div class="row">
                                        <label class="col-6 col-form-label"><strong>Customer Name :</strong></label>
                                        <label class="col-6 col-form-label" id="mast_customers"></label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 pl-0">
                                    <div class="row">
                                        <label class="col-5 col-form-label"><strong>Store Name :</strong></label>
                                        <label class="col-7 col-form-label" id="store_name"></label>
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
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
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

            <!--============//Save & Approve//================-->
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="form-valide" data-action="{{ route('sales_quotation.approve') }}" method="POST" enctype="multipart/form-data" id="add-user-attendacne-id">
                            @csrf
                            <input type="hidden" name="set_id" id="set_id">
                            <div class="modal-header">
                                <h5 class="modal-title">Approve Quotation</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Purchase Order No
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control @error('ref_no') is-invalid @enderror" id="ref_no" name="ref_no" value="{{old('ref_no')}}">
                                            @error('ref_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">Purchase Order Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="date" class="form-control @error('ref_date') is-invalid @enderror" id="ref_date" name="ref_date" value="{{old('ref_date')}}">
                                            @error('ref_date')
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

        </div>
    </div>
    @push('script')
    <!--____________// VIEw DETAILS \\____________-->
    <script type="text/javascript">
        $(document).on('click', '#details_data', function() {
            var id = $(this).data('id');
            $('#table-body').empty();
            $('#loading').show();
            $.ajax({
                url: '{{ route('get_quotation_details')}}',
                method: 'GET',
                dataType: "JSON",
                data: {'id': id},
                success: function(response) {
                    var dataMast = response.quotation;

                    $('#inv_no').html(dataMast.quot_no);
                    $("#inv_date").html(dataMast.quot_date);
                    $("#mast_customers").html(dataMast.name);
                    $("#store_name").html(response.store);
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
                        row += '<td>' + item.price + '</td>';
                        row += '<td>' + item.qty + '</td>';
                        row += '<td>' + subtotal + '</td>';
                        row += '</tr>';
                        $('#table-body').append(row);

                        total += subtotal;
                    });
                    // Update the total value in the HTML
                    $('#total').html(total.toFixed(2));
                    
                    $('#loading').hide();
                    $(".bd-example-modal-lg").modal('show');
                },
                error: function(response) {
                    swal("Error!", "All input values are not null or empty.", "error");
                }
            });
        });
    </script>
    <!--____________// SAVE APPROVE \\____________-->
    <script type="text/javascript">
        $(document).on('click', '#open_model', function() {
            var id = $(this).data('id');
            $('#set_id').val(id);
            $('#exampleModalCenter').modal('show');
        });

        /*============// Save Data //==========*/
        var form = '#add-user-attendacne-id';
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
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
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    $('#exampleModalCenter').modal('hide');
                    $("#row_todo_" + response.id).remove();
                    $('#loading').hide();
                },
                error: function (xhr) {
                    $('#loading').hide();
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
    </script>
    @endpush

</x-app-layout>

