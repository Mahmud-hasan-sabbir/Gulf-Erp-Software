<!DOCTYPE html>
<html>
<head>
	<title>Location of Bangladesh Dropdown</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<center>
			<h3>Bangladesh Map</h3>
		</center>
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
					<li class="list-group-item">Division<span class="badge">{{ $data['division'] }}</span></li>
					<li class="list-group-item">District<span class="badge">{{ $data['district'] }}</span></li>
					<li class="list-group-item">Upazila<span class="badge">{{ $data['upazila'] }}</span></li>
					<li class="list-group-item">Union<span class="badge">{{ $data['union'] }}</span></li>
				</ul>
			</div>
			<div class="col-md-6">
				<form class="form-group">
					<div class="form-group">
						<label for="division">Division</label>
						<select class="form-control" id="division">
							<option selected disabled>Select Division</option>
							@foreach($data['divisions'] as $division)
							<option value="{{ $division->id }}">{{ $division->bn_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="district">District</label>
						<select class="form-control" id="district"></select>
					</div>
					<div class="form-group">
						<label for="upazila">Upazila</label>
						<select class="form-control" id="upazila"></select>
					</div>
					<div class="form-group">
						<label for="thana">Thana</label>
						<select class="form-control" id="thana"></select>
					</div>
					<button class="btn btn-warning">Save</button>
				</form>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#division').change(function(){
			var division_id = $(this).val();
			var option = '';

			$.ajax({
				url : "{{ url('/get-districts') }}",
				method : "GET",
				data : {'division_id' : division_id},
				dataType : 'json',

				success:function(response){
					var district_length = response.length; 
					option += "<option selected disabled>Select District</option>";
	                for( var i = 0; i < district_length; i++){
	                    var id = response[i]['id'];
	                    var district_name = response[i]['bn_name'];
	                    option += "<option value='"+id+"'>"+district_name+"</option>";
	                    $('#district').empty();
	                }
	                $("#district").append(option);
				},
				error:function(){
					console.log("There was an error while fetching District!");
				}
			});
		});

		$('#district').change(function(){
			var district_id = $(this).val();
			var upazila_option = '';

			$.ajax({
				url : "{{ url('/get-upazila') }}",
				method : "GET",
				data : {'district_id' : district_id},
				dataType : 'json',

				success:function(upazilas){
					upazila_option += "<option selected disabled>Select Upazila</option>";
					for(var i = 0; i < upazilas.length; i++){
						var upazila_id = upazilas[i]['id'];
						var upazila_name = upazilas[i]['bn_name'];
						upazila_option += "<option value='"+upazila_id+"'>"+upazila_name+"</option>";
	                    $('#upazila').empty();
					}
					$('#upazila').append(upazila_option);
				},
				error:function(){
					console.log("There was an error while fetching Upazila!");
				}

			});
		});

		$('#upazila').change(function(){
			var upazilas_id = $(this).val();
			var thana_option = '';

			$.ajax({
				url : "{{ url('/get-thana') }}",
				method : "GET",
				data : {'upazilas_id' : upazilas_id},
				dataType : 'json',

				success:function(thana){
					thana_option += "<option selected disabled>Select Thana</option>";
					for(var i = 0; i < thana.length; i++){
						var thana_id = thana[i]['id'];
						var thana_name = thana[i]['bn_name'];
						thana_option += "<option value='"+thana_id+"'>"+thana_name+"</option>";
	                    $('#thana').empty();
					}
					$('#thana').append(thana_option);
				},
				error:function(){
					console.log("There was an error while fetching Thana!");
				}

			});
		});
	});
</script>
</html>