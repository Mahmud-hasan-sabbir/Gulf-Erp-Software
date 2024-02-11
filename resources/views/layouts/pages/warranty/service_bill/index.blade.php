<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Service Bill</h4>
                </div>
                <div class="card-body">           
                    <div class="form-group row">
                        <label class="col-md-2 mt-2"><h5>Start Date: </h5></label>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="start_date" placeholder="Enter Date.." id="date">
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
                                        <th>Issue No</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Mobile</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-center">Service Bill</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach($service as $data)
                                    <tr>
                                        <td>{{ $data->issue_no}}</td>
                                        <td>{{ $data->issue_date}}</td>
                                        <td>{{ $data->custo->name}}</td>
                                        <td>{{ $data->custo->phone}}</td>
                                        <td>{{ $data->remarks}}</td>
                                        <td>@if($data->status == 0)
                                              <span class="badge light badge-warning">
                                                <i class="fa fa-circle text-warning mr-1"></i>Pending
                                              </span>
                                                @elseif($data->status == 1)
                                                <span class="badge light badge-success">
                                                    <i class="fa fa-circle text-success mr-1"></i>Successful
                                                </span>
                                                @elseif($data->status == 2)
                                             <span class="badge light badge-danger">
                                             <i class="fa fa-circle text-danger mr-1"></i>Canceled
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-primary p-1 px-2" id="service_bill" data-id="{{ $data->id }}"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button>
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
                        Service Bill
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" data-action="{{ route('service-bill.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="pur_id" id="pur_id">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Complaint ID</label>
                                    <div class="col-md-7">
                                        <select name="complaint_id" id="complaintID" class="form-control dropdwon_select" required>
                                        <option selected disabled>--Select--</option>
                                            @foreach($service as $row)
                                            <option value="{{ $row->id}}">{{ $row->issue_no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Complaint ID</label>
                                    <div class="col-md-7">
                                        <label class="col-md-5 col-form-label" id="inv_no">COMPLAINT-XXXXX</label>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                      <option value="{{$data->id}}">{{$data->custo->name}}</option> 
                                        <!-- <label class="col-md-5 col-form-label" id="inv_no">Serniabat</label> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Complaint Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="date" name="complaint_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
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
                                    <label class="col-md-5 col-form-label">Bill No.</label>
                                    <div class="col-md-7">
                                        <label class="col-md-5 col-form-label" id="requ_no">BILL NO--</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Bill Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="date" name="bill_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Technician Visits</label>
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
                                                <th width="20%">Date</th>
                                                <th width="20%">Technician Name</th>
                                                <th width="35%">Observe Details</th>
                                                <th width="20%">Action
                                                    <button type="button"  title="Add"
                                                    onclick=""
                                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 new_add">
                                                    <span class="fa fa-plus"></span>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                          @foreach($bill as $serv)
                                            <tr>
                                                <td>{{ $serv->job_date }}</td>
                                                <td>{{ $serv->tech_id}}</td>
                                                <td>{{ $serv->observe_details}}</td>
                                                <td>
                                                    <div style="display: flex">
                                                        <button id="new_add" type="button" title="Add" onclick="" class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 new_add">
                                                            <span class="fa fa-plus"></span>
                                                        </button>

                                                        <button type='button' id="cut_new" title="Remove"
                                                                data-row='row1'
                                                                onclick=""
                                                                class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 cut_new'>
                                                            <span class='fa fa-trash'></span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                    </table>
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
                                                <th width="15%">Item Code</th>
                                                <th width="15%">Item Name</th>
                                                <th width="10%">Pkg</th>
                                                <th width="10%">Unit</th>
                                                <th width="10%">Price</th>
                                                <th width="10%">Qty</th> 
                                                <th width="15%">Total</th> 
                                                <th width="15%" class="text-center table_action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @foreach($details as $data)
                                            <tr>
                                                <td>{{$data->mastItemRegister->part_no}}</td>
                                                <td>{{$data->mastItemRegister->mastItemGroup->part_name}}</td>
                                                <td>{{$data->mastItemRegister->box_qty}}</td>
                                                <td>{{$data->mastItemRegister->unit->unit_name}}</td>
                                                <td class="price">{{$data->mastItemRegister->price}}</td>
                                                <td class="quantity">{{$data->qty}}</td>
                                                <td><span class="total" id="total">0.00</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger" id="" data-id=""><i class="fa fa-trash" ></i><span class="btn-icon-add"></span>Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Print</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    /*=======//Save Data //=========*/
    $(document).ready(function(){
        var form = '#add-user-form';
        $(form).on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            var allSubValuesNotNull = true;
            
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

                        if($("#pur_id").val()){
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
</script>


<script>

    $(document).on('click','#service_bill',function () {
        var item_id = $(this).data('id');
        alert(item_id);

        $.ajax({
            url:'{{ route('get-bill')}}',
            method:'GET',
            dataType:"JSON",
            data:{'item_id':item_id},
            success:function(response){
                console.log(response);
                $('#complaintType').val(response.complaintType.name);
                // $('#complianttype').val(response.viewCompliant.compliant_type.name);
                // $('#remarks').val(response.viewCompliant.remarks);
                // $('#code').val(response.viewCompliant.note);
                // $('#warranty').val(response.viewCompliant.with_warranty == 1?'Yes':'no');

            }
        });
    });
    

</script>


<script>
    $('#items-table').on('input', '.quantity, .price', function() {
        updateSubtotal(0);
    });
    function updateSubtotal(update_subTotal) {
        var total = 0;
        $('#items-table tbody tr').each(function() {
            var quantity = parseFloat($(this).find('.quantity').val()) || 0;
            var price = parseFloat($(this).find('.price').val()) || 0;
            var total = quantity * price;
            $(this).find('.total').text(total.toFixed(2));
            total += total;
        });
        var update_total = total - update_subTotal;
        $('#total').text(update_total.toFixed(2));
    }
</script>


<!-- <script>
    $(document).ready(function() {
        $('#item-table').on('change', '.quantity, .price', function() {
            var row = $(this).closest('tr');
            var qty = parseFloat(row.find('.quantity').val());
            var price = parseFloat(row.find('.price').val());
            // alert('hi');

            $.ajax({
                url: '{{ route('calculate-total')}}',
                type: 'POST',
                data: { quantity: qty, price: price },
                dataType: 'json',
                success: function(data) {
                row.find('.total').text(data.total);
                }
                });
            });
        });
</script> -->

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


    $("#audit-design-matrix-table").on("click", "#new_add", function() {
        $('#audit-design-matrix-table > tbody:last').append(
        `<tr class="audit_design_matrix_row">
        <td><input type="text" name="" class="form-control"></td>
                <td>
                    <div style="display: flex">
                         <button id="new_add" type="button" title="Add"
                        onclick=""
                        class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 new_add">
                        <span class="fa fa-plus"></span>
                        </button>

                        <button type='button' title="Remove"
                     data-row='row1'
                         onclick=""
                         class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 cut_new'>
                        <span class='fa fa-trash'></span>
                        </button>
                        </div>
                 </td>
        </tr>`
    );
    });

    $("#audit-design-matrix-table").on("click", "#cut_new", function() {
        $(this).closest("tr").remove();
    });

</script>