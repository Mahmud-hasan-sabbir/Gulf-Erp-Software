<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Unit List<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <a href="{{ route('mast_unit.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body"> 
                    <p class="text-center text-success">{{Session::has('message') ? Session::get('message') : ''}}</p>
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Unit Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->unit_name}}</td>
                                    <td>{{ $row->description }}</td>										
                                    <td>{{ $row->status == 1 ? 'Active' : 'Inactive'  }}</td>																			
                                    <td class="text-right">
                                        <a href="{{ route('mast_unit.edit', $row->id) }}"><button class="btn btn-success btn-xm p-2" {{ $row->id == 1 || $row->id == 2 ? 'disabled' : '' }}>Edit</button></a>                               
                                        
                                        <a href="{{ route('mast_unit.show', $row->id) }}" class="btn btn-info btn-xm p-2">View</a>                                                             
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
