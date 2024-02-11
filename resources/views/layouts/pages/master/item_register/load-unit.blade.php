<option value="" selected disabled>-- Select --</option>
@foreach ($mastUnit as $row)
    <option value="{{$row->id}}" {{ old('mast_item_group_id') == $row->id ? 'selected' : '' }}>{{ $row->unit_name}}</option>
@endforeach