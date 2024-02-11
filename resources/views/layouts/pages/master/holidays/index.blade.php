<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Holidays List<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <a href="{{ route('mast_holidays.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body"> 
                    <p class="text-center text-success">{{Session::has('message') ? Session::get('message') : ''}}</p>
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Holidays Name</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>										
                                    <td>{{ $data->name }}</td>										
                                    <td>{{ $data->date }}</td>										
                                    <td>{{ $data->description }}</td>										
                                    <td>{{ $data->status == 1 ? 'Active' : 'Inactive'  }}</td>																			
                                    <td class="float-right" style="width:100px">                                
                                        <a href="{{ route('mast_holidays.edit', $data->id) }}" class="btn btn-success btn-xm p-2">Edit</a>
                                        <a href="{{ route('mast_holidays.show', $data->id) }}" class="btn btn-info btn-xm p-2">View</a>                                                              
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
