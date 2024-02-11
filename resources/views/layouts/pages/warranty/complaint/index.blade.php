<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Complaint List</h4>
                    <a href="{{ route('warranty-customer-list.show') }}" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Create</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Issue No</th>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->issue_no }}</td>
                                        <td>{{ $item->issue_date }}</td>
                                        <td>{{ $item->mastCustomer->name }}</td>
                                        <td>{{ $item->mastCustomer->phone }}</td>
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
                                                <i class="fa fa-circle text-danger mr-1"></i>Canceled
                                            </span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <button type="button" id="view_compliant" data-id="{{ $item->id }}" class="btn btn-sm btn-info p-1 px-2" ><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>view</button>
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


    <!-- Modal open-->
    <div class="modal fade bd-example-modal-lg" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Complaints </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Issue Date:</label>
                                <label class="col-md-5 col-form-label" id="issue-date"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Issue No:</label>
                                <label class="col-md-5 col-form-label" id="issue-no"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Customer Name:</label>
                                <label class="col-md-5 col-form-label" id="customerName"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Compliant Type:</label>
                                <label class="col-md-5 col-form-label" id="compliantType"></label>
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
                        <label for="" class="col-form-label text-right">Remarks:</label>
                        <textarea name="remarks" id="remarks" rows="3" class="form-control" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).on('click', '#view_compliant', function(){
        var id = $(this).data('id');
        $('.bd-example-modal-lg').modal('show');
        $.ajax({
            url:'{{ route('get-compliant-show')}}',
            method:'GET',
            dataType:"JSON",
            data:{'id':id},
            success:function(response){
                console.log(response);
                $('#issue-date').text(response.issue_date);
                $('#issue-no').text(response.issue_no);
                $('#customerName').text(response.mast_customer.name);
                $('#compliantType').text(response.compliant_type.name);

                // $('#customerName').val(response.viewCompliant.mastCustomer.name);
                // $('#compliantType').val(response.viewCompliant.compliant_type.name);
                // Parse the 'note' JSON string and display its content
                var tableBody = $('#table-body');
                tableBody.empty();

                var noteData = JSON.parse(response.note);
                var noteHtml = '';
                var slNo = 1;

                noteData.forEach(function (item) {
                    var warranty = item.warranty_status == "Yes" ? 'success' : 'danger';

                    noteHtml += '<tr>';
                    noteHtml += '<td>' + slNo++ + '</td>';
                    noteHtml += '<td>' + item.part_no + '</td>';
                    noteHtml += '<td>' + item.part_name + '</td>';
                    noteHtml += '<td>' + item.serial_no + '</td>';
                    noteHtml += '<td>' + item.sales_date + '</td>';
                    noteHtml += '<td>' + item.install_loc + '</td>';
                    noteHtml += '<td class="warranty_status"><span class="badge light badge-' + warranty + '"><i class="fa fa-circle text-' + warranty + ' mr-1"></i>' + item.warranty_status + '</span></td>';
                    noteHtml += '</tr>';
                });
                tableBody.append(noteHtml);

                $('#remarks').text(response.remarks);
            }
        });
    });
</script>
