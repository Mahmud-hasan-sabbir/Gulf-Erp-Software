<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                        @if ($type == 1) Distributor Create
                        @elseif ($type == 2) Corporate Create
                        @else Retailer Create
                        @endif
                    </h4>
                    <a href="{{route("customer.index",['cat_id' => $type])}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide mt-0" action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="mast_customer_type_id" value="{{$type}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">
                                            @if ($type == 1) Distributor Name
                                            @elseif ($type == 2) Corporate Name
                                            @else Retailer Name
                                            @endif
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('dept_name')}}" >
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Credit Limit
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control @error('credit_limit') is-invalid @enderror" name="credit_limit" value="{{old('credit_limit')}}" >
                                            @error('credit_limit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Phone
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" >
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" >
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}" >
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Web Url
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="url" class="form-control @error('web_address') is-invalid @enderror" name="web_address" value="{{old('web_address')}}" >
                                            @error('web_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr><p class="text-label bg-white text-primary" style="margin-top:-30px;font-style:bold;width:130px">Contact Person </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Person Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('cont_person') is-invalid @enderror" name="cont_person" value="{{old('cont_person')}}" >
                                            @error('cont_person')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Designation</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('cont_designation') is-invalid @enderror" name="cont_designation" value="{{old('cont_designation')}}" >
                                            @error('cont_designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Email</label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control @error('cont_email') is-invalid @enderror" name="cont_email" value="{{old('cont_email')}}" >
                                            @error('cont_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-4 col-form-label">Phone</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('cont_phone') is-invalid @enderror" name="cont_phone" value="{{old('cont_phone')}}" >
                                            @error('cont_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-2 col-form-label">Remarks:</label>
                                        <div class="col-md-10">
                                            <textarea  id="" cols="30" rows="1" class="form-control" name="remarks" placeholder="Please Write Something..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-1">
                                        <label for="" class="col-md-8"></label>
                                        <button type="submit" class="btn btn-success btn-sm" style="margin-left: 270px">Submit</button>
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


