<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            'Новини технологій',
            'Огляди гаджетів',
            'Програмування',
            'Штучний інтелект',
            'Кібербезпека',
            'Веб-розробка'
        ])->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->paragraph()
            ]);
        });

        $tags = collect([
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
            'Vue'
        ])->map(function ($name) {
            return Tag::create([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        });

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@techblog.com',
        ]);

        $users = User::factory(5)->create();
        $allUsers = $users->push($admin);

        Post::factory(20)->create([
            'user_id' => $allUsers->random()->id,
            'category_id' => $categories->random()->id,
        ])->each(function (Post $post) use ($tags, $allUsers) {
            // Прикріплюємо випадкові теги до поста
            $post->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')
            );

            Comment::factory(rand(3, 8))->create([
                'post_id' => $post->id,
                'user_id' => $allUsers->random()->id,
            ]);
        });
    }
}
