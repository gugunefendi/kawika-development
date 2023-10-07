@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Pengaturan</h1>
    </div>

    <!-- <h2>Section title</h2> -->

		@if ($form_type == 'create')
			<form action="{{ route('setting.store') }}" method="post">
					@csrf
					<div class="row g-3 align-items-center mb-3">
							<div class="mb-3">
									<label class="form-label">Alamat</label>
									<textarea name="alamat" id="" cols="30" rows="5" class="form-control form-beli" required></textarea>
							</div>
							<div class="form-group mb-3">
								<label for="province">Provinsi:</label>
								<select name="province_id" id="province" class="form-control" required>
										<option value="">Pilih Provinsi</option>
										@foreach ($provinces as $myProvince)
										<option value="{{ $myProvince->id }}" data-cities="{{ json_encode($myProvince->cities) }}">
												{{ $myProvince->province }}</option>
										@endforeach
								</select>
						</div>

						<div class="form-group mb-3">
								<label for="city_id">Kota:</label>
								<select name="city_id" id="city_id" class="form-control" required>
										<option value="">Pilih Kota</option>
								</select>
						</div>
					</div>
					<div class="row g-3 align-items-center mb-3">
							<div class="col-2">
							</div>
							<div class="col-10">
									<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
					</div>

			</form>
		@else
			<form action="{{ route('setting.update', $setting->id) }}" method="post">
					@csrf
					@method('PUT')
					<div class="row g-3 align-items-center mb-3">
							<div class="mb-3">
									<label class="form-label">Alamat</label>
									<textarea name="alamat" id="" cols="30" rows="5" class="form-control form-beli" required>{{ $setting->alamat }}
									</textarea>
							</div>
							<div class="form-group mb-3">
								<label for="province">Provinsi:</label>
								<select name="province_id" id="province" class="form-control" required>
										<option value="">Pilih Provinsi</option>
										@foreach ($provinces as $myProvince)
										<option value="{{ $myProvince->id }}" {{ $setting->province_id ==  $myProvince->id ? 'selected' : '' }} data-cities="{{ json_encode($myProvince->cities) }}">
												{{ $myProvince->province }}</option>
										@endforeach
								</select>
						</div>

						<div class="form-group mb-3">
								<label for="city_id">Kota:</label>
								<select name="city_id" id="city_id" class="form-control" required data-id="{{ $setting->city_id }}">
										<option value="">Pilih Kota</option>
								</select>
						</div>
					</div>
					<div class="row g-3 align-items-center mb-3">
							<div class="col-2">
							</div>
							<div class="col-10">
									<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
					</div>

			</form>
		@endif
</main>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#province').on('change', function () {
            var cities = $(this).find(':selected').data('cities');
            var cityOptions = '<option value="">Pilih Kota</option>';
            if (cities) {
                cities.forEach(function (city) {
                    cityOptions += '<option value="' + city.id + '">' + city.city_name + '</option>';
                });
            }
            $('#city_id').html(cityOptions);
        });

				var citiyselected = $('#province').val();
				var form_type = "{{ $form_type }}";
				if (form_type == 'update') {
					if (citiyselected != 'null') {
							var cities = $('#province').find(':selected').data('cities');
							var cityOptions = '<option value="">Pilih Kota</option>';
							var cityselectdb = $('#city_id').data('id');
							if (cities) {
									cities.forEach(function (city) {

											if (cityselectdb == city.id) {
												cityOptions += '<option value="' + city.id + '" selected>' + city.city_name + '</option>';
											} else {
												cityOptions += '<option value="' + city.id + '">' + city.city_name + '</option>';
											}
									});
							}
							$('#city_id').html(cityOptions);
					}
				}
    });
</script>
@endsection
