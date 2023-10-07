@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Edit Produk</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="" class="btn btn-sm btn-outline-secondary">Dashboard</a>
                <a href="" class="btn btn-sm btn-outline-secondary">Produk</a>
                <a href="" class="btn btn-sm btn-outline-secondary">Tambah</a>
            </div>
        </div>
    </div>

    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productImage" class="col-form-label">Gambar: </label>
            </div>
            <div class="col-10">
                <input type="file" id="productImage" name="images[]" class="form-control" multiple>
                @if ($errors->has('images'))
                <div class="text-danger">{{ $errors->first('images') }}</div>
                @endif
                <div id="imagePreviewContainer" class="row mt-3">
                    @foreach($product->images as $image)
                    <div class="col-4 mb-3">
                        <img src="{{ asset($image->path) }}" alt="{{ $image->nama_file }}" width="100">
                        <input type="hidden" name="image_ids[]" value="{{ $image->id }}" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label class="col-form-label">Nama Produk: </label>
            </div>
            <div class="col-10">
                <input type="text" name="productName" id="productName" value="{{ $product->product_name }}"
                    class="form-control">
                @error('productName')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label class="col-form-label">Kategori:</label>
            </div>
            <div class="col-10">
                <select name="category" class="form-control">
                    <option value="" disabled>Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                    @endforeach
                </select>
                @error('category')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label class="col-form-label">Varian:</label>
            </div>
            <div class="col-10">
                <div id="variantContainer">
                    @foreach($product->variants as $variant)
                    @foreach($variant->sizes as $index => $size)
                    <div class="row">
                        <div class="col-5">
                            <input type="text" name="sizes[]" placeholder="Ukuran" class="form-control mb-2"
                                value="{{ $size }}">
                        </div>
                        <div class="col-5">
                            <input type="text" name="colors[]" placeholder="Warna" class="form-control mb-2"
                                value="{{ $variant->colors[$index] }}">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger btn-remove-variant mb-2">Hapus</button>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
                <button type="button" id="btn-add-variant" class="btn btn-primary mt-2">Tambah Varian</button>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productDescription" class="col-form-label">Deskripsi: </label>
            </div>
            <div class="col-10">
                <textarea name="productDescription" id="description" cols="30" rows="5"
                    class="form-control">{{ $product->product_description }}</textarea>
                @error('productDescription')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productPrice" class="col-form-label">Harga (Rp) : </label>
            </div>
            <div class="col-10">
                <input type="text" name="productPrice" id="productPrice" value="{{ $product->product_price }}"
                    class="form-control">
                @error('productPrice')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productWeight" class="col-form-label">Berat (satuan gram): </label>
            </div>
            <div class="col-10">
                <input type="text" name="productWeight" id="productWeight" value="{{ $product->product_weight }}"
                    class="form-control">
                @error('productWeight')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productStock" class="col-form-label">Stok: </label>
            </div>
            <div class="col-10">
                <input type="text" name="productStock" id="productStock" value="{{ $product->product_stock }}"
                    class="form-control">
                @error('productStock')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-2"></div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>

    </form>
</main>

<script>
    function previewImages() {
        var previewContainer = document.getElementById('imagePreviewContainer');
        var files = document.getElementById('productImage').files;
        previewContainer.innerHTML = '';

        function readAndPreview(file) {
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();

                reader.addEventListener("load", function () {
                    var imageElement = document.createElement('img');
                    imageElement.src = this.result;
                    imageElement.classList.add('col-4', 'mb-3');
                    previewContainer.appendChild(imageElement);
                });

                reader.readAsDataURL(file);
            }
        }

        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    }

    document.getElementById('productImage').addEventListener('change', previewImages);

    // varian
    document.getElementById('btn-add-variant').addEventListener('click', function () {
        var variantContainer = document.getElementById('variantContainer');
        var newVariant = document.createElement('div');
        newVariant.classList.add('row');
        newVariant.innerHTML = `
            <div class="col-5">
                <input type="text" name="sizes[]" placeholder="Ukuran" class="form-control mb-2">
            </div>
            <div class="col-5">
                <input type="text" name="colors[]" placeholder="Warna" class="form-control mb-2">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-danger btn-remove-variant mb-2">Hapus</button>
            </div>
        `;
        variantContainer.appendChild(newVariant);
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-remove-variant')) {
            var variant = event.target.closest('.row');
            variant.remove();
        }
    });

</script>
@endsection
