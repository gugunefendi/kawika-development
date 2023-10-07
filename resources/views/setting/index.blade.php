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
        <h1 class="h2">Setting</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($setting)
        <div class="card" style="width: 100%;">
            <div class="card-body">
            <h5 class="card-title">{{ $setting->alamat }}</h5>
            <p class="card-text">{{ $setting->city->city_name }}, {{ $setting->city->province->province }}</p>
            <a href="{{ route('setting.edit', $setting->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    @else
        <a href="{{ route('setting.create') }}" class="btn btn-primary my-3">Tambah Kategori</a>
    @endif
    
</main>

@endsection

{{-- @section('datatable-js')
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
@endsection --}}
