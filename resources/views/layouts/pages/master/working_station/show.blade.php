<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Working Station Show</h4>
                    <a href="{{ route('mast_working_station.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">

                            <!-- this is for designation name -->
                            <div class="form-group col">
                                <label class="row-lg col-form-label">Store Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="row-lg">
                                    <input type="text" id="store_name" class="form-control @error('store_name') is-invalid @enderror" name="store_name" placeholder="" value="{{$data->store_name}}" disabled>

                                    @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- this is for status -->
                            <div class="form-group col">
                                <label class="row-lg col-form-label">Location
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="row-lg">
                                    <input type="text" id="location" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="" value="{{$data->location}}" disabled>

                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-6">

                            <!-- this is for designation name -->
                            <div class="form-group col">
                                <label class="row-lg col-form-label">Contact Number
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="row-lg">
                                    <input type="text" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" placeholder="" value="{{$data->contact_number}}" disabled>

                                    @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- this is for status -->
                            <div class="form-group col">
                                <label class="row-lg col-form-label" for="status">Status
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="row-lg">
                                    <select class="form-control default-select" id="status" name="status" disabled>
                                        <option value="1" {{ $data->status == 1? 'selected': '' }}>Active</option>
                                        <option value="0" {{ $data->status == 0? 'selected': '' }}>Inactive</option>
                                    </select>  
                                </div>
                            </div>
                        </div>
                        

                        
                        <div class="col-md-12">

                            <!-- this is for description -->
                            <div class="form-group col">
                                <label class="row-md col-form-label">Description:</label>
                                <div class="row-md">
                                    <textarea class="form-control mt-1 @error('description') is-invalid @enderror" rows="5" id="description" name="description" disabled>{{$data->description}}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>  
 


