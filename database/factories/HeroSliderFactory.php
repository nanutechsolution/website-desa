<?php

namespace Database\Factories;

use App\Models\HeroSlider;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroSliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HeroSlider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            // Menggunakan gambar dari Lorem Picsum (contoh)
            'image' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 100) . '/1920/1080', // Gambar random 1920x1080
            // Atau jika ingin ukuran spesifik tanpa id (lebih cepat):
            // 'image' => $this->faker->imageUrl(1920, 1080, 'nature', true), // Perlu koneksi internet
            'is_active' => $this->faker->boolean(80),
            'order' => $this->faker->numberBetween(1, 5), // Hapus unique()
        ];
    }
}