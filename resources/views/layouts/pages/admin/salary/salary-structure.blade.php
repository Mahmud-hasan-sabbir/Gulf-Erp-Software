<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Salary Structure Setting<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Employee Name</th>
                                    <th>Employee Code</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Finger ID</th>
                                    <th class="text-right pr-4">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $row)
                                <tr>
                                    <td class="sorting_1"><img class="rounded-circle" src="{{ asset('public/images/profile/' . $row->profile_photo_path) }}" width="35" height="35" alt=""></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->employee_code }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->contact_number }}</td>
                                    <td>{{ $row->attendance_id }}</td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-sm btn-primary mb-2" id="open_modal" data-id="{{ $row->id }}">Change</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Salary Structure Setting</h5>
                        </div>
                        <form class="form-validate" action="{{ route('salary-structure.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="request_id" id="request_id" value="">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Core Salary</label>
                                    <div class="col-lg-4 pr-0 mb-2">
                                        <button type="button" class="btn btn-secondary text-center" id="edit-salary" style="width:100%">EDIT</button>
                                    </div>
                                    <div class="col-lg-4 pr-0 mb-2">
                                        <input type="text" class="form-control text-info text-right" id="gross_salary" value="" disabled/>
                                    </div>
                                </div>
                                <style>
                                    .persent{
                                        position: absolute;
                                        right: 0px;
                                        top: 0px;
                                        height: 100%;
                                        background: black;
                                        display: flex;
                                        align-items: center;
                                        text-align: center;
                                        padding: 0px 12px;
                                        border-radius: 0px 10px 10px 0px;
                                        color: #fff;
                                    }
                                </style>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Basic Salary</label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" id="per-basic" value="60" min="0" max="100">
                                        <span class="persent">%</span>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <input type="hidden" name="basic" value="" id="basic">
                                    <label class="col-lg-3 col-form-label text-right border" id="basic-show"></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">House Rent</label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" id="per-house_rent" value="40" min="0" max="100">
                                        <span class="persent">%</span>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <input type="hidden" name="house_rent" value="" id="house_rent">
                                    <label class="col-lg-3 col-form-label text-right border" id="house_rent-show"></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Medical Allowance</label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" id="per-medical" value="15" min="0" max="100">
                                        <span class="persent">%</span>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <input type="hidden" name="medical" value="" id="medical">
                                    <label class="col-lg-3 col-form-label text-right border" id="medical-show"></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Conveyance Allowance</label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" id="per-conveyance" value="10" min="0" max="100">
                                        <span class="persent">%</span>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <input type="hidden" name="conveyance" value="" id="conveyance">
                                    <label class="col-lg-3 col-form-label text-right border" id="conveyance-show"></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Additional Allowances</label>
                                    <div class="col-lg-4"></div>
                                    <input type="hidden" name="additional" value="" id="additional">
                                    <label class="col-lg-3 col-form-label text-right border" id="additional-show"></label>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
    @push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            /*========//GET Data//=========*/
            $(document).on('click', '#open_modal', function(){
                var id = $(this).data('id');
                $('#exampleModalCenter').modal('show');

                $.ajax({
                    url:'{{ route('get-salary-stucture')}}',
                    method:'GET',
                    dataType:"JSON",
                    data:{id:id},
                    success: function(response) {
                        $('#request_id').val(response.id);
                        $('#gross_salary').val(response.gross_salary);

                        // Fix: Corrected calculation for per-basic
                        $('#per-basic').val(((response.basic / response.gross_salary) * 100).toFixed(0));
                        $('#basic').val(response.basic);
                        $('#basic-show').text(response.basic);

                        // Fix: Corrected calculation for per-house_rent
                        $('#per-house_rent').val(((response.house_rent / response.basic) * 100).toFixed(0));
                        $('#house_rent').val(response.house_rent);
                        $('#house_rent-show').text(response.house_rent);

                        // Fix: Corrected calculation for per-medical
                        $('#per-medical').val(((response.medical / response.basic) * 100).toFixed(0));
                        $('#medical').val(response.medical);
                        $('#medical-show').text(response.medical);

                        // Fix: Corrected calculation for per-conveyance
                        $('#per-conveyance').val(((response.conveyance / response.basic) * 100).toFixed(0));
                        $('#conveyance').val(response.conveyance);
                        $('#conveyance-show').text(response.conveyance);

                        $('#additional').val(response.additional);
                        $('#additional-show').text(response.additional);
                    },

                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            /*========//Calculate Data//=========*/
            $('#gross_salary, #per-basic, #per-house_rent, #per-medical, #per-conveyance').on('change', function () {
                var grossSalary = parseFloat($('#gross_salary').val());
                
                var perBasic = parseFloat($('#per-basic').val());
                var newBasic = (grossSalary * perBasic) / 100;
                $('#basic').val(newBasic.toFixed(2));
                $('#basic-show').text(newBasic.toFixed(2));

                var perHouseRent = parseFloat($('#per-house_rent').val());
                var newHouseRent = (newBasic * perHouseRent) / 100;
                $('#house_rent').val(newHouseRent.toFixed(2));
                $('#house_rent-show').text(newHouseRent.toFixed(2));

                var perMedical = parseFloat($('#per-medical').val());
                var newMedical = (newBasic * perMedical) / 100;
                $('#medical').val(newMedical.toFixed(2));
                $('#medical-show').text(newMedical.toFixed(2));

                var perConveyance = parseFloat($('#per-conveyance').val());
                var newConveyance = (newBasic * perConveyance) / 100;
                $('#conveyance').val(newConveyance.toFixed(2));
                $('#conveyance-show').text(newConveyance.toFixed(2));

                var cheAdditional = grossSalary - (newBasic + newHouseRent + newMedical + newConveyance);
                $('#additional').val(cheAdditional.toFixed(2));
                $('#additional-show').text(cheAdditional.toFixed(2));

                $('#additional-show').toggleClass('text-success', cheAdditional > 0).toggleClass('text-danger', cheAdditional < 0);
                $('#submit-btn').prop('disabled', cheAdditional <= 0);
            });

            $('#edit-salary').on('click', function () {
                var $grossSalary = $('#gross_salary');
                
                if ($grossSalary.prop('disabled')) {
                    $grossSalary.prop('disabled', false)
                        .attr('name', 'gross_salary')
                        .removeClass('text-info');
                } else {
                    $grossSalary.prop('disabled', true)
                        .removeAttr('name')
                        .addClass('text-info');
                }

                $('#edit-salary').toggleClass('btn-outline-secondary btn-secondary');
            });


        });
    </script>
    @endpush
</x-app-layout>