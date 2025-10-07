<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function posts(User $user)
    {
        $posts = $user->posts()
            ->with(['category', 'tags'])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(10);

        return view('users.posts', compact('user', 'posts'));
    }
}
