<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pay Slip List<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                </div>
                <div class="card-body">
                    <form class="form-validate" action="{{ route('salary-sheet.distribution') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row" id="filter-data">
                            <div class="col-lg-9 col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Employee</label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" id="emp_id" name="emp_id">
                                                    <option value="" selected>All</option>
                                                    @foreach ($users as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Work Station</label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" id="mast_work_station_id" name="mast_work_station_id">
                                                    <option value="" selected>All</option>
                                                    @foreach ($workStation as $row)
                                                        <option value="{{$row->id}}">{{$row->store_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Month
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select @error('month') is-invalid @enderror" id="month" name="month">
                                                    <option value="" selected>Select</option>
                                                    <?php
                                                        for ($month = 1; $month <= 12; $month++) {
                                                            $monthName = DateTime::createFromFormat('!m', $month)->format('F');
                                                            echo "<option value='$month'>$monthName</option>";
                                                        }
                                                    ?>
                                                </select>
                                                @error('month')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Year
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select @error('year') is-invalid @enderror" id="year" name="year">
                                                    <option value="" selected>Select</option>
                                                    <?php
                                                        $startYear = 2020;
                                                        $endYear = 2050;

                                                        for ($year = $startYear; $year <= $endYear; $year++) {
                                                            echo "<option value='$year'>$year</option>";
                                                        }
                                                    ?>
                                                </select>
                                                @error('year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="col-lg-3 col-sm-12">
                                <div class="mb-3 d-flex">
                                    <input type="hidden" class="form-check-input" name="status" id="status" value="1">
                                    <button type="button" class="btn btn-sm btn-info mx-1" id="reset"><i class="ti-reload"></i><span class="btn-icon-add"></span>Reset</button>                   
                                    <br>
                                    <button type="button" class="btn btn-sm btn-success mx-1" id="find"><i class="ti-settings"></i><span class="btn-icon-add"></span>Find</button>                   
                                </div>
                            </div>
                        </div><br>
                        <div id="salary-sheet-list"></div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    @push('script')
    <script type="text/javascript">
        //------------ Filter Data 
        $(document).ready(function () {
            var empId = $("#emp_id").val();
            var workStation = $("#mast_work_station_id").val();
            var month = $("#month").val();
            var year = $("#year").val();
            // var status = $("#status").prop('checked') ? 1 : 0;
            var status = 1;
    
            fetch(empId, workStation, month, year, status);
        });
    
        // Fetch records
        function fetch(empId, workStation, month, year, status) {
            $("#loading").show();
            $.ajax({
                url: "{{ route('salary-sheet.filter') }}",
                method: 'GET',
                dataType: "html",
                data: {
                    empId: empId,
                    workStation: workStation,
                    month: month,
                    year: year,
                    status: status
                },
                success: function (data) {
                    $("#loading").hide();
                    $('#salary-sheet-list').html(data);
                },
                error: function (xhr, status, error) {
                    $("#loading").hide();
                    swal("Error!", "Failed to fetch data!", "error");
                }
            });
        }
    
        // Filter
        $('#filter-data').on('input change', '#emp_id, #mast_work_station_id, #month, #year, #status', function () {
            var empId = $("#emp_id").val();
            var workStation = $("#mast_work_station_id").val();
            var month = $("#month").val();
            var year = $("#year").val();
            // var status = $("#status").prop('checked') ? 1 : 0;
            var status = 1;
    
            fetch(empId, workStation, month, year, status);
        });
    
        // Find & Reset
        $(document).on("click", "#find", function (e) {
            e.preventDefault();
    
            var empId = $("#emp_id").val();
            var workStation = $("#mast_work_station_id").val();
            var month = $("#month").val();
            var year = $("#year").val();
            // var status = $("#status").prop('checked') ? 1 : 0;
            var status = 1;
    
            fetch(empId, workStation, month, year, status);
        });
    
        var empIdCL = $('#emp_id').html();
        var workStationCL = $('#mast_work_station_id').html();
        var monthCL = $('#month').html();
        var yearCL = $('#year').html();
    
        $(document).on("click", "#reset", function (e) {
            e.preventDefault();
    
            $('#emp_id').html(empIdCL);
            $('#mast_work_station_id').html(workStationCL);
            $('#month').html(monthCL);
            $('#year').html(yearCL);
            $("#status").prop('checked', true);
    
            var empId = $("#emp_id").val();
            var workStation = $("#mast_work_station_id").val();
            var month = $("#month").val();
            var year = $("#year").val();
            // var status = $("#status").prop('checked') ? 1 : 0;
            var status = 1;
    
            fetch(empId, workStation, month, year, status);
        });
    </script>
    
    @endpush
</x-app-layout>