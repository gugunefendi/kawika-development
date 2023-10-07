@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Kategori</h1>
    </div>

    <!-- <h2>Section title</h2> -->
    <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="row g-3 align-items-center mb-3">
            <div class="col-2">
                <label for="productName" class="col-form-label">Kategori: </label>
            </div>
            <div class="col-10">
                <input type="text" name="categoryName" id="productName" class="form-control">
                @error('categoryName')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row g-3 align-items-center mb-3">
            <div class="col-2">
            </div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        
    </form>
</main>

@endsection
