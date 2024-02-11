<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Of Air Conditioner Models<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <a href="{{ route('mast_item_models.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body"> 
                    <p class="text-center text-success">{{Session::has('message') ? Session::get('message') : ''}}</p>
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Group Name</th>
                                    <th>Ton</th>
                                    <th>Cooling Capacity</th>
                                    <th>Indoor</th>
                                    <th>Outdoor</th>
                                    <th>Full Set</th>
                                    <th>Status</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->mastItemGroup->part_name }}</td>
                                    <td>{{ $row->ton}}</td>
                                    <td>{{ $row->coling_capacity}}</td>
                                    <td>{{ $row->indoor}}</td>
                                    <td>{{ $row->outdoor}}</td>										
                                    <td>{{ $row->full_set}}</td>										
                                    <td>{{ $row->status == 1 ? 'Active' : 'Inactive'  }}</td>																			
                                    <td class="float-right" style="width:100px">                                
                                        <a href="{{ route('mast_item_models.edit', $row->id) }}" class="btn btn-success btn-xm p-2">Edit</a>
                                        <a href="{{ route('mast_item_models.show', $row->id) }}" class="btn btn-info btn-xm p-2">View</a>                                                             
                                    </td>
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
