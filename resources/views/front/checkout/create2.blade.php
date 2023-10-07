@extends('user.master')

@section('content')
<div class="container mt-5 mb-5">
    <h3>Detail Pengiriman</h3>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <!-- Tambahkan input hidden untuk menyimpan ID produk -->
        <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">

        <!-- Tampilkan detail produk -->
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset($product->images[0]->path)}}" class="img-fluid rounded-start"
                        alt="..." width="170">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title m-0">{{ $product->product_name }}</h5>
                        <p class="card-text m-0">Rp {{ $product->product_price }}</p>
                        <p class="card-text m-0">Ukuran: {{ $selected_size }}</p>
                        <p class="card-text m-0">Warna: {{ $selected_color }}</p>
                        <p class="card-text m-0">Jumlah: {{ $selected_quantity }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan informasi pengiriman -->
        <div class="form-group mb-3">
            <label for="buyer">Nama:</label>
            <input type="text" class="form-control" id="buyer" name="buyer">
        </div>
        <div class="form-group mb-3">
            <label for="no_phone">No Telepon / WhatsApp:</label>
            <input type="tel" class="form-control" id="no_phone" name="no_phone">
        </div>
        <div class="form-group mb-3">
            <label for="address">Alamat:</label>
            <textarea class="form-control" id="address" name="address" rows="4"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="buyer">Tambahkan Catatan <small>(Opsional)</small>:</label>
            <textarea name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="province">Provinsi:</label>
            <select name="province" id="province" class="form-control">
                <option value="">Pilih Provinsi</option>
                @foreach ($provinces as $myProvince)
                <option value="{{ $myProvince->id }}" data-cities="{{ json_encode($myProvince->cities) }}">
                    {{ $myProvince->province }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="city_id">Kota:</label>
            <select name="city_id" id="city_id" class="form-control">
                <option value="">Pilih Kota</option>
            </select>
        </div>
        <div class="form-group mb-3" style="display:none">
            <label for="weight">Berat:</label>
            <input type="text" name="weight" id="weight" value="{{ $product->product_weight }}"class="form-control" readonly>
        </div>
        <div class="form-group mb-3">
            <label for="courier">Kurir:</label>
            <select name="courier" id="courier" class="form-control">
                <option value="">Pilih Kurir</option>
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS Indonesia</option>
            </select>
        </div>
      <div class="row">
      <input type="hidden" name="selected_size" value="{{ $selected_size }}">
      <input type="hidden" name="selected_color" value="{{ $selected_color }}">
      <input type="hidden" name="selected_quantity" value="{{ $selected_quantity }}">
      <input type="hidden" name="productPrice" value="{{ $product->product_price }}">
      <input type="hidden" name="productCategory" value="{{ $product->category_id}}">
      <input type="hidden" name="shipping_cost" id="shippingCost" value="">
      
        <div id="shippingCostResult" style="display: none;">
            <div id="shippingPackages">
                <!-- Daftar paket pengiriman akan ditampilkan di sini -->
            </div>
        </div>
        <div id="loadingContainer" style="display: none;">
                <img src="https://media.tenor.com/On7kvXhzml4AAAAC/loading-gif.gif" width="50" alt="Loading...">
            </div>
      </div>
        <button type="submit" class="btn btn-primary mt-3">Buat Pesanan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {

        // Perbarui dropdown kota saat provinsi dipilih
        $('#province').on('change', function () {
            var cities = $(this).find(':selected').data('cities');

            // Perbarui dropdown kota berdasarkan provinsi yang dipilih
            var cityOptions = '<option value="">Pilih Kota</option>';
            if (cities) {
                cities.forEach(function (city) {
                    cityOptions += '<option value="' + city.id + '">' + city.city_name + '</option>';
                });
            }
            $('#city_id').html(cityOptions);

            // Panggil fungsi untuk menghitung biaya pengiriman
            calculateShipping();
        });

        // Perbarui biaya pengiriman saat kota atau kurir dipilih
        $('#city_id, #courier').on('change', function () {
            calculateShipping();
        });

        // Fungsi untuk menghitung biaya pengiriman
        function calculateShipping() {
            var provinceId = $('#province').val();
            var cityId = $('#city_id').val();
            var weight = $('#weight').val();
            var courier = $('#courier').val();

            // Periksa apakah semua input terisi
            if (provinceId && cityId && courier) {
                $('#loadingContainer').show();

                // Lakukan permintaan AJAX untuk menghitung biaya pengiriman
                $.ajax({
                    url: '{{ route("calculate.shipping") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Tambahkan token CSRF
                        province_id: provinceId,
                        city_id: cityId,
                        weight: weight,
                        courier: courier,
                        selected_size: $('input[name="selected_size"]').val(),
                        selected_color: $('input[name="selected_color"]').val(),
                        selected_quantity: $('input[name="selected_quantity"]').val(),
                        productPrice: $('input[name="productPrice"]').val(),
                        productCategory: $('input[name="productCategory"]').val(),
                    },
                    success: function (response) {
                         // Sembunyikan gambar loading
                         $('#loadingContainer').hide();
                        // Tampilkan hasil biaya pengiriman
                        $('#shippingCostResult').show();
                        
                        // Tampilkan daftar paket pengiriman
                        var packages = response.packages;
                        var packageOptions = '';
                        packages.forEach(function (package) {
                            packageOptions += '<div class="form-check">' +
                                '<input class="form-check-input" type="radio" name="package" id="' +
                                package.service + '" value="' + package.value + '">' +
                                '<label class="form-check-label" for="' + package.service + '">' +
                                package.etd + ' Hari' + ' - ' + '<b>Rp ' + package.value + '</b>' + ' - ' + ' (' + package.service + ' ' + package.description + ')' +
                                '</label>' +
                                '</div>';
                        });
                        $('#shippingPackages').html(packageOptions);

                        // Tangani perubahan pada radio button paket pengiriman
                        $('input[name="package"]').on('change', function () {
                            var shippingCost = $(this).val();
                            $('#shippingCost').val(shippingCost);
                        });
                    },
                    error: function (xhr, status, error) {
                        // Tangani respon kesalahan
                        console.log(xhr.responseText);
                    }
                });
            } else {
                // Jika ada input yang belum terisi, sembunyikan hasil biaya pengiriman
                $('#shippingCostResult').hide();
                $('#shippingPackages').html('');
                $('#shippingCost').val('');
                $('#loadingContainer').hide();
            }
        }
    });
</script>

@endsection
