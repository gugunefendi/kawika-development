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
        <div class="card">
            <form action="{{ url('/ongkir') }}" method="get">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Kirim dari</h6>
                                <select name="province_from" class="form-control">
    <option value="" holder>Pilih provinsi</option>
    @foreach($provinceFromAPI as $provinceId => $provinceName)
        <option value="{{ $provinceId }}">{{ $provinceName }}</option>
    @endforeach
</select>

                                <!-- <select name="province_from" class="form-control">
                                    <option value="" holder>Pilih provinsi</option>
                                    @foreach($province as $result)
                                    <option value="{{ $result->id }}">{{ $result->province }}</option>
                                    @endforeach
                                </select> -->
                            </div>
                            <div class="form-group mb-3">
                            <select name="origin" class="form-control">
    <option value="" holder>Pilih kota</option>
</select>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Kirim ke</h6>
                                <select name="province_to" class="form-control">
                                    <option value="" holder>Pilih provinsi</option>
                                    @foreach($province as $result)
                                    <option value="{{ $result->id }}">{{ $result->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <select name="destination" class="form-control">
                                    <option value="" holder>Pilih kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Berat paket</h6>
                                <input type="text" name="weight" class="form-control">
                                <small>Dalam gram, contoh = 1700 / 1.7Kg</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <h6>Pilih kurir</h6>
                                <select name="courier" class="form-control">
                                    <option value="" holder>Pilih kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Hitung Ongkir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if($ongkir)
            <div class="row">
                <div class="col">
                    <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Estimasi</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ongkir as $result)
                            <tr>
                                <td>
                                    {{ $result['service'] }}
                                </td>
                                <td>
                                    {{ $result['description'] }}
                                </td>
                                <td>
                                    {{ $result['cost'][0]['value'] }}
                                </td>
                                <td>
                                    {{ $result['cost'][0]['etd'] }}
                                </td>
                                <td>
                                    {{ $result['cost'][0]['note'] }}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @else
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo, iste inventore voluptates cumque
                        doloribus, nisi cupiditate itaque modi eos, quae porro neque ex accusantium deserunt dolorum
                        sequi similique libero at.</p>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
    $('select[name="province_from"]').on('change', function () {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/getCity/ajax/' + provinceId, // Perbarui URL endpoint di sini
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="origin"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="origin"]').append(
                            '<option value="' + key + '">' + value + '</option>'
                        );
                    });
                }
            });
        } else {
            $('select[name="origin"]').empty();
        }
    });
});

$(document).ready(function () {
    $('select[name="province_to"]').on('change', function () {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/getCity/ajax/' + provinceId, // Perbarui URL endpoint di sini
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="destination"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="destination"]').append(
                            '<option value="' + key + '">' + value + '</option>'
                        );
                    });
                }
            });
        } else {
            $('select[name="destination"]').empty();
        }
    });
});


    $(document).ready(function () {
        $('select[name="province_from"]').on('change', function () {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: '/getCity/ajax/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('select[name="origin"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="origin"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="origin"]').empty();
            }
        });
    });


    </script>
</body>

</html>
