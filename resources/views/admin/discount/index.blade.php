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
        <h1 class="h2">Discount</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm my-3"><i class="las la-plus-circle"></i> Tambah Discount</a>
    <div class="table-responsive">
        <table id="categoryTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Produk</th> 
                    <th scope="col">Discount</th>
                    <th scope="col">Tggl Mulai</th>
                    <th scope="col">Tggl Berkahir</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($discounts as $key => $discount)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img src="{{ asset($discount->images->first()->path) }}" alt="{{ $discount->images->first()->nama_file }}" width="100"></td>
                        <td>{{ $discount->products->product_name }}</td>
                        <td>{{ $discount->discount }}</td>
                        <td>28 September 2023</td>
                        <td>1 November 2023</td>
                        <td>
                            <a href="{{ route('product.edit', $discount->id)}}" class="btn btn-warning btn-sm"><i class="las la-pen"></i> Ubah</a>
                            <a href="{{ route('product.destroy', $discount->id)}}" class="btn btn-secondary btn-sm" onclick="return confirm('Jika kamu menghapus kategori, maka produk pada kategori tersebut akan terhapus juga. Apakah kamu yakin ingin menghapus kategori ini?')"><i class="las la-trash"></i> Hapus</a>
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
