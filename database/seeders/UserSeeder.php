<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Untuk hash password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Admin Utama
        User::firstOrCreate(
            ['email' => 'admin@desa.com'], // Cari berdasarkan email untuk menghindari duplikasi
            [
                'name' => 'Radianus', // Nama admin utama
                'password' => Hash::make('password'), // Password: password
                'role' => 'admin', // Atur role sebagai 'admin'
                'email_verified_at' => now(), // Verifikasi email secara otomatis
                // Avatar default dari UI Avatars jika tidak ada image_url di UserFactory
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode('Radianus') . '&color=7F9CF5&background=EBF4FF',
            ]
        );

        // // 2. Buat Beberapa User Biasa (Role 'user')
        // User::factory()->count(2)->create([
        //     'role' => 'user', // Atur role sebagai 'user'
        // ]);

        // // 3. Buat User Admin Tambahan (Opsional)
        // User::factory()->count(1)->create([
        //     'name' => 'Admin Test',
        //     'email' => 'test@admin.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'admin',
        // ]);
    }
}
