<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:3'],
        ]);

        $data['post_id'] = $post->id;
        // Тимчасово беремо першого користувача
        $data['user_id'] = User::first()->id;

        Comment::create($data);

        return redirect()->route('posts.show', $post)
            ->with('status', 'Коментар додано!');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('status', 'Коментар видалено!');
    }
}
