<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category', 'tags'])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('status', 'Увійдіть для створення поста');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        $data['published_at'] = now();
        $data['is_published'] = true;

        $post = Post::create($data);

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('posts.show', $post)
            ->with('status', 'Пост успішно створено!');
    }

    public function show(Post $post)
    {
        $post->load(['author', 'category', 'tags', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (!auth()->check() || auth()->id() !== $post->user_id) {
            abort(403, 'Ви не можете редагувати цей пост');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        if (!auth()->check() || auth()->id() !== $post->user_id) {
            abort(403, 'Ви не можете редагувати цей пост');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);

        $post->update($data);

        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('posts.show', $post)
            ->with('status', 'Пост успішно оновлено!');
    }

    public function destroy(Post $post)
    {
        if (!auth()->check() || auth()->id() !== $post->user_id) {
            abort(403, 'Ви не можете видалити цей пост');
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('status', 'Пост успішно видалено!');
    }
}
