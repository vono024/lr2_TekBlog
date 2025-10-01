<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Laravel',
            'PHP',
            'JavaScript',
            'Python',
            'AI/ML',
            'ChatGPT',
            'Docker',
            'Kubernetes',
            'DevOps',
            'Cloud',
            'Security',
            'React',
            'Vue',
            'Node.js',
            'MySQL'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
