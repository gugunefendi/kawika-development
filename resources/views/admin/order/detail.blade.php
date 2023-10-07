@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pesanan</h1>
    </div>

    @if($details !== null)
    <div class="row">
        <div class="col-md-6">
            <h3>Data Produk</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $details->id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $details->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Invoice</th>
                        <td>abc12345678</td>
                    </tr>
                    <tr>
                        <th>Produk</th>
                        <td>{{ $details->order->product->product_name }}</td>
                    </tr>
                    <tr>
                        <th>Berat (gram)</th>
                        <td>{{ $details->product_weight }}</td>
                    </tr>
                    <tr>
                        <th>Harga Produk</th>
                        <td>Rp{{ number_format($details->product_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Kuantiti</th>
                        <td>{{ $details->quantity }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Data Pembeli</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $details->order->buyer }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $details->address }}</td>
                    </tr>
                    <tr>
                        <th>Kota</th>
                        <td>{{ $details->city->city_name }}</td>
                    </tr>
                    <tr>
                        <th>Kurir</th>
                        <td>{{ strtoupper($details->courier) }}</td>
                    </tr>
                    <tr>
                        <th>Ongkir</th>
                        <td>Rp{{ number_format($details->ongkir, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rp{{ number_format($details->order->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $details->order->product->category->category_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ url('/invoice/'.$details->id.'/print') }}" class="btn btn-primary">Cetak</a>
    </div>
    @else
    <p>Data tidak ditemukan</p>
    @endif
</main>

@endsection
