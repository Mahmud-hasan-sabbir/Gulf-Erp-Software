<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Job Card list</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Tecnician name</th>
                                    <th>Tecnician Id</th>
                                    <th>Tecnician Number</th>
                                    <th>Job No</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tecnician as $key=> $item )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->employee_code}}</td>
                                    <td>{{ $item->contact_number}}</td>
                                    <td id="jobNo_{{$item->id}}">{{$item->cnt}} / 3</td>
                                    <td class="text-right" id="action_{{$item->id}}">
                                        @if($item->cnt < 3)
                                            <button type="button" id="show-data" data-check="0" data-id="{{ $item->id }}" class="btn btn-sm btn-success p-1 px-2" ><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Add Work</button>
                                        @else
                                            <button type="button" id="show-data" data-check="1" data-id="{{ $item->id }}" class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-folder"></i><span class="btn-icon-add"></span>View</button>
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


    <!-- Modal open-->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Technician New List</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body pt-2">
                    <input type="hidden" id="tech_id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"><strong>Date:</strong></label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="cur_date" value="{{date('Y-m-d')}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group row view-hide">
                                <label class="col-md-12 col-form-label"><strong>New Complian &nbsp;</strong>
                                    <input type="checkbox" id="newComplian">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label"><strong>Technician Name:</strong></label>
                                <label class="col-md-7 col-form-label" id="technicin_name">Technician Name:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group row justify-content-end">
                                <label class="col-md-9 col-form-label text-right"><strong>Job No:</strong></label>
                                <label class="col-md-3 col-form-label" id="job-no"></label>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="height: 100%; overflow-y: auto">
                        <div class="col-md-12">
                            <!--=====//Table//=====-->
                            <div class="table-responsive">
                                <table id="items-table" class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th width="10%">Date</th>
                                            <th width="15%">Customer</th>
                                            <th width="10%">Number</th>
                                            <th width="25%">Description</th>
                                            <th width="25%">Note</th>
                                            <th width="5%">View</th>
                                            <th width="10%" class="view-hide">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script type="text/javascript">
        $(document).on('change', '#newComplian', function() {
            var id = $('#tech_id').val();
            var check = $(this).is(':checked') ? 2 : 0;
            filterCom(id, check);
        });

        $(document).on('click', '#show-data', function() {
            var id = $(this).data('id');
            $('#tech_id').val(id);
            var check = $(this).data('check');
            filterCom(id, check);
        });

        function filterCom(id, check){
            $.ajax({
                url: '{{ route('get-complaint-details') }}',
                method: 'GET',
                dataType: 'JSON',
                data: { 'id': id, 'check':check},
                success: function(response) {
                    $('.bd-example-modal-lg').modal('show');
                    $('#tech_id').val(id);
                    $('#technicin_name').text(response.technicin_name);

                    var setJobNo = $('#job-no');
                    setJobNo.text(response.jobNo);

                    var tableBody = $('#table-body');
                    tableBody.empty();
                    var sl = 1;
                    $.each(response.compliant, function(index, item) {
                        var row = '<tr id="row_todo_' + item.id + '">';
                        row += '<td>' + sl++ + '</td>';
                        row += '<td>' + item.issue_date + '</td>';
                        row += '<td>' + item.mast_customer.name + '</td>';
                        row += '<td>' + item.mast_customer.phone + '</td>';
                        row += '<td>' + item.remarks + '</td>';
                        row += '<td>';
                        row += '<button class="toggle-button btn btn-sm btn-info p-1 px-2" data-toggle-id="note_' + item.id + '">Toggle Note</button>';
                        row += '<div id="note_' + item.id + '" style="display: none;">';
                        row += noteData(item.note);
                        row += '</div>';
                        row += '</td>';

                        row += '<td>' + item.visit + '</td>';
                        var isDisabled = (item.tech_id !== null || response.jobNo >= 3) ? 'disabled' : '';
                        row += '<td class="view-hide"><button type="submit" ' + isDisabled + ' style="width:85px" class="btn btn-sm btn-secondary p-1 px-2 assign-button" data-row-id="' + item.id + '"><i class="fa fa-briefcase"></i><span class="btn-icon-add"></span>Assign</button></td>';
                        row += '</tr>';
                        tableBody.append(row);
                    });

                    // View event listener for buttons
                    if(check == 1){
                        $('.view-hide').hide();
                    }else{
                        $('.view-hide').show();
                    }

                    // Add event listener for the toggle buttons
                    $('.toggle-button').on('click', function() {
                        var toggleId = $(this).data('toggle-id');
                        $('#' + toggleId).toggle();
                    });

                    // Add event listener for the Assign Submit buttons
                    $('.assign-button').on('click', function() {
                        var button = $(this); // Store the button element in a variable
                        var compliant_id = button.data('row-id');
                        var tech_id = $('#tech_id').val();
                        $.ajax({
                            url: '{{ route('warranty-jobcard.store') }}',
                            method: 'GET',
                            dataType: 'JSON',
                            data: { 'tech_id': tech_id, 'compliant_id': compliant_id },
                            success: function(response) {
                                $('#job-no').text(response.jobNo);
                                $('#jobNo_' + response.data.tech_id).text(response.jobNo + ' / 3');

                                // Disable Assign Button Or Show View Button
                                if (response.jobNo >= 3) {
                                    $('.assign-button').prop('disabled', true);
                                    var newButton = '<button type="button" id="edit_data"  class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-folder"></i><span class="btn-icon-add"></span>View</button>';
                                    $('#action_' + response.data.tech_id).html(newButton);
                                } else {
                                    button.prop('disabled', true);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    });

                },
                error: function(xhr, status, error) {
                    console.log(error);
                    $('#loading').hide();
                }
            });
        }
    
        function noteData(note){
            var row = ''; // Initialize the row variable
            try {
                var noteData = JSON.parse(note);
                noteData.forEach(function (noteItem) {
                    row += '<ul class="my-3">';
                    row += '<li><strong>Part Number:</strong> ' + noteItem.part_no + '</li>';
                    row += '<li><strong>Part Name:</strong> ' + noteItem.part_name + '</li>';
                    row += '<li><strong>Serial Number:</strong> ' + noteItem.serial_no + '</li>';
                    row += '<li><strong>Warranty Status:</strong> ' + noteItem.warranty_status + '</li>';
                    row += '</ul>';
                });
            } catch (e) {
                row += '<p>Error parsing note data: ' + e.message + '</p>';
            }
            return row;
        }
    </script>
    
    @endpush
</x-app-layout>
