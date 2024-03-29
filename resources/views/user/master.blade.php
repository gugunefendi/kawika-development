<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAWIKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            font-family: 'Poppins', sans-serif;
            font-style: normal;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-weight: 600;
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

        .wame {
            position: relative;
        }

        .contact-wa {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: red;
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Kategori</h2>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Terbaru</a></li>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Terlaris</a></li>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Termurah</a></li>
                </div>
                <div class="col">
                    <h2>Blog</h2>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Cara merawat baju</a></li>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Tips untuk kamu</a></li>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Celana termahal di dunia</a>
                    </li>
                </div>
                <div class="col">
                    <h2>Sosial Media</h2>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Instagram</a></li>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Facebook</a></li>
                    <li style="list-style-type:none;"><a href="" class="text-secondary"
                            style="text-decoration:none">Youtube</a></li>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center bg-dark text-light py-3">
        Copyright 2024 Kawika
    </section>

    <section class="wame">
        <div class="contact-wa">
            <a href="">
                <img width="80" height="80"
                    src="data:image/jpeg;base64,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"
                    alt="">
            </a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
