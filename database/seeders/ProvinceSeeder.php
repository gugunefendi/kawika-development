<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\City;


class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withHeaders([
            'key' => '60209fb44df6ac423ae3d3e128181c6d'
        ])->get('https://api.rajaongkir.com/starter/province');
        
        $provinces = $response['rajaongkir']['results'];
        
        foreach($provinces as $province) {
            $dataProvinces[] = [
                'id' => $province['province_id'],
                'province' => $province['province'],
            ];
        }

        Province::Insert($dataProvinces);
    }
}
