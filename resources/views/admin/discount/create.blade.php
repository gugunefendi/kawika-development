@extends('admin.layouts.app')
@section('datatable-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection
@section('icon')
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
@endsection
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Tambah Diskon</h3>
    </div>
    <div class="alert alert-success" id="success-alert" style="display:none">
        Diskon berhasil di buat
    </div>
    <form id="discountForm" action="{{ route('discount.store') }}" method="post">
        @csrf
        <div class="table-responsive">
            <table id="diskonTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Harga Setelah Diskon</th>
                        <th scope="col">Tggl Mulai</th>
                        <th scope="col">Tggl Berkahir</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($productsWithoutDiscount as $key => $product)
                            <tr>
                                <td class="text-end"></td>
                                <td>
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->images->first()->nama_file }}" width="50">
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>Rp{{ number_format($product->product_price, 0, ',', '.') }}</td>
                                <td><input type="number" name="discount" id="discount" required class="form-control" placeholder="25%" style="border:none"></td>
                                <td><input name="priceAfterDiscount" id="priceAfterDiscount" class="form-control" style="background:#fff;border:none;" ></td>
                                <td><input type="date" name="start_discount" required class="form-control" style="border:none"></td>
                                <td><input type="date" name="end_discount" required class="form-control" style="border:none"></td>
                                <td><button type="submit" class="btn btn-primary btn-md save-discount" data-product-id="{{ $product->id }}" >Simpan</button></td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </form>
</main>
<style>
    td {
        vertical-align: middle; /* Mengatur elemen di tengah secara vertikal */
    }
    /* CSS untuk alert sukses */
    .alert-success {
        background-color: #4CAF50; /* Warna latar belakang hijau */
        color: #fff; /* Warna teks putih */
        padding: 10px; /* Padding agar teks tidak terlalu rapat */
        border-radius: 5px; /* Membuat sudut elemen menjadi melengkung */
        margin-top: 10px;
    }
</style>
@endsection
@section('datatable-js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- simpan data discount -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var discountInput = document.getElementById('discount');
        var priceAfterDiscountInput = document.getElementById('priceAfterDiscount');

            // Menambahkan event listener untuk menghitung harga setelah diskon
            discountInput.addEventListener('input', function() {
                
                // Mendapatkan harga produk dan diskon
                var productPrice = parseFloat({{$product->product_price}}) ;
                var discount = parseFloat(discountInput.value);
                    
                // Memeriksa apakah discount adalah angka yang valid
                if (!isNaN(discount)) {
                    // Menghitung harga setelah diskon jika discount adalah angka yang valid
                    var priceAfterDiscount = (productPrice * (100 - discount)) / 100;
                    priceAfterDiscount = priceAfterDiscount >= 0 ? priceAfterDiscount : 0; // Pastikan harga setelah diskon tidak negatif
                    
                    // Menampilkan harga setelah diskon dengan format yang diinginkan
                    priceAfterDiscountInput.value = 'Rp' + priceAfterDiscount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                } else {
                    // Jika discount bukan angka yang valid, kosongkan input harga setelah diskon
                    priceAfterDiscountInput.value = '';
                }
            });
    </script>
    <script>
        $(document).ready(function () {                
            $('.save-discount').click(function () {
                console.log("yes");
                var productID = $(this).data('product-id');
                var formData = {
                    'discount': $(this).closest('tr').find('input[name="discount"]').val(),
                    'start_discount': $(this).closest('tr').find('input[name="start_discount"]').val(),
                    'end_discount': $(this).closest('tr').find('input[name="end_discount"]').val(),
                    'product_id': productID,
                    '_token': '{{ csrf_token() }}'
                };
                console.log(formData);
                $.ajax({
                type: 'POST',
                url: '{{ route("discount.store") }}',
                data: formData,
                success: function (response) {
                    // Handle sukses di sini
                    // Misalnya, Anda dapat menampilkan pesan sukses atau melakukan aksi lain
                },
                error: function (xhr, status, error) {
                    // Handle kesalahan di sini
                    // Misalnya, Anda dapat menampilkan pesan kesalahan atau melakukan aksi lain
                }
                });
            });
        });
    </script>

    
@endsection