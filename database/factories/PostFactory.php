<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->randomElement([
                'Огляд нового iPhone 15 Pro',
                'Laravel 11: що нового?',
                'ТОП-10 AI-інструментів 2025',
                'Як почати з Docker',
                'Тренди веб-розробки',
                'ChatGPT для розробників',
                'Kubernetes для початківців',
                'React vs Vue: що обрати?',
                'Кібербезпека в 2025',
                'Python для Data Science'
            ]) . ' ' . fake()->year();

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(5, true),
            'published_at' => now(),
            'is_published' => true,
        ];
    }
}
