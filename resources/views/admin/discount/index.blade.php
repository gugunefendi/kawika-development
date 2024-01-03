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
        <h1 class="h2">Diskon</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('discount.create') }}" class="btn btn-primary btn-sm my-3"><i class="las la-plus-circle"></i> Tambah Diskon</a>
    <div class="table-responsive">
        <table id="categoryTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Harga Setelah Diskon</th>
                    <th scope="col">Tggl Mulai</th>
                    <th scope="col">Tggl Berkahir</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productHasDiscounts as $key => $productDiscount)
                    <tr>
                        <td class="text-end">{{ $key + 1 }}</td>
                        <td>
                            @if($productDiscount->images && $productDiscount->images->count() > 0)
                                <img src="{{ asset($productDiscount->images->first()->path) }}" alt="{{ $productDiscount->images->first()->nama_file }}" width="50">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $productDiscount->product_name }}</td>
                        <td>Rp{{ number_format($productDiscount->product_price, 0, ',', '.') }}</td>
                        <td>{{ $productDiscount->discounts->discount }}%</td>
                        <td>Rp{{ number_format(($productDiscount->product_price * $productDiscount->discounts->discount / 100), 0, ',', '.') }}</td>
                        <td>{{ $productDiscount->discounts->start_discount }}</td>
                        <td>{{ $productDiscount->discounts->end_discount }}</td>
                        <td>
                            <a href="{{ route('discount.edit', $productDiscount->id) }}" class="btn btn-warning btn-sm"><i class="las la-pen"></i> </a>
                            <a href="" class="btn btn-secondary btn-sm" onclick="return confirm('Jika kamu menghapus kategori, maka produk pada kategori tersebut akan terhapus juga. Apakah kamu yakin ingin menghapus kategori ini?')"><i class="las la-trash"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
                
        </table>
    </div>
</main>
<style>
    td {
        vertical-align: middle; /* Mengatur elemen di tengah secara vertikal */
    }
</style>
@endsection

@section('datatable-js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
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
                },
                "columnDefs": [
                    { "searchable": false, "orderable": false, "targets": 0 }
                ],
                "order": [[ 1, 'asc' ]]
            }).on('order.dt search.dt', function () {
                $('#categoryTable').DataTable().column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
@endsection
