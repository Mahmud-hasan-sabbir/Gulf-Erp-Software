<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if ($type == 1) Distributor List
                        @elseif ($type == 2) Corporate List
                        @else Retailer List
                        @endif
                    </h4>
                    <a href="{{ route('customer.create',['cat_id' => $type]) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>contact-person</th>
                                    <th>Contact-mobie</th>
                                    <th>Contact-Email</th>
                                    <th>Designation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distributorList as $list )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->address }}</td>
                                    <td>{{ $list->cont_person }}</td>
                                    <td>{{ $list->cont_phone }}</td>
                                    <td>{{ $list->cont_email }}</td>
                                    <td>{{ $list->cont_designation }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>



