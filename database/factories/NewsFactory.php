<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 100) . '/1920/1080', // Gambar random 1920x1080
            'author' => $this->faker->name(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_published' => $this->faker->boolean(90),
        ];
    }
}
