<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body>
    <div style="max-width: 800px; margin: 0 auto;">

        <main style="padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #ccc;">
                <h1 style="font-size: 24px; font-weight: bold;">Invoice HbV123n5I78</h1>
                <p>Toko: KawiKa</p>
                <p>Alamat: Jl Braga, No 7, Kota Bandung.</p>
            </div>

            @if($details !== null)
            <div style="display: flex;">
                <div style="flex: 1;">
                    <h3>Data Produk</h3>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th style="text-align: left;">ID</th>
                                <td style="text-align: left; vertical-align: middle;">{{ $details->id }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Tanggal</th>
                                <td style="text-align: left;">{{ $details->created_at }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Invoice</th>
                                <td style="text-align: left;">abc12345678</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Produk</th>
                                <td style="text-align: left;">{{ $details->order->product->product_name }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Berat (gram)</th>
                                <td style="text-align: left;">{{ $details->product_weight }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Harga Produk</th>
                                <td style="text-align: left;">Rp{{ number_format($details->product_price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Kuantiti</th>
                                <td style="text-align: left;">{{ $details->quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="flex: 1;">
                    <h3>Data Pembeli</h3>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th style="text-align: left;">Pembeli</th>
                                <td style="text-align: left; vertical-align: middle;">{{ $details->order->buyer }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Alamat</th>
                                <td style="text-align: left;">{{ $details->address }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Kota</th>
                                <td style="text-align: left;">{{ $details->city->city_name }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Kurir</th>
                                <td style="text-align: left;">{{ strtoupper($details->courier) }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Ongkir</th>
                                <td style="text-align: left;">Rp{{ number_format($details->ongkir, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Total</th>
                                <td style="text-align: left;">Rp{{ number_format($details->order->total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Kategori</th>
                                <td style="text-align: left;">{{ $details->order->product->category->category_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 20px; border-bottom: 1px solid #ccc;">
                </div>
                <p>Trimakasih sudah berbelanja di KawiKa</p>
            </div>
            @else
            <p>Data tidak ditemukan</p>
            @endif
        </main>
    </div>
</body>

</html>
