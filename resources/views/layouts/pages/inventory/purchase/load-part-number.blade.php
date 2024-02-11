
<option disabled selected>--Select--</option>
@foreach($data as $row)
    <option value="{{ $row->id}}">{{ $row->part_no}}</option>
@endforeach