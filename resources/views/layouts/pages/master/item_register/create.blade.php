<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">Item Register</h4>
                    <a href="{{ route('mast_item_register.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="form-validation">
                        <!-- this is for validation checking message -->
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <!-- this is from -->
                        <form class="form-valide mr-3" action="{{route('mast_item_register.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Item Category
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_category_id" id="itemCategory" required>
                                                    <option value="" selected disabled>-- Select Category --</option>
                                                    <option value="1">AC</option>
                                                    <option value="2">AC Spare parts</option>
                                                    <option value="3">Car spare parts</option>
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
                                                <select class="form-control dropdwon_select" id="itemGroup" name="mast_item_group_id" required></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ac">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Ton/Capacities</label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="mast_item_models_id" id="loadTon"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Unit
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" id="loadUnit" name="unit_id" required></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 unitSH" style="display: none">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Type (Optional)
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control dropdwon_select" name="unit_type" id="unitType">
                                                    <option value="" selected>-- Select --</option>
                                                    <option value="1">Indoor</option>
                                                    <option value="2">Outdoor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label model_name">Model Number
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="partNo" disabled>
                                                <input type="text" class="form-control @error('part_no') is-invalid @enderror" name="part_no" id="part_no" value="{{old('part_no')}}" style="display: none">
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
                                                <input type="number" class="form-control @error('box_qty') is-invalid @enderror" name="box_qty" id="box_qty" value="{{old('box_qty')}}">
                                                @error('box_qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 none_ac" style="display: none">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Box Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control  @error('box_code') is-invalid @enderror" name="box_code" id="box_code" value="{{old('box_code')}}" min="1">
                                                @error('box_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 none_ac" style="display: none">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-md-4 col-form-label">Gulf Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control @error('gulf_code') is-invalid @enderror" name="gulf_code" id="gulf_code" value="{{old('gulf_code')}}" min="1">
                                                @error('gulf_code')
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
                                            <label for="" class="col-md-4 col-form-label">Price
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{old('price')}}" step="any" required>
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
                                                <select name="warranty" class="form-control default-select @error('warranty') is-invalid @enderror">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="1" {{ old('warranty') == '1' ? 'selected' : '' }}>One Month</option>
                                                    <option value="2" {{ old('warranty') == '2' ? 'selected' : '' }}>Two Month</option>
                                                    <option value="3" {{ old('warranty') == '3' ? 'selected' : '' }}>Three Month</option>
                                                    <option value="6" {{ old('warranty') == '6' ? 'selected' : '' }}>Six Month</option>
                                                    <option value="12" {{ old('warranty') == '12' ? 'selected' : '' }}>1 Year</option>
                                                    <option value="24" {{ old('warranty') == '24' ? 'selected' : '' }}>2 Years</option>
                                                    <option value="36" {{ old('warranty') == '36' ? 'selected' : '' }}>3 Years</option>
                                                    <option value="48" {{ old('warranty') == '48' ? 'selected' : '' }}>4 Years</option>
                                                    <option value="60" {{ old('warranty') == '60' ? 'selected' : '' }}>5 Years</option>
                                                    <option value="72" {{ old('warranty') == '72' ? 'selected' : '' }}>6 Years</option>
                                                    <option value="84" {{ old('warranty') == '84' ? 'selected' : '' }}>7 Years</option>
                                                    <option value="96" {{ old('warranty') == '96' ? 'selected' : '' }}>8 Years</option>
                                                    <option value="108" {{ old('warranty') == '108' ? 'selected' : '' }}>9 Years</option>
                                                    <option value="120" {{ old('warranty') == '120' ? 'selected' : '' }}>10 Years</option>
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
                                <div class="col-sm-6 none_ac" style="display: none">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="image" class="col-md-4 col-form-label">Image</label>
                                            <div class="col-md-8">
                                                <input type="file" name="image" class="form-controlf @error('image') is-invalid @enderror" alt="" accept=".jpg, .jpeg, .png, .gif">
                                                @error('image')
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
                                            <label for="" class="col-md-4 col-form-label">Description</label>
                                            <div class="col-md-8">
                                                <textarea name="description" class="text form-control @error('description') is-invalid @enderror" rows="1">{{old('description')}}</textarea>
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
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
                                </div>
                            </div>

                        <form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script type="text/javascript">
        $(document).on('change','#itemCategory',function () {
            var itemCategory = $(this).val();
            $.ajax({
                url:'{{route('get-part-name')}}',
                method:'GET',
                dataType:"html",
                data:{'id': itemCategory},
                success: function(data){
                    $('#itemGroup').html(data);
                }
            });
            if(itemCategory==1){
                $('.ac').show();
                $('.none_ac').hide();
                $('#partNo').show();
                $('#part_no').hide();
                $('.model_name').text("Model Number");
            }else{
                $('.ac').hide();
                $('.none_ac').show();
                $('#partNo').hide();
                $('#part_no').show();
                $('.model_name').text("Part Number");
            }
        });
        $(document).on('change', '#itemGroup', function () {
            var itemCategory = $('#itemCategory').val();
            var id = $(this).val();
            // Send an AJAX request to the server to get data
            $.ajax({
                url: '{{ route('get-unit-name') }}',
                method: 'GET',
                dataType: 'json',
                data: { 'mast_item_category_id': itemCategory, 'mast_item_group_id': id },
                success: function (data) {
                    // SET TON
                    var loadTonSelect = $('#loadTon');
                    loadTonSelect.empty();
                    loadTonSelect.append('<option value="" selected disabled>-- Select --</option>');

                    $.each(data.mastItemModels, function (index, row) {
                        loadTonSelect.append('<option value="' + row.id + '">' + row.ton + '</option>');
                    });
                    
                    // SET UNIT
                    var loadUnitSelect = $('#loadUnit');
                    loadUnitSelect.empty();

                    $.each(data.mstUnit, function (index, row) {
                        var selected = (row.id == '{{ old('mast_item_group_id') }}') ? 'selected' : '';
                        loadUnitSelect.append('<option value="' + row.id + '" ' + selected + '>' + row.unit_name + '</option>');
                    });
                    
                },
                error: function () {
                    alert('Fail');
                }
            });
        });



        $(document).on('change','#loadTon',function () {
            var id = $(this).val();
            getItemModels(id);
        });
        $(document).on('change','#loadUnit',function () {
            var id = $(this).val();
            if(id == 1){//Unit -> 1 => Set
                var loadTon = $('#loadTon').val();
                getItemModels(loadTon);
                $('.unitSH').hide();
                // $('#unitType').prop("disabled", true);
            }else if(id == 2){// Unit -> 2 => Pices
                $('#part_no').val('');
                $('#partNo').val('');
                $('.unitSH').show();
                // $('#unitType').prop("disabled", false);
            }
        });
        $(document).on('change','#unitType',function () {
            var loadTon = $('#loadTon').val();
            getItemModels(loadTon);
        });

        function getItemModels(id){
            $.ajax({
                url: '{{ route('get-item-models')}}',
                method: 'GET',
                dataType: 'JSON',
                data: { 'id': id },
                success: function(data) {
                    var unit_id = $('#loadUnit').val();
                    if(unit_id == 1){
                        $('#partNo').val(data.full_set);
                        $('#part_no').val(data.full_set);
                    }else{
                        $('#part_no').val('');

                        var unitType = $('#unitType').val();
                        if(unitType == 1){
                            $('#partNo').val(data.indoor);
                            $('#part_no').val(data.indoor);
                        }else if(unitType == 2){
                            $('#partNo').val(data.outdoor);
                            $('#part_no').val(data.outdoor);
                        }else{
                            $('#part_no').val('');
                        }
                    } 
                },
                error: function() {
                    alert('Fail');
                }
            });
        }

        //----Validation
        $(document).ready(function() {
            const inputBC = $("#box_code");
            const inputGC = $("#gulf_code");
            // const inputPO = $("#part_no");
            const inputBQ = $("#box_qty");
            const inputPC = $("#price");
            
            const maskBC = new IMask(inputBC[0], { mask: "000000000" });
            const maskGC = new IMask(inputGC[0], { mask: "000000000" });
            // const maskPO = new IMask(inputPO[0], { mask: "000000000" });
            const maskBQ = new IMask(inputBQ[0], { mask: "000000000" });
            const maskPC = new IMask(inputPC[0], { mask: "000000000" });
            
            // You can access unmasked values like this:
            // const unmaskedBC = maskBC.unmaskedValue;
            // const unmaskedGC = maskGC.unmaskedValue;
            // const unmaskedPO = maskPO.unmaskedValue;
            // const unmaskedBQ = maskBQ.unmaskedValue;
            // const unmaskedPC = maskPC.unmaskedValue;
        });
    </script>
    @endpush
</x-app-layout>