<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAWIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html,
        body {
            font-family: 'Open Sans', sans-serif;
            font-style: normal;
        }

        .product-card {
  padding: 0;
  position: relative;
  overflow: hidden;
}

.product-card .product-img {
  position: relative;
}

.product-card img {
  width: 100%;
  height: auto;
  transition: transform 0.02s ease-out;
}

.product-card:hover img {
  transform: scale(1);
}

.product-card .hover-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: auto;
  opacity: 0;
  transition: opacity 0.02s ease-in-out;
  z-index: 2;
}

.product-card:hover .hover-image {
  opacity: 1;
}




        .product-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
        }

        .product-img {
            text-align: center;
            padding: 20px;
        }

        .product-img img {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
        }

        .product-details {
            padding: 20px;
        }

        .product-details h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-details p {
            margin-bottom: 10px;
        }

        .product-details .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .form-control.form-beli {
            background: #eeeeee;
        }

        @media (max-width: 768px) {
            .product-wrapper {
                display: grid;
                grid-template-columns: 1fr;
            }

            .product-img,
            .product-details {
                padding: 10px;
            }
        }

    </style>
</head>

<body>

    <section class="myNav">
        @include('user.components.navbar')
    </section>

    <section class="myContent">
        @yield('content')
    </section>

    <section class="myFooter bg-light py-5">
        <div class="row">
            <div class="col px-5">
                <h2>Kategori</h2>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Terbaru</a></li>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Terlaris</a></li>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Termurah</a></li>
            </div>
            <div class="col px-5">
                <h2>Blog</h2>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Cara merawat baju</a></li>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Tips untuk kamu</a></li>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Celana termahal di dunia</a>
                </li>
            </div>
            <div class="col px-5">
                <h2>Sosial Media</h2>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Instagram</a></li>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Facebook</a></li>
                <li style="list-style-type:none;"><a href="" style="text-decoration:none">Youtube</a></li>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
