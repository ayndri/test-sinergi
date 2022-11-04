<?php

namespace Database\Seeders;

use App\Models\Distributor;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createMultipleUsers = [[
            'code' => 'D1',
            'name' => 'John',
            'address' => 'Surabaya',
            'created_at' => now(),
        ],
        [
            'code' => 'D2',
            'name' => 'Karina',
            'address' => 'Gresik',
            'created_at' => now(),
        ],
        [
            'code' => 'D3',
            'name' => 'Yunita',
            'address' => 'Mojokerto',
            'created_at' => now(),
        ],
        [
            'code' => 'D4',
            'name' => 'Arya',
            'address' => 'Pasuruan',
            'created_at' => now(),
        ],
        [
            'code' => 'D5',
            'name' => 'Rahmad',
            'address' => 'Sidoarjo',
            'created_at' => now(),
            
        ]];

        Distributor::insert($createMultipleUsers);
    }
}
