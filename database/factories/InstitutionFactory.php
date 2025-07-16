<?php

namespace Database\Factories;
// database/factories/InstitutionFactory.php
use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstitutionFactory extends Factory
{
    protected $model = Institution::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true) . ' ' . $this->faker->unique()->word();
        $categories = ['Kelembagaan Masyarakat', 'Ekonomi', 'Pendidikan', 'Keamanan', 'Kesehatan', 'Lingkungan', 'Lain-lain'];

        return [
            'name' => 'Lembaga ' . $name,
            'slug' => Str::slug('Lembaga ' . $name),
            'leader_name' => $this->faker->name(),
            'description' => $this->faker->paragraph(rand(3, 5)),
            'category' => $this->faker->randomElement($categories),
            'image' => 'https://source.unsplash.com/random/640x480/?organization,community,group',
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->safeEmail(),
            'is_published' => $this->faker->boolean(90),
            'order' => $this->faker->numberBetween(1, 50),
        ];
    }
}