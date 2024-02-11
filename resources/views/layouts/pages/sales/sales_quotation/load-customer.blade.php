
<option disabled selected>--Select--</option>
@foreach($data as $row)
    <option value="{{ $row->id}}">{{ $row->name}}</option>
@endforeach