
<div class="table-responsive"> 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SL#</th>
                <th>ID</th>
                <th>Username</th>
                <th>Station</th>
                <th>Present</th>
                <th>Absent</th>
                <th>leave</th>
                <th>Let</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userData as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user['employee_code'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['store_name'] }}</td>
                    <td>{{ $user['presentCount'] ?? '0.00'}}</td>
                    <td>{{ $user['absentCount'] ?? '0.00'}}</td>
                    <td>{{ $user['leaveCount'] ?? '0.00'}}</td>
                    <td>
                        @if ($user['lateTotal'])
                            <span class="text-danger">{{ $user['lateTotal'] }}</span>/3 = {{ round($user['lateTotal'] / 3) }}
                        @else
                            <span class="text-danger">0</span>
                        @endif
                    </td>
                    <td>{{ $user['gross'] ?? '0.00'}}</td>
                    <td><button type="button" class="btn btn-primary py-1" data-toggle="modal" data-target="#exampleModalCenter_{{$loop->iteration}}">Details</button></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter_{{$loop->iteration}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Salary Details ({{ $user['store_name']}})</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Employee</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['name']}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Date</label>
                                            <label class="col-lg-7 col-7 col-form-label">
                                                <strong>{{ date('F', mktime(0, 0, 0, $user['salary_month'], 1)) }} {{ $user['salary_year'] }}</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Present</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['presentCount']}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Leave</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['leaveCount']}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Absent</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['absentCount']}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Unauthorized</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['unauthorized']}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Late</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['lateTotal']}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Dedaction</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $user['dedaction']}}</strong></label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Basic Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['basic_pay'] ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>House Rent Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['house_rent_pay'] ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Medical Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['medical_pay'] ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Conveyance Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['conveyance_pay'] ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Additional Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['additional_pay'] ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Gross Salary</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border bg-light">{{ $user['core_salary'] ?? '0.00'}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Basic</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ number_format($user['basic'], 2, '.', '') ?? '0.00' }}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>House Rent</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['basic'] ? $user['house_rent'] : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Medical</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['basic'] ? $user['medical'] : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Conveyance</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['basic'] ? $user['conveyance'] : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Additional</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $user['basic'] ? $user['additional'] : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Net Salary</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border bg-light">   
                                                {{ isset($user['gross']) ? number_format($user['gross'], 2, '.', '') : '0.00' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach

        </tbody>
        
    </table>
</div>
<div class="dataTables_info">Showing {{ count($userData) }} entries</div>
