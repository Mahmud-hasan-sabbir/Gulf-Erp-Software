<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Supplier Edit</h4>
                    <a href="{{ route('mast_supplier.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="{{route('mast_supplier.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-5 col-form-label">Supplier Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="supplier_name" maxlength="40" value="{{$data->supplier_name}}" required>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-5 col-form-label">Contact Person
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="contact_person" maxlength="40" value="{{$data->contact_person}}" required>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-5 col-form-label">Email</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="email" maxlength="40" value="{{$data->email}}" required>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-5 col-form-label">Phone Number</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="phone_number" maxlength="40" value="{{$data->phone_number}}" required>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-5 col-form-label">Address</label>
                                            <div class="col-md-7">
                                                    <textarea class="text form-control" name="address" rows="1" maxlength="250">{{$data->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-5 col-form-label">Status</label>
                                            <div class="col-md-7">
                                                <select class="form-control default-select" id="status" name="status" value="">
                                                    <option value="1" {{$data->address == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{$data->address == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

