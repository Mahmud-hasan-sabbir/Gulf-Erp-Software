<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dept. Approve<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Leave Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row )
                                <tr>
                                    <td>{{ $row->user->name}}</td>
                                    <td>{{ $row->mastLeave->leave_name}}</td>
                                    <td>{{date("j F, Y", strtotime($row->start_date))}}</td>
                                    <td>{{date("j F, Y", strtotime($row->end_date))}}</td>
                                    <td>{{ $row->duration}}</td>
                                    <td class="d-flex justify-content-end">
                                        <form action="{{route('leave_dept.approve', $row->id)}}" method="post">
                                            <button class="btn btn-sm btn-info p-1 mr-1">Approve</i></button>
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <form action="{{route('leave_application.canceled', $row->id)}}" method="post">
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
