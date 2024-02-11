<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Customer List</h4>
                    <a href="{{ route('warranty-complaint.index') }}" class="btn btn-sm btn-danger p-1 px-2 d-inline"><i class="fa fa-reply"></i></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>Customer Name</th>
                                    <th>Customer Number</th>
                                    <th>Address</th>
                                    <th>Customer Type</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer as $item)
                                    @php
                                        $check = DB::table('deliveries')->where('mast_customer_id', $item->id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->mastCustomerType->name }}</td>
                                        <td>
                                            <button type="button" id="add_item" data-id="{{ $item->id }}" {{ $check ? '' : 'disabled' }} class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New</button>
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

    <!-- add new click than modal open-->
    <div class="modal fade bd-example-modal-lg" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Creating Customer Complaints </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body py-2 px-4">
                    <form class="form-valide" data-action="{{ route('warranty-complaint.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                        @csrf
                            <div class="row">
                                <input type="hidden" name="mast_customer_id" id="customeId" value="">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Customer Name:</label>
                                        <label class="col-md-5 col-form-label" id="customerName"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Compliant Type:
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                        <select name="mast_complaint_type_id" class="form-control dropdwon_select">
                                                <option value="" selected disabled>Select Complaint Type</option>
                                                @foreach ($compliantType as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="height: 150px; overflow-y: auto">
                                <div class="col-md-12">
                                    <!--=====//Table//=====-->
                                    <div class="table-responsive">
                                        <table id="items-table" class="table table-bordered mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="5%">SL#</th>
                                                    <th width="15%">Item Code</th>
                                                    <th width="20%">Item Name</th>
                                                    <th width="15%">Serial No</th>
                                                    <th width="15%">Sale Date</th>
                                                    <th width="20%">Instalation Loc.</th>
                                                    <th width="10%">Warrenty</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label for="" class="col-md-2 col-form-label text-right"  style="font-weight: bold;margin-top:20px">Note:</label>
                                        <div class="col-md-10">
                                            <input type="hidden" name="note" id="note">
                                            <textarea id="textarea" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label for="" class="col-md-2 col-form-label text-right" style="font-weight: bold;margin-top:20px">Remarks:</label>
                                        <div class="col-md-10">
                                            <textarea name="remarks" id="remarks" rows="3" class="form-control"></textarea>
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
    /*=======//Save Data //=========*/
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
                    $(form).trigger("reset");
                    swal("Success Message Title", "Well done, you pressed a button", "success")
                    .then(function() {
                        $(".bd-example-modal-lg").modal('hide');
                        window.location.href = '{{ route('warranty-complaint.index') }}';
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

    /*=======//Show Data //=========*/
    $(document).on('click', '#add_item', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '{{ route('get-customer-details')}}',
            method: 'GET',
            dataType: "JSON",
            data: { 'customer_id': id },
            success: function (response) {
                $('#customerName').html(response.customer.name);
                $('#customeId').val(response.customer.id);

                var deliveryData = response.deliveries;
                var tableBody = $('#table-body');
                tableBody.empty();

                $.each(deliveryData, function (index, item) {
                    var row = '<tr id="row_todo_' + item.id + '">';
                    row += '<td><input type="checkbox" class="row-checkbox" name="row_checkbox"></td>';
                    row += '<td class="part_no" onclick="copyToRemarks(this, \'Part No: \');">' + item.part_no + '</td>';
                    row += '<td class="part_name" onclick="copyToRemarks(this, \'Part Name:\');">' + item.part_name + '</td>';
                    row += '<td class="serial_no" onclick="copyToRemarks(this, \'Serial No:\');">' + item.serial_no + '</td>';
                    row += '<td class="sales_date">' + item.inv_date + '</td>';
                    row += '<td class="install_loc">' + item.install_loc + '</td>';
                    if (item.warranty_status == 'Yes') {
                        row += '<td class="warranty_status"><span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>' + item.warranty_status + '</span></td>';
                    } else {
                        row += '<td><span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>' + item.warranty_status + '</span></td>';
                    }
                    row += '</tr>';
                    tableBody.append(row);
                });
                $('.bd-example-modal-lg').modal('show');
            },
            error: function (xhr, status, error) {
                swal("Error!", "All input values are not null or empty.", "error");
            }
        });
    });

    // Updated event delegation for checkboxes
    $(document).on('change', '.row-checkbox', function () {
        if ($(this).is(':checked')) {
            var row = $(this).closest('tr');
            copyToTextarea(row);
        }
    });
    
    function copyToTextarea(row) {
        var part_no = row.find('.part_no').text();
        var partName = row.find('.part_name').text();
        var serialNo = row.find('.serial_no').text();
        var sales_date = row.find('.sales_date').text();
        var install_loc = row.find('.install_loc').text();
        var warranty_status = row.find('.warranty_status').text();

        // Construct an object
        var dataObject = {
            part_no: part_no,
            part_name: partName,
            serial_no: serialNo,
            install_loc: install_loc,
            warranty_status: warranty_status
        };

        // Convert the object to a JSON => Send
        var dataJson = JSON.stringify(dataObject);
        var note = $("#note");
        var currentDataArray = JSON.parse(note.val() || '[]');
        currentDataArray.push(dataObject);
        var newDataJson = JSON.stringify(currentDataArray, null, 2);
        note.val(newDataJson);

        // Convert the object to a Data => Show
        var dataString = 'Part No: ' + part_no + ',\nPart Name: ' + partName + ',\nSerial No: ' + serialNo + ',\nWarranty Status: ' + warranty_status + '';
        var textarea = $("#textarea");
        textarea.val(textarea.val() + (textarea.val() ? ',\n\n' : '') + dataString);
    }

    function copyToRemarks(element, title) {
        const htmlContent = $(element).text();
        var remarks = $("#remarks");
        remarks.val(remarks.val() + title + ' ' + htmlContent + ' ');
        remarks.focus();
    }
</script>





