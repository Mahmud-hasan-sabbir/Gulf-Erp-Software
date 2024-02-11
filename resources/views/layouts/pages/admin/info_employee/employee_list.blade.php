<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee Information List</h4>
                    {{-- @can('Role create') --}}
                    <a href="{{ route('employee_register.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Register Employee</a>
                    {{-- @endcan --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Employee Name</th>
                                    <th>Employee Code</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th class="text-right pr-4">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key=> $row)
                                <tr>
                                    <td class="sorting_1"><img class="rounded-circle" src="{{asset('public')}}/images/profile/{{ $row->profile_photo_path }}" width="35" height="35" alt=""></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->employee_code }}</td>
                                    <td>{{ $row->email}}</td>
                                    <td>{{ $row->contact_number}}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{ route('info_employee.edit', $row->id) }}" class="btn btn-success btn-xs mr-2">Edit</a>
                                        <a href="{{ route('info_employee.details', $row->id) }}" class="btn btn-info btn-xs mr-2">View</a>
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
