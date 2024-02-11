<x-app-layout>
    <div class="row mb-4">
        <div class="col-lg-12">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary float-right"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
        </div>
    </div>
    @foreach($data->groupBy(function($item) {return $item->created_at->format('Y-m-d');}) as $date => $groupedData)
    {{-- @foreach($data->groupBy('created_at') as $date => $groupedData) --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Delivery (<span class="text-info">{{date("j F, Y", strtotime($date))}}</span>)</h4>
                    <a href="{{ route('parsial-sales-delivery.download', ['data' => $date, 'id' => $sales->id]) }}" class="btn btn-sm btn-secondary p-1 px-2">
                        <i class="fa fa-print"></i><span class="btn-icon-add"></span>Print
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong> Invoice No :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->inv_no}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Invoice Date :</strong></label>
                                <label class="col-6 col-form-label">{{date("j F, Y", strtotime($sales->inv_date))}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <label class="col-6 col-form-label"><strong>Customer Name :</strong></label>
                                <label class="col-6 col-form-label">{{$sales->mastCustomer->name}}</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="items-table" class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>SL#</th>
                                <th>Serial No</th>
                                <th>Category</th>
                                <th>Group Name</th>
                                <th>Part No.</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedData as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->serial_no}}</td>
                                    <td>{{$row->cat_name}}</td>
                                    <td>{{$row->part_name}}</td>
                                    <td>{{$row->part_no}}</td>
                                    <td>{{$row->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>

