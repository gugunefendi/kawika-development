@extends('user.master')
@section('content')
@include('user.components.intro')
<div class="container mt-5 mb-3">

    <div id="carouselExampleDark" class="carousel carousel-dark slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://www.batiqa.com/upload/news/xl/landscape-offfers-payday-payless-motorcycle-day_ihixj.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <!-- <h5>First slide label</h5> -->
                    <button class="btn btn-success btn-lg">Selengkapnya</button>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="https://imagescdn.gettyimagesbank.com/500/19/278/656/0/1161318681.jpg" class="d-block w-100"
                    alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <!-- <h5>Second slide label</h5> -->
                    <button class="btn btn-success btn-lg">Selengkapnya</button>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://www.batiqa.com/upload/news/xl/landscape-offfers-payday-payless-motorcycle-day_ihixj.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <!-- <h5>Third slide label</h5> -->
                    <button class="btn btn-success btn-lg">Selengkapnya</button>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="row text-center mb-5">
        <h2>Penjualan terlaris minggu ini</h2>
    </div>
    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-2 mb-5">
        @foreach($products as $product)
        <div class="col mb-4">
            <div class="card product-card">
                @if($product->images->count() > 0)
                <img src="{{ asset($product->images->first()->path) }}" alt="Produk 1">
                <div style="position:absolute; right:0; top:0; color: white; 
                background:green; padding: 5px; z-index:10; font-weight: bold; font-size: 36px;
                border-bottom-left-radius: 50%;">
                    50%
                </div>
                @if($product->images->count() > 1)
                <img class="hover-image" src="{{ asset($product->images[1]->path) }}" alt="Produk 1 Hover">
                @endif
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="card-text">{{ $product->product_price }}</p>
                    <div class="row">
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary">Beli</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col mb-5 text-center">
        <a href=""><span class="badge text-dark">Semua kategori</span></a>
        <a href=""><span class="badge text-dark">Baju</span></a>
        <a href=""><span class="badge text-dark">Celana</span></a>
    </div>

    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-2 mb-5">
        @foreach($products as $product)
        <div class="col mb-4">
            <div class="card product-card">
                @if($product->images->count() > 0)
                <img src="{{ asset($product->images->first()->path) }}" alt="Produk 1">
                <div style="position:absolute; right:0; top:0; color: white; 
                background:green; padding: 5px; z-index:10; font-weight: bold; font-size: 36px;
                border-bottom-left-radius: 50%;">
                    50%
                </div>
                @if($product->images->count() > 1)
                <img class="hover-image" src="{{ asset($product->images[1]->path) }}" alt="Produk 1 Hover">
                @endif
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="card-text">{{ $product->product_price }}</p>
                    <div class="row">
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary">Beli</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<style>
     a span {
        background-color: #EEEEEE;
    }
    a span:hover {
        background-color: blue;
    }
</style>
@endsection
