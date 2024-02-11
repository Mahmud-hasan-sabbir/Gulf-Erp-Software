<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Air Conditioner Models Create</h4>
                    <a href="{{ route('mast_item_models.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="{{route('mast_item_models.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Item Group
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_group_id" required>
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach ($itemGroup as $row)
                                                        <option value="{{$row->id}}"{{ old('mast_item_group_id') == $row->id ? 'selected' : '' }}>{{ $row->part_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Ton
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control  @error('ton') is-invalid @enderror" name="ton" id="box_code" maxlength="40" value="{{old('ton')}}">
                                                @error('ton')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Cooling Capacity
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control  @error('coling_capacity') is-invalid @enderror" name="coling_capacity" id="coling_capacity" maxlength="40" value="{{old('coling_capacity')}}">
                                                @error('coling_capacity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Indoor
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control  @error('indoor') is-invalid @enderror" name="indoor" id="indoor" value="{{old('indoor')}}"  maxlength="40">
                                                @error('indoor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Outdoor
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control  @error('outdoor') is-invalid @enderror" name="outdoor" id="outdoor" value="{{old('outdoor')}}"  maxlength="40">
                                                @error('outdoor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Full Set
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control  @error('full_set') is-invalid @enderror" name="full_set" id="full_set" value="{{old('full_set')}}"  maxlength="40">
                                                @error('full_set')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4 col-form-label" for="status">Status</label>
                                            <div class="col-md-8">
                                                <select class="form-control default-select" id="status" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
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

