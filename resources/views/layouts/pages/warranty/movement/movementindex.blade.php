<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Technician Movement</h4>
                    <button type="button" data-toggle="modal"  data-target=".add-modal" class="btn btn-sm btn-success p-1 px-2" ><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Create</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="badge light badge-warning">
                                            <i class="fa fa-circle text-warning mr-1"></i>non technician
                                        </span>

                                        <span class="badge light badge-success">
                                            <i class="fa fa-circle text-success mr-1"></i>technician
                                        </span>

                                    </td>
                                    <td>

                                        <button type="button" id="edit_data" data-toggle="modal" data-id=""  data-target=".bd-example-modal-lg" class="btn btn-sm btn-info p-1 px-2" ><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- add modal open-->
<div class="modal fade add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                   Technician New List
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
                <div class="modal-body">
                    <form class="form-valide" data-action="" method="POST" enctype="multipart/form-data" id="add-user-form">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Technician Name
                                        </label>
                                        <div class="col-md-7">
                                           <h6>Mahmud hasan sabbir</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Date
                                        </label>
                                        <div class="col-md-7">
                                           <h6>8/6/2023</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Address
                                        </label>
                                        <div class="col-md-7">
                                           <h6>Dhaka</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Job No
                                        </label>
                                        <div class="col-md-7">
                                           <h6>1</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                 <label class="col-md-3 col-form-label">Compliant Details
                                 </label>
                                 <div class="col-md-9">
                                     <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="write compliant details........"></textarea>
                                 </div>
                            </div>
                            <div class="row mt-2">
                                <label class="col-md-3 col-form-label">Observe
                                 </label>
                                 <div class="col-md-9">
                                    <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="write something........"></textarea>
                                 </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Status
                                        </label>
                                        <div class="col-md-7">
                                           <select name="" id="" class="form-control">
                                                <option value="">Active</option>
                                                <option value="">In Active</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <input type="checkbox"> next visit
                                        </label>
                                        <div class="col-md-8">
                                           <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

</x-app-layout>
