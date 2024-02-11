<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Unit Data Show</h4>
                    <a href="{{ route('mast_unit.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="" method="GET" enctype="multipart/form-data">
                            @csrf<div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Item Category
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_category_id" disabled>
                                                    <option value="" selected disabled>-- Select Category --</option>
                                                    <option value="1" {{ $data->mast_item_category_id == 1 ? 'selected': '' }}>AC</option>
                                                    <option value="2" {{ $data->mast_item_category_id == 2 ? 'selected': '' }}>AC Spare parts</option>
                                                    <option value="3" {{ $data->mast_item_category_id == 3 ? 'selected': '' }}>Car spare parts</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Unit Name:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="unit_name" class="form-control" name="unit_name" value="{{$data->unit_name}}" disabled>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 col-form-label">Description:</label>
                                                <div class="col-md-6">
                                                    <textarea class="text form-control" id="description" name="description" disabled>{{$data->description}}</textarea>
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
                                            <label class="col-md-4 col-form-label" for="status">Status:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="status" class="form-control @error('status')is-invalid @enderror" name="status" placeholder="" value="{{ $data->status == 1 ? 'Active' : 'Inactive' }}" disabled> 
                                            </div>
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

