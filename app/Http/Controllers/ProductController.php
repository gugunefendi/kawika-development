<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;
use App\Models\Category;
use App\Models\Images;
use App\Models\Variant;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category','images')->latest()->get();
        return view('admin.product.index',  ['products' => $products]);
    }

    public function create() {
        $categories = Category::all();

        return view('admin.product.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'productName' => 'required',
            'productDescription' => 'required',
            'productPrice' => 'numeric|required|min:5000|max:5000000',
            'productStock' => 'numeric|required|min:1',
            'productWeight' => ['numeric','required','regex:/^\d+(\.\d{1,3})?$/'],
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'array',
            'colors' => 'array',
        ]);

        // Simpan data produk ke dalam tabel produk
        $product = new Product();
        $product->category_id = $request->category;
        $product->product_name = $request->productName;
        $product->product_description = $request->productDescription;
        $product->product_price = $request->productPrice;
        $product->product_stock = $request->productStock;
        $product->product_weight = $request->productWeight;
        $product->save();

        // Simpan gambar-gambar ke dalam tabel images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = $file->getClientOriginalName();
                            $filePath = $file->store('public/product');
                            $filePath = Storage::url($filePath);
                    
                            $image = new Images();
                            $image->nama_file = $fileName;
                            $image->path = $filePath;
                            $image->product_id = $product->id;
                            $image->save();
            }
        }

        // Simpan varian ke dalam tabel variants
        if ($request->has('sizes') && $request->has('colors')) {
            $sizes = $request->sizes;
            $colors = $request->colors;

            foreach ($sizes as $index => $size) {
                $variant = new Variant();
                $variant->product_id = $product->id;
                $variant->sizes = [$size];
                $variant->colors = [$colors[$index]];
                $variant->save();
            }
        }

        return redirect()->route('product.list')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Request $request, $id) {
        $product = Product::with('variants')->find($id);
        $categories = Category::all();
        
        return view('admin.product.edit', compact('product', 'categories'));   
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'category' => 'required',
        'productName' => 'required',
        'productDescription' => 'required',
        'productPrice' => 'numeric|required|min:5000|max:5000000',
        'productStock' => 'numeric|required|min:1',
        'productWeight' => ['numeric','required','regex:/^\d+(\.\d{1,3})?$/'],
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'sizes' => 'array',
        'colors' => 'array',
    ]);

    // Update data produk pada tabel produk
    $product = Product::findOrFail($id);
    $product->category_id = $request->category;
    $product->product_name = $request->productName;
    $product->product_description = $request->productDescription;
    $product->product_price = $request->productPrice;
    $product->product_stock = $request->productStock;
    $product->product_weight = $request->productWeight;
    $product->save();

    // Hapus gambar-gambar lama jika ada file gambar baru yang diunggah
    if ($request->hasFile('images')) {
        // Hapus gambar-gambar lama
        foreach ($product->images as $image) {
            $filePath = str_replace('/storage', 'public', $image->path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
        }
        $image->delete();
        }

        // Hapus gambar-gambar dari tabel images
        $product->images()->delete();

        // Tambahkan gambar-gambar baru
        foreach ($request->file('images') as $file) {
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('public/product');
            $filePath = Storage::url($filePath);

            $image = new Images();
            $image->nama_file = $fileName;
            $image->path = $filePath;
            $image->product_id = $product->id;
            $image->save();
        }
    }

    // Hapus gambar-gambar yang dihapus pada form edit
    if ($request->has('deleted_images')) {
        $deletedImages = $request->input('deleted_images');

        // Hapus gambar-gambar dari tabel images
        Images::whereIn('id', $deletedImages)->delete();

        // Hapus file-file gambar yang terkait dengan gambar yang dihapus
        $deletedImagePaths = Images::whereIn('id', $deletedImages)->pluck('path')->toArray();
        Storage::delete($deletedImagePaths);
    }

    // Update varian pada tabel variants jika sizes dan colors ada
    if ($request->has('sizes') && $request->has('colors')) {
        $sizes = $request->sizes;
        $colors = $request->colors;

        Variant::where('product_id', $product->id)->delete();

        foreach ($sizes as $index => $size) {
            $variant = new Variant();
            $variant->product_id = $product->id;
            $variant->sizes = [$size];
            $variant->colors = [$colors[$index]];
            $variant->save();
        }
    } 
    // Set varian menjadi null jika sizes dan colors tidak ada
    else {
        Variant::where('product_id', $product->id)->delete();
    }

    return redirect()->route('product.list')->with('success', 'Produk berhasil diperbarui');
}


    public function destroy($id)
    {
        $product = Product::find($id);
    
        // Hapus gambar-gambar terkait
        foreach ($product->images as $image) {
            $filePath = str_replace('/storage', 'public', $image->path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $image->delete();
        }
    
        // Hapus produk
        $product->delete();
    
        return redirect()->route('product.list')->with('success', 'Produk berhasil dihapus');
    }

    public function detail($id) {
        $product = Product::find($id);
        return view('user.product.detail', compact('product'));
    }

}
