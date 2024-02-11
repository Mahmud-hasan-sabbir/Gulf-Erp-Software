<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stock Position</h4>
                    <div>
                        @can('Role create') 
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-search"></i><span class="btn-icon-add" data-bs-toggle="modal"></span>Tracking </a>                   
                        @endcan
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row" id="filter-data">
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Item Category
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="user_id" id="user_id" class="form-control dropdwon_select">
                                        <option selected disabled>--Select--</option>
                                        @foreach($category as $row)
                                            <option value="{{ $row->id}}">{{ $row->cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Store Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="user_id" id="user_id" class="form-control dropdwon_select">
                                        <option selected disabled>--Select--</option>
                                        @foreach($store as $row)
                                            <option value="{{ $row->id}}">{{ $row->store_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex justify-content-end">
                                <button id="reset" class="btn btn-sm btn-warning"><i class="ti-reload"></i><span class="btn-icon-add"></span>Reset</button>                   
                            </div>
                        </div>
                    </div>
                    {{-- <div id="attendance-list"></div> --}}



                    <table class="table table-bordered table-responsive-sm" style="min-width: 500px">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Group Name</th>
                                <th>Part No.</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                @php
                                    $countItem = DB::table('sl_movements')
                                    ->where('mast_item_register_id', $row->id)
                                    ->whereIn('reference_type_id', [1, 3])
                                    ->where('mast_work_station_id', 1)
                                    ->where('status', 1)
                                    ->count();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->part_name }}</td>
                                    <td>{{ $row->part_no }}</td>
                                    <td>{{ $row->id }}/{{ $countItem }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <!-- Tracing Item -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" data-action="{{ route('setup-attendance-store') }}" method="POST" enctype="multipart/form-data" id="add-user-attendacne-id">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tracing Item</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <input type="text" name="serial_no" id="serialNo" class="form-control mr-2" value="" placeholder="Enter Serial No.">

                            <button id="reset" class="btn btn-sm btn-secondary">Find</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('script')
    
    <script>
        $(document).ready(function(){
            fetch();
        });
        
        // Fetch records
        function fetch(user_id, start_date, end_date) {
            $.ajax({
                url: "{{ route('get-attendance-filter') }}",
                method:'GET',
                dataType:"html",
                data: {
                    user_id: user_id,
                    start_date: start_date,
                    end_date: end_date
                },
                success:function(data){
                    $('#attendance-list').html(data);
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Failed to fetch data!", "error");
                }
            });
        }
        // Filter
        $('#filter-data').on('input change', '#start_date, #end_date, #user_id', function() {
            var user_id = $("#user_id").val();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            
            fetch(user_id, start_date, end_date);
        });
        // Reset
        var clearDropdownHtml = $('#user_id').html();
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $('#user_id').html(clearDropdownHtml);
            $('#start_date').val(startDate);
            $('#end_date').val(endDate);
            fetch();
        });
    </script>

    @endpush
</x-app-layout>
