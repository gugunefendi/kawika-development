@extends('user.master')
@section('content')
@include('user.components.intro')
<div class="container mt-5 mb-3">
    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-2">
    @foreach($products as $product)
    <div class="col mb-4">
        <div class="card product-card">
            @if($product->images->count() > 0)
                <img src="{{ asset($product->images->first()->path) }}" alt="Produk 1">
                @if($product->images->count() > 1)
                    <img class="hover-image" src="{{ asset($product->images[1]->path) }}" alt="Produk 1 Hover">
                @endif
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text">{{ $product->product_price }}</p>
                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary">Beli</a>
            </div>
        </div>
    </div>
@endforeach

    </div>
</div>
@endsection
