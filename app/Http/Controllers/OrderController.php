<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Notification;
use App\Models\Province;
use App\Models\City;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();
        
        return view('admin.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // // Validasi data yang diterima dari formulir
        // $request->validate([
        //     'product_id' => 'required',
        //     'nama' => 'required',
        //     'telepon' => 'required',
        //     'alamat' => 'required',
        //     'province' => 'required',
        //     'city_id' => 'required',
        //     'weight' => 'required',
        //     'courier' => 'required',
        //     'package' => 'required'
        // ]);

        // Simpan data order
        $order = new Order;
        $order->product_id = $request->product_id;
        $order->buyer = $request->buyer;
        $order->no_phone = $request->no_phone;
        $total = $request->selected_quantity * $request->productPrice + $request->input('shipping_cost');
        $order->total = $total;
        $order->status = 'pending';
        $order->notes = $request->notes;
        $order->save();

        // Simpan data order detail
        $orderDetail = new OrderDetail;
        $orderDetail->order_id = $order->id;
        $orderDetail->product_size = $request->selected_size;
        $orderDetail->product_color = $request->selected_color;
        $orderDetail->product_weight = $request->weight;
        $orderDetail->product_category = $request->productCategory;
        $orderDetail->quantity = $request->selected_quantity;
        $orderDetail->product_price = $request->productPrice;
        $orderDetail->address = $request->address;
        $orderDetail->city_id = $request->city_id;
        $orderDetail->ongkir = $request->input('shipping_cost');
        $orderDetail->province_id = $request->province;
        $orderDetail->courier = $request->courier;
        $orderDetail->save();

        Notification::create([
            'user_id' => 1,
            'message' => 'Order baru telah dibuat. <a href="/admin/order/'. $order->id.'" class="">Detail</a>',
            'read' => false, // Notifikasi ini belum dibaca
        ]);

        return redirect()->route('landing');
    }

    public function checkout(Request $request, $id) {
        $product = Product::find($id);
        $provinces = Province::all();
        $cities = City::all();
        $selected_size = $request->input('size');
        $selected_color = $request->input('color');
        $selected_quantity = $request->input('quantity');
        return view('front.checkout.create2', compact('product','provinces','cities','selected_size', 'selected_color', 'selected_quantity'));
    }

    public function chat(Request $request) {
        $product = $request->product;
        $varian = $request->varian;
        $qty = $request->qty;
        $price = $request->price;
        $subtotal = $request->price;
        $kurir = $request->kurir;
        $ongkir = $request->ongkir;
        $total = $price + $ongkir;
        $nama = $request->nama;
        $telp = $request->telp;
        $jl = $request->jl;
        $kecamatan = $request->kecamatan;
        $kota = $request->kota;
        $provinsi = $request->provinsi;

        return redirect("https://api.whatsapp.com/send?phone=6285773388427/&text=Hallo%20Ka,%20Saya%20mau%20beli%0D%0AProduk:%20$product%0D%0AVarian:%20$varian%0D%0AJumlah:%20$qty%0D%0AHarga%20Satuan:%20Rp%20$price%0D%0ASubtotal:%20Rp%20$subtotal%0D%0AKurir:%20$kurir%0D%0AOngkos%20Kirim:%20Rp%20$ongkir%0D%0ATotal:%20Rp%20$total%0D%0A-------------------------%0D%0ANama:%20$nama%0D%0ANo%20Telp:%20$telp%0D%0AJl:%20$jl%0D%0AKecamatan:%20$kecamatan%0D%0AKota:%20$kota%0D%0AProvinsi:%20$provinsi");
    }

    public function thanks(Request $request) {
        $order = new Order;
        $order->invoice = "123456xxx";
        $order->product = $request->product;
        $order->weight = "500 gram";
        $order->qty = $request->qty;
        $order->price = $request->price;
        $order->total = "xxx";
        $order->shipping = $request->kurir;
        $order->shipping_cost = 8000;
        $order->buyer = $request->nama;
        $order->address = $request->jl;
        $order->save();
        return view('front.checkout.thanks');
    }

    public function detail($id) {
        $details = OrderDetail::where('order_id', $id)->first();
        // dd($detail);
        return view('admin.order.detail', compact('details'));
    }
}
