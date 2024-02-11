<table class="table table-bordered table-responsive-sm" style="min-width: 500px">
    <thead>
        <tr>
            <th>SL#</th>
            <th>Day</th>
            <th>Date</th>
            <th>Employee ID</th>
            <th>Username</th>
            <th>In time</th>
            <th>Out time</th>
            <th>Status</th>
            <th>DLE#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr id="row_{{$row->id}}" class="{{ $row->is_late == 1 ? 'bg-light text-danger': '' }}{{ !in_array($row->attendance_type, ['P', 'L']) ? 'bg-light text-info' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($row->date)->format('D') }}</td>
                <td>{{ $row->date }}</td>
                <td>{{ $row->employee_code }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ \Carbon\Carbon::parse($row->in_time)->format('g:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->out_time)->format('g:i A') }}</td>
                <td class="">{{ $row->attendance_type }}</td>
                <td><button id="delete_attendance" data-id="{{$row->id}}" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-trash"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="dataTables_info">Showing {{ count($data) }} entries</div>
