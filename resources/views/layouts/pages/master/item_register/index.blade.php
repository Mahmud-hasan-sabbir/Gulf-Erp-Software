<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Item List<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <div>
                        <a href="{{route('item_pdf.download')}}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-download"></i><span class="btn-icon-add"></span>PDF</a>
                        <a href="{{route('item_export.excel')}}" class="btn btn-sm btn-primary mr-1"><i class="fa fa-download"></i><span class="btn-icon-add"></span>Excel</a>
                        <a href="{{ route('mast_item_register.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New</a>
                    </div>
                    {{-- @endcan --}}
                </div>
                <div class="card-body"> 
                    <p class="text-center text-success">{{Session::has('message') ? Session::get('message') : ''}}</p>
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 98px">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    {{-- <th>Image</th> --}}
                                    {{-- <th>Box No.</th>
                                    <th>Gulf Code</th> --}}
                                    <th>Category</th>
                                    <th>Part Number</th>
                                    <th>Part Name</th>
                                    <th>Description</th>
                                    <th>Box Qty.</th>
                                    <th>Pirce</th>
                                    {{-- <th>Barcode</th> --}}
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>										
                                        {{-- <td class="sorting_1"><img src="{{asset('public')}}/images/car-parts/{{ $row->image }}" width="35" height="35" alt=""></td> --}}
                                        {{-- <td>{{ $row->box_code }}</td>
                                        <td>{{ $row->gulf_code }}</td> --}}
                                        <td>{{ $row->mastItemCategory->cat_name }}</td>
                                        <td>{{ $row->part_no }}</td>
                                        <td>{{ $row->mastItemGroup->part_name ?? 'N/A' }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->box_qty }}</td>
                                        <td>{{ $row->price }}</td>
                                        {{-- <td>{!! DNS1D::getBarcodeHTML("$row->bar_code", 'PHARMA') !!} GULF-{{$row->bar_code}} </td> --}}
                                        {{-- <td>{!! DNS1D::getBarcodeHTML("$row->bar_code", 'PHARMA2T',3,33,'green', true) !!}</td> --}}
                                        <td class="float-right" style="width:100px">                                
                                            <a href="{{ route('mast_item_register.edit', $row->id) }}" class="btn btn-success btn-sm btn-xm p-2">Edit</a>
                                            <a href="{{ route('mast_item_register.show', $row->id) }}" class="btn btn-info  btn-sm btn-xm p-2">View</a>                                                             
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
