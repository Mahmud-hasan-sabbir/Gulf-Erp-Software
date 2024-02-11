
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Job Card </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Issue Date</th>
                                    <th>Customer</th>
                                    <th>Number</th>
                                    <th>Details</th>
                                    <th>Visit</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compliant as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{date("j F Y", strtotime($item->issue_date))}}</td>
                                    <td>{{ $item->mastCustomer->name }}</td>
                                    <td>{{ $item->mastCustomer->phone }}</td>
                                    <td>
                                        <!-- Button Details Modal -->
                                        <button type="button" class="btn btn-sm btn-secondary p-1 px-2" data-toggle="modal" data-target="#exampleModalCenter">
                                            <i class="fa fa-folder"></i><span class="btn-icon-add"></span>View
                                        </button>
                                    </td>
                                    <td>{{ $item->visit }}</td>
                                    <td class="text-right">
                                        <!-- Button Save modal -->
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            <i class="fa fa-bookmark"></i><span class="btn-icon-add"></span>Report
                                        </button>
                                    </td>
                                </tr>

                                 <!--=========// Details Modal//===========-->
                                 <div class="modal fade" id="exampleModalCenter">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Complaint Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body py-0">
                                                @php
                                                    try {
                                                        $noteData = json_decode($item->note);
                                                        if (!empty($noteData)) {
                                                            foreach ($noteData as $noteItem) {
                                                                echo '<ul class="my-3">';
                                                                echo '<li><strong>Part Number:</strong> ' . $noteItem->part_no . '</li>';
                                                                echo '<li><strong>Part Name:</strong> ' . $noteItem->part_name . '</li>';
                                                                echo '<li><strong>Serial Number:</strong> ' . $noteItem->serial_no . '</li>';
                                                                echo '<li><strong>Warranty Status:</strong> ' . $noteItem->warranty_status . '</li>';
                                                                echo '</ul>';
                                                            }
                                                        } else {
                                                            echo '<p>No note data available.</p>';
                                                        }
                                                    } catch (Exception $e) {
                                                        echo '<p>Error parsing note data: ' . $e->getMessage() . '</p>';
                                                    }
                                                    echo '<strong>Description</strong>';
                                                    echo '<textarea rows="3" class="form-control"" readonly>' . $item->remarks. '</textarea>';
                                                @endphp
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <!--=========// Save Data Modal//===========-->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> Technician Visit </h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <form class="form-valide" data-action="{{ route('store_job_visit') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                                                @csrf
                                                <div class="modal-body pt-2">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-form-label"><strong>Job Date</strong></label>
                                                                <label class="col-md-7 col-form-label">{{date('Y-m-d')}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-form-label"><strong>Technician Name</strong></label>
                                                                <label class="col-md-7 col-form-label">{{ $item->technician->name }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group row">
                                                                <label class="col-md-8 col-form-label"><strong>Job No</strong></label>
                                                                <label class="col-md-4 col-form-label">{{ $loop->iteration }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-form-label">In Time</label>
                                                                <div class="col-lg-7">
                                                                    <input type="time" name="isSpareParts" class="form-control" value=""  placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-form-label">Out Time</label>
                                                                <div class="col-lg-7">
                                                                    <input type="time" name="isSpareParts" class="form-control" value=""  placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <div class="col-lg-5">
                                                                    <input type="hidden" name="is_reporting_boss" value="0">
                                                                    <input type="checkbox" name="is_reporting_boss" value="1" id="check-next-date">
                                                                    <label class="form-check-label" for="check-next-date">Is Next Date?</label>
                                                                </div>
                                                                <div class="col-lg-7" style="display: none">
                                                                    <input type="text" name="" id="nextDate" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <div class="col-lg-5">
                                                                    <input type="hidden" name="is_reporting_boss" value="0">
                                                                    <input type="checkbox" name="is_reporting_boss" value="1" id="check-reporting-boss">
                                                                    <label class="form-check-label" for="check-reporting-boss">Complete</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-12 col-form-label">Description of Work</label>
                                                                <div class="col-lg-12">
                                                                    <textarea name="" id="" name="note" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-12 col-form-label">Details Deliverd Spare Parts</label>
                                                                <div class="col-lg-12">
                                                                    <textarea name="" id="" name="note" rows="3" class="form-control"></textarea>
                                                                </div>
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
                                @endforeach
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get references to the checkbox and the nextDate input field
        const checkbox = document.getElementById('check-next-date');
        const nextDateInput = document.getElementById('nextDate');
    
        // Add an event listener to the checkbox
        checkbox.addEventListener('change', function () {
            nextDateInput.style.display = this.checked ? 'block' : 'none';
        });
    </script>
    
    
    
    

</x-app-layout>

<script>
    $(document).on('click', '#show-data', function() {
        var id = $(this).data('id');
        $('.bd-example-modal-lg').modal('show');
    });
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
                    $('.bd-example-modal-lg').modal('hide');
                    console.log(response);
                    location.reload();
                }
            });
        });
        
    });
</script>
show-data