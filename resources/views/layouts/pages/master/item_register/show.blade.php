<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Item Show</h4>
                    <a href="{{ route('mast_item_register.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Item Category
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_category_id" id="itemCategory" disabled>
                                                    <option value="" selected disabled>-- Select Category --</option>
                                                    <option value="1" {{$data->mast_item_category_id == 1 ? 'selected' : '' }}>AC</option>
                                                    <option value="2" {{$data->mast_item_category_id == 2 ? 'selected' : '' }}>AC Spare parts</option>
                                                    <option value="3" {{$data->mast_item_category_id == 3 ? 'selected' : '' }}>Car spare parts</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Part Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" id="itemGroup" name="mast_item_group_id" disabled>
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach ($item_group as $row)
                                                        <option value="{{$row->id}}" {{ $data->mast_item_group_id == $row->id ? 'selected' : '' }}>{{ $row->part_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->mast_item_category_id == 1)
                                <div class="col-sm-6 ac">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Ton/Capacities</label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_models_id" id="loadTon" disabled>
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach ($mastItemModels as $row)
                                                        <option value="{{$row->id}}" {{ $data->mast_item_models_id == $row->id ? 'selected' : '' }}>{{ $row->ton}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Unit
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" id="loadUnit" name="unit_id" disabled>
                                                    <option value="" selected disabled>-- Select --</option>
                                                    @foreach ($unit as $row)
                                                        <option value="{{$row->id}}" {{ $data->unit_id == $row->id ? 'selected' : '' }}>{{ $row->unit_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->mast_item_category_id == 1)
                                <div class="col-sm-6 unitSH" style="display: none">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Type (Optional)
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="unit_type" id="unitType" disabled>
                                                    <option value="" selected>-- Select --</option>
                                                    <option value="1">Indoor</option>
                                                    <option value="2">Outdoor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label model_name">Model Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="partNo" disabled value="{{$data->part_no}}">
                                                <input type="text" class="form-control @error('part_no') is-invalid @enderror" name="part_no" id="part_no" value="{{$data->part_no}}" style="display: none" disabled>
                                                @error('part_no')
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
                                            <label for="" class="col-md-4 col-form-label">Quantity
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('box_qty') is-invalid @enderror" name="box_qty" id="box_qty" value="{{$data->box_qty}}" disabled>
                                                @error('box_qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->mast_item_category_id != 1)
                                <div class="col-sm-6 none_ac">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Box Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control  @error('box_code') is-invalid @enderror" name="box_code" id="box_code" value="{{$data->box_code}}" min="1" disabled>
                                                @error('box_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 none_ac">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Gulf Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('gulf_code') is-invalid @enderror" name="gulf_code" id="gulf_code" value="{{$data->gulf_code}}" min="1" disabled>
                                                @error('gulf_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Price
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{$data->price}}" step="any" disabled>
                                                @error('price')
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
                                            <label class="col-md-4 col-form-label">Warranty
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="warranty" class="form-control default-select @error('warranty') is-invalid @enderror" disabled>
                                                    <option selected="">Choose...</option>
                                                    <option value="1" {{$data->warranty == 1 ? 'selected':''}}>One Mounth</option>
                                                    <option value="2" {{$data->warranty == 2 ? 'selected':''}}>Two Mounth</option>
                                                    <option value="3" {{$data->warranty == 3 ? 'selected':''}}>Three Mounth</option>
                                                    <option value="6" {{$data->warranty == 6 ? 'selected':''}}>Six Mounth</option>
                                                    <option value="12" {{$data->warranty == 12 ? 'selected':''}}>1 Years</option>
                                                    <option value="24" {{$data->warranty == 24 ? 'selected':''}}>2 Years</option>
                                                    <option value="36" {{$data->warranty == 36 ? 'selected':''}}>3 Years</option>
                                                    <option value="48" {{$data->warranty == 48 ? 'selected':''}}>4 Years</option>
                                                    <option value="60" {{$data->warranty == 60 ? 'selected':''}}>5 Years</option>
                                                    <option value="72" {{$data->warranty == 72 ? 'selected':''}}>6 Years</option>
                                                    <option value="84" {{$data->warranty == 84 ? 'selected':''}}>7 Years</option>
                                                    <option value="96" {{$data->warranty == 96 ? 'selected':''}}>8 Years</option>
                                                    <option value="108" {{$data->warranty == 108 ? 'selected':''}}>9 Years</option>
                                                    <option value="120" {{$data->warranty == 120 ? 'selected':''}}>10 Years</option>
                                                </select>
                                                @error('warranty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->mast_item_category_id != 1)
                                <div class="col-sm-6 none_ac">
                                    <div class="form-group">
                                        <div class="row"> 
                                            <label for="image" class="col-md-4 col-form-label">Image</label>
                                            <div class="col-md-8">
                                                <img src="{{asset('public')}}/images/car-parts/{{ $data->image }}" alt="" width="100%">
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Description</label>
                                            <div class="col-md-8">
                                                <textarea name="description" class="text form-control @error('description') is-invalid @enderror" rows="1" disabled>{{$data->description}}</textarea>
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
            </div>
        </div>
    </div>
</x-app-layout>

