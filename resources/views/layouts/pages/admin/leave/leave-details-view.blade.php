<table class="table table-bordered table-responsive-sm" style="min-width: 500px">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->user->name }}</td>
                <td>{{ $row->mastLeave->leave_name }}</td>
                <td>{{ $row->start_date }}</td>
                <td>{{ $row->end_date }}</td>
                <td>{{ $row->duration }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
