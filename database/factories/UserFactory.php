<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            // 'role' => 'user', // Anda bisa set default role di sini atau di seeder
            // Hapus atau komen baris avatar jika ingin UserSeeder yang mengontrol sepenuhnya
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode(fake()->name()) . '&color=7F9CF5&background=EBF4FF',
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
