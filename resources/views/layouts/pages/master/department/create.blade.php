<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Department Create</h4>
                    <a href="{{ route('mast_department.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide" action="{{route('mast_department.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- this is for deptartment name -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Department Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" class="form-control text-capitalize @error('dept_name') is-invalid @enderror" name="dept_name" placeholder="" value="{{old('dept_name')}}" pattern="[a-zA-Z]+.*"> 
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
                                    <!-- this is for department head -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Department Head
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <select class="form-control dropdwon_select" id="dept_head" name="dept_head" required>
                                                <option selected disabled>Please select</option>
                                                @foreach ($data as $data)
                                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                                @endforeach
                                            </select>
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


