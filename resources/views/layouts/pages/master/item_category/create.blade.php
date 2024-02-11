<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Item Category Create</h4>
                    <a href="{{ route('mast_item_category.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="{{route('mast_item_category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Category Name:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="cat_name" class="form-control text-capitalize @error('cat_name') is-invalid @enderror" name="cat_name" value="{{old('cat_name')}}" pattern="[a-zA-Z]+.*" maxlength="40" title="Cat. name must start with alphabets then others" autofocus required>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="" class="col-md-4 col-form-label">Description:</label>
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
                                            <label for="" class="col-md-4 col-form-label">Status:
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