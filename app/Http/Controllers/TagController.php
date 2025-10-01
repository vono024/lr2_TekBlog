<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')->get();

        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()
            ->with(['author', 'category'])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(10);

        return view('tags.show', compact('tag', 'posts'));
    }
}
