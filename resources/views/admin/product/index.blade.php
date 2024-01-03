@extends('admin.layouts.app')

@section('datatable-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('icon')
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
@endsection

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Produk</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="" class="btn btn-sm btn-outline-secondary">Dashboard</a>
                <a href="" class="btn btn-sm btn-outline-secondary">Produk</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm my-3"><i class="las la-plus-circle"></i> Tambah Produk</a>
    <div class="table-responsive">
        <table id="productTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td class="text-end">{{ $key+1 }} </td>
                        <td>
                            @if($product->images->count() > 0)
                                <img src="{{ asset($product->images->first()->path) }}" alt="{{ $product->images->first()->nama_file }}" width="50">
                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category ? $product->category->category_name : '-' }}</td>
                        <td>Rp{{ number_format($product->product_price, 0, ',', '.') }}</td>
                        <td>{{ $product->product_stock }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="las la-pen"></i> Ubah</a>
                            <a href="{{ route('product.destroy', $product->id) }}" class="btn btn-secondary btn-sm" onclick="return confirm('Apakah kamu yakin ingin menghapus produk ini?')"><i class="las la-trash"></i> Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection

@section('datatable-js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(disaring dari total _MAX_ data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 3000) //hilangkan session dalam 3 detik
    </script>
<style>
    td {
        vertical-align: middle; /* Mengatur elemen di tengah secara vertikal */
    }
</style>
@endsection
