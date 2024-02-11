<x-reports-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-success">Reqution Delivery Challan</h4>
                </div>
                @php
                    $latestDate = $data->groupBy(function($item) {
                        return $item->created_at->format('Y-m-d');
                    })->keys()->last();

                    $latestData = $data->filter(function($item) use ($latestDate) {
                        return $item->created_at->format('Y-m-d') === $latestDate;
                    });
                @endphp
                <div class="card-body pt-2">
                    <div class="row">
                        <label class="col-3 col-form-label"><strong> Invoice No </strong></label>
                        <label class="col-6 col-form-label">: {{$storeTransfer->inv_no}}</label>
                        <label class="col-3 col-form-label"><strong>Invoice Date</strong></label>
                        <label class="col-6 col-form-label">: {{date("j F, Y", strtotime($storeTransfer->inv_date))}}</label>
                        <label class="col-3 col-form-label"><strong>Supplier Name</strong></label>
                        <label class="col-6 col-form-label">{{$storeTransfer->mastWorkStation->store_name}}</label>
                        <label class="col-3 col-form-label"><strong> Receive Data</strong></label>
                        <label class="col-6 col-form-label">: {{date("j F, Y", strtotime($latestDate))}}</label>
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
                                @foreach ($latestData as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->serial_no }}</td>
                                    <td>{{ $row->cat_name }}</td>
                                    <td>{{ $row->part_name }}</td>
                                    <td>{{ $row->part_no }}</td>
                                    <td>{{ $row->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-reports-layout>