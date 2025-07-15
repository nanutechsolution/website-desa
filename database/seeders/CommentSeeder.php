<?php

namespace Database\Seeders;
// database/seeders/CommentSeeder.php
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Comment::factory()->count(20)->create(); // Buat 20 komentar dummy
    }
}
