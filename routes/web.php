<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);

Route::resource('categories', CategoryController::class)->only(['index', 'show']);

Route::resource('tags', TagController::class)->only(['index', 'show']);

Route::resource('posts.comments', CommentController::class)->only(['store', 'destroy']);
