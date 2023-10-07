@extends('user.master')
@section('content')
<div class="container p-5">
    <form action="{{ route('thanks.page') }}" method="get" target="_blank">
        @csrf
        <div class="row mb-3 gx-5">
            <div class="col col-6 p-4">
                <div class="row mb-3">
                    <h3>Data Penerima</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control form-beli" name="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Telepon / WhatsApp</label>
                            <input type="text" class="form-control form-beli" name="telp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="jl" id="" cols="30" rows="5" class="form-control form-beli"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control form-beli" name="kecamatan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" class="form-control form-beli" name="kota">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <input type="text" class="form-control form-beli" name="provinsi">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Kurir Pengiriman</label>
                            <select name="kurir" id="" class="form-control form-beli">
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col col-6 p-4">
                <div class="mb-3">
                    <h3>Detail Pesanan</h3>
                </div>
                <div class="mb-3">
                    <img src="{{ asset('/storage/product/'.$product->product_image) }}" alt="" style="width:180px">
                </div>
                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <input type="text" class="form-control form-beli" value="{{ $product->product_name }}" name="product" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" class="form-control form-beli" value="Hitam" name="varian" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="text" class="form-control form-beli" value="1" name="qty">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Satuan</label>
                    <input type="text" class="form-control form-beli" value="{{ $product->product_price }}" name="price" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ongkos Kirim</label>
                    <input type="text" class="form-control form-beli" value="8000" name="ongkir" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control form-beli" value="{{ $product->product_price }}" readonly>

                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Bayar sekarang</button>
                </div>
            </div>
        </div>

</div>



</form>
</div>


<!-- <div class="container-sm py-5">

    <form action="{{ route('chat') }}" method="get" target="_blank">
        @csrf

        <div class="card card-body px-4 py-4">

            <h5 class="mb-4">Detail produk</h5>
            <div class="row">
                <div class="col-3">
                    <img src="{{ asset('/storage/product/'.$product->product_image) }}" class="img-fluid rounded-start"
                        alt="..." width="150">
                </div>
                <div class="col-9">
                    <div class="row" style="margin:0px; padding:0px">
                        <div class="col-4" style="margin:0px; padding:0px">
                            <label class="col-form-label">Nama Produk</label>
                        </div>
                        <div class="col-8" style="margin:0px; padding:0px">
                            <input type="text" value="{{ $product->product_name }}" name="product"
                                class="form-control border-0">
                        </div>
                    </div>
                    <div class="row" style="margin:0px; padding:0px">
                        <div class="col-4" style="margin:0px; padding:0px">
                            <label class="col-form-label">Warna</label>
                        </div>
                        <div class="col-8" style="margin:0px; padding:0px">
                            <input type="text" value="Hitam" name="varian" class="form-control border-0">
                        </div>
                    </div>
                    <div class="row" style="margin:0px; padding:0px">
                        <div class="col-4" style="margin:0px; padding:0px">
                            <label class="col-form-label">Jumlah</label>
                        </div>
                        <div class="col-8" style="margin:0px; padding:0px">
                            <input type="text" value="1" name="qty" class="form-control border-0">
                        </div>
                    </div>
                    <div class="row" style="margin:0px; padding:0px">
                        <div class="col-4" style="margin:0px; padding:0px">
                            <label class="col-form-label">Harga</label>
                        </div>
                        <div class="col-8" style="margin:0px; padding:0px">
                            <input type="text" value="{{ $product->product_price }}" name="price"
                                class="form-control border-0">
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mb-4">Data penerima</h5>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-2">
                    <label for="nama" class="col-form-label">Nama: </label>
                </div>
                <div class="col-10">
                    <input type="text" name="nama" class="form-control">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-2">
                    <label for="telp" class="col-form-label">No Telp / WhatsApp: </label>
                </div>
                <div class="col-10">
                    <input type="text" name="telp" class="form-control">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-2">
                    <label for="jl" class="col-form-label">Nama Jl / Gedung: </label>
                </div>
                <div class="col-10">
                    <input type="text" name="jl" class="form-control">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-2">
                    <label for="kecamatan" class="col-form-label">Kecamatan: </label>
                </div>
                <div class="col-10">
                    <input type="text" name="kecamatan" class="form-control">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-2">
                    <label for="kota" class="col-form-label">Kota: </label>
                </div>
                <div class="col-10">
                    <input type="text" name="kota" class="form-control">
                </div>
            </div>
            <div class="row g-3 align-items-center mb-3">
                <div class="col-2">
                    <label for="provinsi" class="col-form-label">Provinsi: </label>
                </div>
                <div class="col-10">
                    <input type="text" name="provinsi" class="form-control">
                </div>
            </div>

            <h5 class="mb-4">Metode pembayaran</h5>
            <div class="row g-3 align-items-center mb-3">
                <div class="col">
                    <a href="">
                        <img src="{{ asset('images/cod.jpg') }}" alt="COD" width="100" height="70" class="border">
                    </a>
                    <a href="">
                        <img src="{{ asset('images/transfer.png') }}" alt="COD" width="100" height="70" class="border">
                    </a>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary">Bayar sekarang</button>
            </div>
        </div>
    </form>

</div> -->
@endsection
