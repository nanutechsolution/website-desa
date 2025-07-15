<?php

namespace Database\Factories;
// database/factories/ProductFactory.php
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true) . ' ' . $this->faker->unique()->word(); // Pastikan nama lebih unik
        $categories = ['Makanan & Minuman', 'Kerajinan Tangan', 'Hasil Pertanian', 'Pakaian', 'Lain-lain'];

        return [
            'name' => 'Produk ' . $name,
            'slug' => Str::slug('Produk ' . $name),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(4, true),
            'price' => $this->faker->randomFloat(2, 5000, 500000), // Harga antara Rp 5.000 - Rp 500.000
            'image' => 'https://source.unsplash.com/random/640x480/?product,food,craft,village', // Gambar produk
            'category' => $this->faker->randomElement($categories),
            'contact_person' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->safeEmail(),
            'is_published' => $this->faker->boolean(90),
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
