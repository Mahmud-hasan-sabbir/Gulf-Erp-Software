<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Item Part's Data Show</h4>
                    <a href="{{ route('mast_item_group.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="{{route('mast_item_group.index', $data->id)}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            @method('GET')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Category Name:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="cat_name" class="form-control" name="cat_name" placeholder="" value="{{ $data->mastItemCategory->cat_name ?? 'N/A'}}" disabled>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Part Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="part_name" class="form-control text-capitalize @error('part_name') is-invalid @enderror" name="part_name" value="{{$data->part_name}}" disabled>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Status
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="status" class="form-control @error('status')is-invalid @enderror" name="status" placeholder="" value="{{ $data->status == 1? 'Active' : 'Inactive' }}" disabled>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Description</label>
                                            <div class="col-md-6">
                                                <input type="text" id="description" class="form-control" name="description" placeholder="" value="{{$data->description}}" disabled>
                                            </div>
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