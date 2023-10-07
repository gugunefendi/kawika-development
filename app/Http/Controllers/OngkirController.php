<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\Setting;
use App\Models\City;

class OngkirController extends Controller
    {
        // public function index(Request $request)
        // {
        //     $responseProvince = Http::get('https://api.rajaongkir.com/starter/province', [
        //         'key' => env('RAJAONGKIR_API_KEY'),
        //     ]);

        //     $provinces = $responseProvince['rajaongkir']['results'];
        //     $province = Province::all();
        //     $provinceFromAPI = collect($provinces)->pluck('province', 'province_id');

        //     $ongkir = null; // Inisialisasi variabel $ongkir

        //     if ($request->origin && $request->destination && $request->weight && $request->courier) {
        //         $origin = $request->origin;
        //         $destination = $request->destination;
        //         $weight = $request->weight;
        //         $courier = $request->courier;

        //         $response = Http::asForm()->withHeaders([
        //             'key' => env('RAJAONGKIR_API_KEY'),
        //         ])->post('https://api.rajaongkir.com/starter/cost', [
        //             'origin' => $origin,
        //             'destination' => $destination,
        //             'weight' => $weight,
        //             'courier' => $courier,
        //         ]);

        //         $ongkir = $response['rajaongkir']['results'][0]['costs'];
        //     }

        //     return view('front.checkout.ongkir', compact('province', 'provinceFromAPI', 'ongkir'));
        // }

        public function calculateShipping(Request $request)
        {
            $setting = Setting::first();
            $origin = $setting->city_id; // Ganti dengan ID kota asal yang sesuai
            $destination = $request->city_id;
            $weight = $request->weight;
            $courier = $request->courier;

            // Lakukan permintaan API untuk menghitung biaya pengiriman
            $response = Http::asForm()->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY'), // Ganti dengan kunci API RajaOngkir Anda
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            $packages = [];
            $results = $response['rajaongkir']['results'];
            foreach ($results as $result) {
                $serviceName = $result['name'];
                $costs = $result['costs'];
                foreach ($costs as $cost) {
                    $service = $cost['service'];
                    $description = $cost['description'];
                    $costValue = $cost['cost'][0]['value'];
                    $etd = $cost['cost'][0]['etd'];
                    $packages[] = [
                        'service' => $service,
                        'description' => $description,
                        'value' => $costValue,
                        'etd' => $etd
                    ];
                    
                }
            }

            // Ambil data provinsi dan kota dari sumber data (misalnya, basis data atau API) dan tambahkan ke variabel $provinces
            $provinces = Province::all(); // Contoh jika menggunakan model Province dari basis data
            foreach ($provinces as $province) {
                $province->cities = City::where('province_id', $province->id)->get(); // Contoh jika menggunakan model City dari basis data
            }

            return response()->json([
                'packages' => $packages,
                'cost' => $response['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'],
                'provinces' => $provinces
            ]);
        }

        // public function ajax($id)
        // {
        //     $responseCity = Http::get('https://api.rajaongkir.com/starter/city', [
        //         'key' => env('RAJAONGKIR_API_KEY'),
        //         'province' => $id,
        //     ]);

        //     $cities = $responseCity['rajaongkir']['results'];
        //     $cities = collect($cities)->pluck('city_name', 'city_id');

        //     return json_encode($cities);
        // }
    }
