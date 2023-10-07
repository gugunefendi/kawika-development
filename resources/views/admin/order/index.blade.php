@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Invoice</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Photo Produk</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Pembeli</th>
          <th scope="col">No Telepon</th>
          <th scope="col">Kota</th>
          <th scope="col">Total</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $index => $order)
        <tr>
          <td class="align-middle">
            <img src="{{ asset($order->product->images[0]->path)}}" width="50" alt="...">
          </td>
          <td class="align-middle">{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
          <td class="align-middle">{{ $order->buyer }}</td>
          <td class="align-middle"><a href="http://wa.me/{{ $order->no_phone }}" target="_blank">{{ $order->no_phone }}</td>
          <td class="align-middle">Jakarta</td>
          <td class="align-middle">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
          <td class="align-middle">
            @if($order->status == 'paid')
            <span class="badge bg-success text-white">{{ $order->status }}</span>
            @elseif($order->status == 'pending')
            <span class="badge bg-warning text-dark p-2">{{ $order->status }}</span>
            @else
            <span class="badge bg-danger text-white">{{ $order->status }}</span>
            @endif
          </td>
          <td class="align-middle">
            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-success btn-sm">Ubah Status</a>
            <a href="{{ route('order.detail', $order->id) }}" class="btn btn-primary btn-sm">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</main>

@endsection
