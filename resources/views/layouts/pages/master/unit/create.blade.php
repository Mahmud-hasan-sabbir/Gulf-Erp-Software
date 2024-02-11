<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Unit Create</h4>
                    <a href="{{ route('mast_unit.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="{{route('mast_unit.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Item Category
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_category_id" required>
                                                    <option value="" selected disabled>-- Select Category --</option>
                                                    <option value="1">AC</option>
                                                    <option value="2">AC Spare parts</option>
                                                    <option value="3">Car spare parts</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Unit Name:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="unit_name" class="form-control text-capitalize" name="unit_name" maxlength="40" value="{{old('unit_name')}}" required>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 col-form-label">Description:</label>
                                                <div class="col-md-6">
                                                    <textarea class="text form-control" id="description" name="description" rows="1" maxlength="250"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mr-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4 col-form-label" for="status">Status:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="status" name="status" value="">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-success btn-sm float-right mr-3">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

