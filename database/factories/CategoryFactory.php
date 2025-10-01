<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Новини технологій',
            'Огляди гаджетів',
            'Програмування',
            'Штучний інтелект',
            'Кібербезпека',
            'Веб-розробка',
            'Мобільні додатки',
            'DevOps'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
        ];
    }
}
