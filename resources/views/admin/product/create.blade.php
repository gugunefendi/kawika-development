@extends('admin.layouts.app')

@section('icon')
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
@endsection

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Tambah Produk</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="" class="btn btn-sm btn-outline-secondary">Dashboard</a>
                <a href="" class="btn btn-sm btn-outline-secondary">Produk</a>
                <a href="" class="btn btn-sm btn-outline-secondary">Tambah</a>
            </div>
        </div>
    </div>

    <!-- <h2>Section title</h2> -->
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productImage" class="col-form-label">Gambar: </label>
            </div>
            <div class="col-10">
                <input type="file" id="productImage" name="images[]" class="form-control" multiple>
                @if ($errors->has('image'))
                <div class="text-danger">{{ $errors->first('image') }}</div>
                @endif
                
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-2">
            </div>
            <div class="col-10">
            <div id="imagePreviewContainer" class="row">
                </div>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-2">
                <label class="col-form-label">Nama Produk: </label>
            </div>
            <div class="col-10">
                <input type="text" name="productName" id="productName" value="{{ old('productName') }}"
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
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}</option>
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
            <div class="row">
                <div class="col-5">
                    <input type="text" name="sizes[]" placeholder="Ukuran" class="form-control mb-2">
                </div>
                <div class="col-5">
                    <input type="text" name="colors[]" placeholder="Warna" class="form-control mb-2">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger btn-remove-variant mb-2">Hapus</button>
                </div>
            </div>
        </div>
        <button type="button" id="btn-add-variant" class="btn btn-primary mt-2"><i class="las la-plus"></i> Tambah Varian</button>
    </div>
</div>

        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="productDescription" class="col-form-label">Deskripsi: </label>
            </div>
            <div class="col-10">
                <textarea name="productDescription" id="description" cols="30" rows="5"
                    class="form-control">{{ old('productDescription') }}</textarea>
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
                <input type="text" name="productPrice" id="productPrice" value="{{ old('productPrice') }}"
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
                <input type="text" value="{{ old('productWeight') }}" name="productWeight" id="productWeight"
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
                <input type="text" value="{{ old('productStock') }}" name="productStock" id="productStock"
                    class="form-control">
                @error('productStock')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-2">
            </div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary"><i class="lar la-save"></i> Simpan</button>
            </div>
        </div>

    </form>
</main>

<script>
    // Image review
    document.getElementById('productImage').addEventListener('change', function (event) {
        var imagePreviewContainer = document.getElementById('imagePreviewContainer');
        imagePreviewContainer.innerHTML = '';

        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
                var imageElement = document.createElement('img');
                imageElement.src = e.target.result;
                imageElement.alt = file.name;
                imageElement.width = 100;

                var imagePreview = document.createElement('div');
                imagePreview.classList.add('col-4', 'mb-3');
                imagePreview.appendChild(imageElement);

                imagePreviewContainer.appendChild(imagePreview);
            }

            reader.readAsDataURL(file);
        }
    });

    // Varian produk
    document.getElementById('btn-add-variant').addEventListener('click', function () {
        var variantContainer = document.getElementById('variantContainer');

        var variantRow = document.createElement('div');
        variantRow.classList.add('row');

        var sizeCol = document.createElement('div');
        sizeCol.classList.add('col-5');
        var sizeInput = document.createElement('input');
        sizeInput.type = 'text';
        sizeInput.name = 'sizes[]';
        sizeInput.placeholder = 'Ukuran';
        sizeInput.classList.add('form-control', 'mb-2');
        sizeCol.appendChild(sizeInput);
        variantRow.appendChild(sizeCol);

        var colorCol = document.createElement('div');
        colorCol.classList.add('col-5');
        var colorInput = document.createElement('input');
        colorInput.type = 'text';
        colorInput.name = 'colors[]';
        colorInput.placeholder = 'Warna';
        colorInput.classList.add('form-control', 'mb-2');
        colorCol.appendChild(colorInput);
        variantRow.appendChild(colorCol);

        var deleteCol = document.createElement('div');
        deleteCol.classList.add('col-2');
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.classList.add('btn', 'btn-danger', 'btn-remove-variant', 'mb-2');
        deleteButton.textContent = 'Hapus';
        deleteCol.appendChild(deleteButton);
        variantRow.appendChild(deleteCol);

        variantContainer.appendChild(variantRow);
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-remove-variant')) {
            var variantRow = event.target.closest('.row');
            variantRow.remove();
        }
    });
</script>
@endsection
