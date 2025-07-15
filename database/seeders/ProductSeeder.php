<?php

namespace Database\Seeders;
// database/seeders/ProductSeeder.php
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory()->count(15)->create(); // Buat 15 produk
    }
}
