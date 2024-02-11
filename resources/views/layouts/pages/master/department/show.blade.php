<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Show Department</h4>
                    <a href="{{ route('mast_department.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span
                            class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">

                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                        <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form action="" method="GET" enctype="multipart/form-data">
                            @csrf
                            @method('GET')
                            <div class="row">

                                <div class="col-xl-6">

                                    <!-- this is for deptartment name -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Department Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="dept_name" class="form-control" name="dept_name" placeholder="" value="{{$data->dept_name}}" disabled>
                                            @error('dept_name')
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
                                            <input type="text" id="description" class="form-control" name="description" placeholder="" value="{{$data->description}}" disabled>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">

                                    <!-- this is for department head -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label">Department Head
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="dept_head" class="form-control" name="dept_head" placeholder="" value="{{ $data->user->name}}" disabled>

                                            @error('dept_head')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <!-- this is for status -->
                                    <div class="form-group col">

                                        <label class="row-lg col-form-label" for="status">Status</label>

                                        <div class="row-lg">
                                            <input type="text" id="status" class="form-control @error('status')is-invalid @enderror" name="status" placeholder="" value="{{ $data->status == 1? 'Active' : 'Inactive' }}" disabled>

                                            @error('dept_head')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
