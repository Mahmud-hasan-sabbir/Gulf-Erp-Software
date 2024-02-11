<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Create Leave</h4>
                    <a href="{{ route('mast_leave.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif

                        <!-- this is from -->
                        <form class="form-valide" action="{{route('mast_leave.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- this is for department name -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Leave Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" id="leave_name" class="form-control @error('leave_name') is-invalid @enderror" name="leave_name" value="{{old('leave_name')}}" pattern="[a-zA-Z]+.*" title="Leave name must start with alphabets then others" autofocus required>                                   
                                            @error('leave_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- this is for max limit -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Max Limit
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="number" id="max_limit" class="form-control @error('max_limit') is-invalid @enderror" name="max_limit" value="{{old('max_limit')}}" data-type="integer" min="0" max="100" required>
                                            @error('max_limit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <!-- this is for leave code -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Leave Code
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="row-lg">
                                            <input type="text" id="leave_code" class="form-control text-uppercase @error('leave_code') is-invalid @enderror" name="leave_code" value="{{old('leave_code')}}">                                 
                                            @error('leave_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- this is for yearly limit -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Yearly Limit
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="number" id="yearly_limit" class="form-control @error('yearly_limit') is-invalid @enderror" name="yearly_limit" value="{{old('yearly_limit')}}" data-type="integer" min="0" max="50" required>
                                            @error('yearly_limit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <!-- this is for description -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Description</label>
                                        <div class="row-lg">
                                            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="" value="{{old('description')}}">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                     <!-- this is for status -->
                                     <div class="form-group col">
                                        <label class="row-lg col-form-label" for="status">Status</label>
                                        <div class="row-lg">
                                            <select class="form-control" id="status" name="status" value="">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
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