<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Employee Category Edit</h4>
                    <a href="{{ route('must_employee_category.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif

                        <!-- this is from -->
                        <form class="form-valide" action="{{route('must_employee_category.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-6">

                                    <!-- this is for category name -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Category Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" id="cat_name" class="form-control text-capitalize @error('cat_name') is-invalid @enderror" name="cat_name" value="{{$data->cat_name}}" pattern="[a-zA-Z]+.*" title="Cat. name must start with alphabets then others" autofocus required> 
                                            @error('cat_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- this is for description -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Description</label>
                                        <div class="row-lg">
                                            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="" value="{{$data->description}}">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <!-- this is for category type -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label" for="status">Category Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <select class="form-control" id="cat_type" name="cat_type" value="">
                                                <option value="1" {{ $data->cat_type == 1? 'selected': '' }}>In</option>
                                                <option value="0" {{ $data->cat_type == 0? 'selected': '' }}>Out</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- this is for status -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label" for="status">Status</label>
                                        <div class="row-lg">
                                            <select class="form-control" id="status" name="status" value="">
                                                <option value="1" {{ $data->status == 1? 'selected': '' }}>Active</option>
                                                <option value="0" {{ $data->status == 0? 'selected': '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- submit button -->
                                <div class="col-lg">
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