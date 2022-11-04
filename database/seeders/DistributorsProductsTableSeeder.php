<?php

namespace Database\Seeders;

use App\Models\DistributorProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorsProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createMultipleUsers = [[
            'product_id' => '1',
            'distributor_id' => '1',
            'price' => '150000',
            'created_at' => now(),
        ],
        [
            'product_id' => '1',
            'distributor_id' => '1',
            'price' => '200000',
            'created_at' => now(),
        ],
        [
            'product_id' => '2',
            'distributor_id' => '2',
            'price' => '400000',
            'created_at' => now(),
        ],
        [
            'product_id' => '3',
            'distributor_id' => '3',
            'price' => '250000',
            'created_at' => now(),
        ],
        [
            'product_id' => '4',
            'distributor_id' => '4',
            'price' => '130000',
            'created_at' => now(),
            
        ]];

        DistributorProduct::insert($createMultipleUsers);
    }
}
