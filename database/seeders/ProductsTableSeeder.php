<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createMultipleUsers = [[
            'code' => 'A1',
            'name' => 'Product 1',
            
        ],
        [
            'code' => 'A2',
            'name' => 'Product 2',
            
        ],
        [
            'code' => 'A3',
            'name' => 'Product 3',
            
        ],
        [
            'code' => 'A4',
            'name' => 'Product 4',
            
        ],
        [
            'code' => 'A5',
            'name' => 'Product 5',
            
        ]];

        Product::insert($createMultipleUsers);
    }
}
