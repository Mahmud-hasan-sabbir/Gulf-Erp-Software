<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                      Complaint List
                    </h4>
                    <button id="open_modal" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>Issue No</th>
                                <th>Complaint Name</th>
                                <th>Decription</th>
                                <th>states</th>
                               <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($compliant as $item )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>

                                    <td>
                                        @if ($item->status == 1)
                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>Active
                                        </span>
                                            @elseif ($item->status == 0)
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-0"></i>Inactive
                                        </span>
                                        @endif

                                    </td>
                                    <td style="width:210px">
                                        <a class="btn btn-sm btn-success p-1 px-2"  href="{{ route('mast_compliant_type.edit',$item->id) }}"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</a>
                                        <a class="btn btn-sm btn-danger p-1 px-2" href="{{ route('mast_compliant_type.show',$item->id) }}"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>View</a>
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

    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Complaint Name</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mast_compliant_type.store') }}" method="post">
                        @csrf
                        <div class="row">
                             <label for="" class="text-black col-md-4">Name</label>
                             <div class="col-md-8">
                                <input type="text" name="name" class="form-control" required>
                             </div>

                        </div>
                        <div class="row mt-1">
                            <label for="" class="text-black col-md-4">Status</label>
                            <div class="col-md-8">
                               <select name="status" id="" class="form-control" required>
                                    <option value="" selected disabled>Select a Status</option>
                                    <option value="1">Active</option>
                                    <option value="0"> In Active</option>
                               </select>
                             </div>

                        </div>
                        <div class="row mt-1">
                            <label for="" class="text-black col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="Description" id="" cols="30" rows="5"></textarea>
                             </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
