<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('/storage/product/'. $product->product_image)}}"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">{{ $product->product_description }}</p>
                            <p class="card-text">{{ $product->product_price }}</p>
                            <p class="card-text">{{ $product->product_stock }}</p>
                            <a href="" class="btn btn-success">Keranjang</a>
                            <a href="{{ route('checkout', $product->id) }}" class="btn btn-primary">Beli</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
