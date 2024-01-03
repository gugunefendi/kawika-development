<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;

use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function index() {
        $productHasDiscounts = Product::whereHas('discounts')->get();
        return view('admin.discount.index', compact('productHasDiscounts'));
    }

    public function create() {
        $productsWithoutDiscount = Product::whereDoesntHave('discounts')->get();
        return view('admin.discount.create', compact('productsWithoutDiscount'));
    }

    public function check($productId) {
        $productId = Discount::find($productId);
        if($productId) {
            return $productId;
        }
        else {
            console.log("product id tidak di temukan");
        }
    }

    public function store(Request $request) {
        print_r("woii");
        $validator = Validator::make($request->all(), [
            'discount' => 'required|integer',
            'start_discount' => 'required|date',
            'end_discount' => 'required|date',
            'product_id' => 'required|integer'
        ]);
        if($validator->fails()) {
            return redirect()->route('discount.create')->withErrors($validator)->withInput();
        }
        $discount = new Discount;
        $discount->discount = $request->discount;
        $discount->start_discount = $request->start_discount;
        $discount->end_discount = $request->end_discount;
        $discount->product_id = $request->product_id;
        $discount->save();
        return response()->json(['Data berhasil di simpan']);
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('admin.discount.edit', compact('product'));
    }

    public function update(Request $request, $product_id) {
        $ProdukId = Discount::find($product_id);
        if ($ProdukId) {
            $validator = Validator::make($request->all(), [
                'discount' => 'required|integer',
                'start_discount' => 'required|date',
                'end_discount' => 'required|date',
                'product_id' => 'required|integer'
            ]);
            if($validator->fails()) {
                return redirect()->route('discount.create')->withErrors($validator)->withInput();
            }
            $discount->discount = $request->discount;
            $discount->start_discount = $request->start_discount;
            $discount->end_discount = $request->end_discount;
            $discount->product_id = $request->product_id;
            $discount->update();
            return response()->json(['Data berhasil di ubah']);
        }
        else {
            console.log("Id Discount tidak di temukan");
        }
    }
}
