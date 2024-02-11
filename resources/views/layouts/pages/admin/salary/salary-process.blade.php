<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Salary Process<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                </div>
                <div class="card-body">
                    <form class="form-validate" action="{{ route('salary-process.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row" id="filter-data">
                            <div class="col-lg-10 col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Employee</label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" id="user_id" name="user_id">
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
                            
                            <div class="col-lg-2 col-sm-12">
                                <button type="button" class="btn btn-sm btn-primary mb-3" id="calculate_btn"><i class="ti-settings"></i><span class="btn-icon-add"></span>Calculate</button>                   
                                <button type="submit" class="btn btn-sm btn-secondary mb-3" id="save_btn"><i class="ti-save"></i><span class="btn-icon-add"></span>Save</button>                   
                            </div>
                        </div>
                        <div id="salary-list"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on("click", "#calculate_btn", function() {
                var userId = $("#user_id").val();
                var workStation = $("#mast_work_station_id").val();
                var month = $("#month").val();
                var year = $("#year").val();
                
                fetch(userId, workStation, month, year);
            });
        });
        
        // Fetch records
        function fetch(userId, workStation, month, year) {
            $("#loading").show();
            $.ajax({
                url: "{{ route('salary-process-filter') }}",
                method:'GET',
                dataType:"html",
                data: {
                    userId: userId,
                    workStation: workStation,
                    month: month,
                    year: year
                },
                success:function(data){
                    $("#loading").hide();
                    $('#salary-list').html(data);
                },
                error: function (xhr) {
                    $("#loading").hide();
                    Swal.fire(
                        'Required data missing?',
                        'Please ensure Month or Year not selected.',
                        'question'
                    )
                }

                
            });
        }
    </script>
    
    @endpush
</x-app-layout>
