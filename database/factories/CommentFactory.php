<?php

namespace Database\Factories;
// database/factories/CommentFactory.php
use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'news_id' => News::factory(), // Akan membuat News baru jika tidak ada
            // Atau: 'news_id' => News::all()->random()->id, // Jika sudah ada berita
            'user_id' => $this->faker->boolean(50) ? User::factory() : null, // 50% kemungkinan user login
            'guest_name' => $this->faker->name(),
            'guest_email' => $this->faker->unique()->safeEmail(),
            'content' => $this->faker->paragraph(rand(1, 3)),
            'is_approved' => $this->faker->boolean(70), // 70% kemungkinan sudah disetujui
        ];
    }
}