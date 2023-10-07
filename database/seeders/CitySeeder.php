<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withHeaders([
            'key' => '60209fb44df6ac423ae3d3e128181c6d'
        ])->get('https://api.rajaongkir.com/starter/city');
        
        $cities = $response['rajaongkir']['results'];
        
        foreach($cities as $city) {
            $dataCities[] = [
                'id' => $city['city_id'],
                'province_id' => $city['province_id'],
                'type' => $city['type'],
                'city_name' => $city['city_name'],
                'postal_code' => $city['postal_code'],
            ];
        }

        City::Insert($dataCities);
    }
}
