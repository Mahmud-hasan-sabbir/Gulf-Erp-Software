<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Designation Create</h4>
                    <a href="{{ route('mast_designation.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">

                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif

                        <!-- this is from -->
                        <form class="form-valide" action="{{route('mast_designation.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">

                                    <!-- this is for designation name -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Designation Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" id="desig_name" class="form-control text-capitalize @error('desig_name') is-invalid @enderror" name="desig_name" placeholder="" value="{{old('desig_name')}}">
                                            @error('desig_name')
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
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <!-- this is for description -->
                                    <div class="form-group col">
                                        <label>Description:</label>
                                        <div class="row-lg">
                                            <textarea class="form-control mt-1 @error('description') is-invalid @enderror" rows="5" id="description" name="description" placeholder="">{{old('description')}}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
