<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->shirt()->count(10)->create();
        Product::factory()->cap()->count(10)->create();
        Product::factory()->mug()->count(10)->create();
    }
}
