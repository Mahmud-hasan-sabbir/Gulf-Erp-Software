<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Edit</h4>
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>

                </div>
                <div class="card-body">
                    <form action="{{ route('mast_compliant_type.update',$compliantEdit->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                             <label for="" class="text-black col-md-4">Name</label>
                             <div class="col-md-8">
                                <input type="text" name="name" class="form-control" value="{{ $compliantEdit->name }}">
                             </div>

                        </div>
                        <div class="row mt-1">
                            <label for="" class="text-black col-md-4">Status</label>
                            <div class="col-md-8">
                               <select name="status" id="" class="form-control">
                                    <option value="1" {{ $compliantEdit->status == 1?'selected':'' }}>Active</option>
                                    <option value="0" {{ $compliantEdit->status == 0?'selected':'' }}> In Active</option>
                               </select>
                             </div>

                        </div>
                        <div class="row mt-1">
                            <label for="" class="text-black col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="Description" id="" cols="30" rows="5">{{  $compliantEdit->description }}</textarea>
                             </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
