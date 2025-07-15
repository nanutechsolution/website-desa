<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk User (jika ingin membuat user dummy)
        // User::factory(10)->create(); // Jika Anda ingin banyak user biasa
        \App\Models\User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.com',
            'password' => bcrypt('password'), // Password default
            // 'avatar' => 'avatars/dummy_avatar_1.jpg', // Sesuaikan
        ]);
        \App\Models\User::factory()->count(3)->create(); // Buat beberapa user tambahan dengan avatar dummy

        $this->call([
            HeroSliderSeeder::class,
            NewsSeeder::class,
            // GallerySeeder::class,
            // PotentialSeeder::class,
            // DocumentSeeder::class,
            CommentSeeder::class,
            ProductSeeder::class,
            ServiceProcedureSeeder::class,
            ProfileContentSeeder::class,
        ]);
    }
}
