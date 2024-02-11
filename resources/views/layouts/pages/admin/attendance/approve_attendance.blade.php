<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance Approve List</h4>
                    {{-- @can('Role create') --}}
                    {{-- <a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a> --}}
                    {{-- @endcan --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Employee Code</th>
                                    <th>Employee-Name</th>
                                    <th>Atten-Type</th>
                                    <th>In-Time</th>
                                    <th>Out-Time</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row )
                                <tr>
                                    <td>{{ $row->user->employee_code }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{$row->attendance_type == 1 ? 'Present' : 'Absent'}}</td>
                                    <td>{{ $row->in_time }}</td>
                                    <td>{{ $row->out_time }}</td>
                                    <td class="d-flex justify-content-end">
                                        <form action="{{route('attendance.approve', $row->id)}}" method="post">
                                            <button class="btn btn-sm btn-info p-1 mr-1">Approve</i></button>
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <form action="{{route('attendance.canceled', $row->id)}}" method="post">
                                            <button class="btn btn-sm btn-danger p-1">Canceled</i></button>
                                            @csrf
                                            @method('PATCH')
                                        </form>
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
