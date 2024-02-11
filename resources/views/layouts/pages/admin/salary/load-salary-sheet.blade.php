<div class="table-responsive"> 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" class="checkbox" id="all-select"/></th>
                <th>Date</th>
                <th>ID</th>
                <th>Username</th>
                <th>Station</th>
                <th>Gross</th>
                <th>Dedaction</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>
                        <input type="checkbox" class="checkbox checkbox-item" {{$row->status == 1 ? 'checked':''}} />
                        <input type="hidden" name="dataId[{{$row->id}}][id]" class="checkbox-id" value="{{$row->id}}"/>
                        <input type="hidden" name="dataId[{{$row->id}}][status]" class="checkbox-status" value="{{$row->status}}"/>
                    </td>
                                             
                    <td>{{ $row->salary_month }}/{{ $row->salary_year }}</td>
                    <td>{{ $row->user->employee_code }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ $row->mastWorkStation->store_name }}</td>
                    <td>{{ $row->gross }}</td>
                    <td>{{ $row->dedaction }}</td>
                    <td>{{ $row->net_pay }}</td>
                    <td><button type="button" class="btn btn-{{$row->status == 1 ? 'secondary':'primary'}} py-1" data-toggle="modal" data-target="#exampleModalCenter_{{$loop->iteration}}">{{$row->status == 1 ? 'Payslip':'Details'}}</button></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter_{{$loop->iteration}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title pt-1">Salary Details (<span class="text-info">{{ $row->mastWorkStation->store_name ?? '!' }} </span>)</h5>
                                {{-- <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button> --}}
                                @if ($row->status == 1)
                                    <a href="{{route('salary-pay-slip.download', $row->id)}}" class="btn btn-sm btn-secondary mr-1"><i class="fa fa-download"></i><span class="btn-icon-add"></span>Print</a>
                                @endif
                            </div>
                            <div class="modal-body pt-0">
                                @php
                                    // Set up date range
                                    $startDate = new DateTime($row->salary_year . '-' . $row->salary_month . '-01');
                                    $endDate = new DateTime($row->salary_year . '-' . $row->salary_month . '-' . cal_days_in_month(CAL_GREGORIAN, $row->salary_month, $row->salary_year));

                                    $attendanceData = $row->user->hrAttendance()
                                        ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                                        ->selectRaw('SUM(is_late = 1) as lateAttendance, COUNT(*) as totalAttendance, SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as `absent`, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as `present`, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as `leave`, SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as govtVacation')
                                        ->first();

                                    $lateCount = round($attendanceData->lateAttendance / 3);
                                    $absentCount = $attendanceData->absent;
                                    $presentCount = $attendanceData->present;
                                    $govtVacationCount = $attendanceData->govtVacation;
                                    $leaveCount = $attendanceData->leave;


                                    // Total Month
                                    $daysInMonth = $startDate->format('t');

                                    $interval = new DateInterval('P1D');
                                    $expectedDates = array_map(fn ($date) => $date->format('Y-m-d'), iterator_to_array(new DatePeriod($startDate, $interval, $endDate->modify('+1 day'))));

                                    // Vacation Count -->>|| 5 => Friday || 6 => Saturday
                                    $weeklyVacationCount = count(array_filter($expectedDates, function ($date) {
                                        $dayOfWeek = (new DateTime($date))->format('N');
                                        return $dayOfWeek == 5; // return $dayOfWeek == 5 || $dayOfWeek == 6;
                                    }));

                                    $unauthorized = $daysInMonth - (($presentCount + $absentCount) + ($weeklyVacationCount + $leaveCount + $govtVacationCount));
                                    if ($unauthorized < 0) {
                                        $unauthorized = 0;
                                    }
                                @endphp 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Employee</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $row->user->name }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Date</label>
                                            <label class="col-lg-7 col-7 col-form-label">
                                                <strong>{{ date('F', mktime(0, 0, 0, $row->salary_month, 1)) }} {{ $row->salary_year }}</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Present</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $presentCount }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Leave</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $leaveCount }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Absent</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $absentCount }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Unauthorized</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong class="text-danger">{{ $unauthorized }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Govt. Holiday</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $govtVacationCount }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Week Holiday</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong>{{ $weeklyVacationCount }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Late</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong class="text-danger">{{ $lateCount }}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-lg-5 col-5 col-form-label">Dedaction</label>
                                            <label class="col-lg-7 col-7 col-form-label"><strong class="text-danger">{{ $row->dedaction}}</strong></label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Basic Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->basic_pay ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>House Rent Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->house_rent_pay ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Medical Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->medical_pay ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Conveyance Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->conveyance_pay ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Additional Pay</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->additional_pay ?? '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Gross Salary</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border bg-light">
                                                {{ number_format(($row->basic_pay ?? 0) + ($row->house_rent_pay ?? 0) + ($row->medical_pay ?? 0) + ($row->conveyance_pay ?? 0) + ($row->additional_pay ?? 0), 2) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Basic</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ number_format($row->basic, 2, '.', '') ?? '0.00' }}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>House Rent</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->basic != 0 ? $row->house_rent : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Medical</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->basic != 0 ? $row->medical : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Conveyance</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->basic != 0 ? $row->conveyance : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Additional</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border">{{ $row->basic != 0 ? $row->additional : '0.00'}}</label>
                                        </div>
                                        <div class="row">
                                            <label class="col-6 col-form-label"><strong>Net Salary</strong></label>
                                            <label class="col-1 col-form-label">: </label>
                                            <label class="col-5 col-form-label text-right border bg-light">   
                                                {{ isset($row->gross) ? number_format($row->gross, 2, '.', '') : '0.00' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save Change</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach

        </tbody>
    
    </table>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        // Toggle all checkboxes when the "all-select" checkbox changes
        $('#all-select').change(function () {
            var isChecked = $(this).prop('checked');
            $('.checkbox-item').prop('checked', isChecked).change();
            // $('.checkbox-id').prop('disabled', !isChecked);
        });

        // Update "all-select" state based on individual checkboxes
        $('.checkbox-item').change(function () {
            var isChecked = $(this).prop('checked');
            $(this).closest('td').find('.checkbox-status').val(isChecked ? 1 : 0);

            // Update the disabled state of the .checkbox-id based on the visible checkbox state
            // $(this).closest('td').find('.checkbox-id').prop('disabled', !isChecked);
        });
    });
</script>
