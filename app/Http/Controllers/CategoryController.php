<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $request->validate([
            'categoryName' => 'required',
        ]);
        $category = new Category();
        $category->category_name = $request->categoryName;
        $category->save();

        return redirect()->route('category.list')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'categoryName' => 'required',
        ]);
        $category = Category::find($id);
        $category->category_name = $request->categoryName;
        $category->save();

        return redirect()->route('category.list')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id) {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.list')->with('success', 'Kategori berhasil dihapus');
    }
}
