<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Compliant View</h4>
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>

                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf

                        <div class="row">
                             <label for="" class="text-black col-md-4">Name</label>
                             <div class="col-md-8">
                                <input type="text" readonly name="name" class="form-control" value="{{ $compliantView->name }}">
                             </div>

                        </div>
                        <div class="row mt-1">
                            <label for="" class="text-black col-md-4">status</label>
                            <div class="col-md-8">
                               <select name="status" selected disabled id="" class="form-control">
                                    <option value="1"  {{ $compliantView->status == 1?'selected':'' }}>Active</option>
                                    <option value="0" {{ $compliantView->status == 0?'selected':'' }}> In Active</option>
                               </select>
                             </div>

                        </div>
                        <div class="row mt-1">
                            <label for="" class="text-black col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" readonly name="Description" id="" cols="30" rows="5">{{  $compliantView->description }}</textarea>
                             </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
