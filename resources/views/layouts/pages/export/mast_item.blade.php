<!DOCTYPE html>
<html lang="en">
<head>
    <title>Item Export</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
         table {
        width: 100%;
        border-collapse: collapse;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>           
    <table class="table table-hover">
        <thead>
            <colgroup>
                <col width="5%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <tr>
                <th scope="col" style="width: 5px">#</th>
                <th scope="col">Image</th>
                <th scope="col">Box No.</th>
                <th scope="col" style="width: 75px">Gulf Code</th>
                <th scope="col" style="width: 90px">Part No.</th>
                <th scope="col">Part Name</th>
                <th scope="col" style="width: 90px">Description</th>
                <th scope="col" style="width: 80px">Box Qty.</th>
                <th scope="col">Pirce</th>
                <th scope="col">Bare Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>										
                    <td class="sorting_1"><img src="{{asset('public')}}/images/car-parts/{{ $row->image }}" width="40" height="40" alt=""></td>
                    <td>{{ $row->box_code }}</td>
                    <td>{{ $row->gulf_code }}</td>
                    <td>{{ $row->part_no }}</td>
                    <td>{{ $row->mastItemGroup->part_name ?? 'N/A' }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->box_qty }}</td>
                    <td>{{ $row->price }}</td>
                    <td>{!! DNS1D::getBarcodeHTML("$row->bar_code", 'PHARMA') !!} GULF-{{$row->bar_code}} </td>
                    {{-- <td>{!! DNS1D::getBarcodeHTML("$row->bar_code", 'PHARMA2T',3,33,'green', true) !!}</td> --}}
                </tr>
            @endforeach
        
        </tbody>
    </table>
    </div>

</body>
</html>

