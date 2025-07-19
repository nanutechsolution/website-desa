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

        // Panggil UserSeeder secara terpisah
        $this->call(UserSeeder::class);
        $this->call([
            HeroSliderSeeder::class,
            NewsSeeder::class,
            // CommentSeeder::class,
            // ProductSeeder::class,
            // ServiceProcedureSeeder::class,
            ProfileContentSeeder::class,
            InstitutionSeeder::class
        ]);
    }
}
