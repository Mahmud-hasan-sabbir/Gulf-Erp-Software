<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Show Holidays</h4>
                    <a href="{{ route('mast_holidays.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide" action="{{route('mast_holidays.store')}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            @method('GET')
                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- this is for designation name -->
                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Holiday Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="" value="{{$data->name}}" disabled>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col">
                                        <label class="row-lg col-form-label">Holiday Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row-lg">
                                            <input type="date" id="name" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="" value="{{$data->date}}" disabled>

                                            @error('name')
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

                                <div class="col-xl-6">
                                    <!-- this is for description -->
                                    <div class="form-group col">
                                        <label>Description</label>

                                        <div class="row-lg">
                                            <textarea class="form-control mt-1 @error('description') is-invalid @enderror" rows="5" id="description" name="description" placeholder="" value="{{$data->description}}" disabled>{{$data->description}}</textarea>
                                            @error('description')
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
