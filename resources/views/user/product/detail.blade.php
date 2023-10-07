@extends('user.master')

@section('content')
<div class="container mt-5 mb-3">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset($product->images[0]->path)}}" alt="Gambar Produk" class="img-fluid mb-3"
                        id="mainImage">
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach ($product->images as $image)
                        <div class="col-4">
                            <img src="{{ asset($image->path)}}" alt="Gambar Produk" class="img-fluid mb-3"
                                onclick="changeImage('{{ asset($image->path)}}')">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>{{ $product->product_name }}</h2>
            <p>Harga: {{ $product->product_price }}</p>
            <p>Stok: {{ $product->product_stock }}</p>
            <p class="justify-center">{{ $product->product_description }}</p>

            <form action="{{ route('checkout', $product->id) }}" method="get">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                <input type="hidden" name="product_price" value="{{ $product->product_price }}">
                <input type="hidden" name="selected_size" id="selected_size" value="">
                <input type="hidden" name="selected_color" id="selected_color" value="">
                <input type="hidden" name="selected_quantity" id="selected_quantity" value="">

                @if ($product->variants->count() > 0)
                <div class="form-group mb-3">
                    <label for="size">Ukuran:</label>
                    <select class="form-control" id="size" name="size" required>
                        <option value="">Pilih ukuran</option>
                        @php
                        $uniqueSizes = [];
                        @endphp
                        @foreach ($product->variants as $variant)
                        @foreach ($variant->sizes as $size)
                        @php
                        if (!in_array($size, $uniqueSizes)) {
                        $uniqueSizes[] = $size;
                        }
                        @endphp
                        @endforeach
                        @endforeach
                        @foreach ($uniqueSizes as $size)
                        <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="color">Warna:</label>
                    <select class="form-control" id="color" name="color" required>
                        <option value="">Pilih warna</option>
                        @php
                        $uniqueColors = [];
                        @endphp
                        @foreach ($product->variants as $variant)
                        @foreach ($variant->colors as $color)
                        @php
                        if (!in_array($color, $uniqueColors)) {
                        $uniqueColors[] = $color;
                        }
                        @endphp
                        @endforeach
                        @endforeach
                        @foreach ($uniqueColors as $color)
                        <option value="{{ $color }}">{{ $color }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="form-group mb-3" style="max-width: 150px;">
                    <label for="quantity">Jumlah:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-secondary" id="minusButton">-</button>
                        </div>
                        <input class="form-control text-center" id="quantity" name="quantity" min="1" value="1"
                            required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary" id="plusButton">+</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Beli</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('minusButton').addEventListener('click', function () {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);

        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    document.getElementById('plusButton').addEventListener('click', function () {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);

        quantityInput.value = currentValue + 1;
    });

    function changeImage(imagePath) {
        document.getElementById('mainImage').src = imagePath;
    }

    function selectVariant(value) {
    var selectedSize = document.getElementById('size').value;
    var selectedColor = document.getElementById('color').value;
    var selectedQuantity = document.getElementById('quantity').value;

    document.getElementById('selected_size').value = selectedSize;
    document.getElementById('selected_color').value = selectedColor;
    document.getElementById('selected_quantity').value = selectedQuantity;

    console.log('Varian yang dipilih:', value);
}


</script>


@endsection
