<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* Show post route */
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

 /* View all posts Create and Store routes */
 Route:: get('/admin/posts', [PostController::class, 'index'])->name('post.index');
 Route:: get('/admin/posts/create', [PostController::class, 'create'])->name('post.create');
 Route:: post('/admin/posts', [PostController::class, 'store'])->name('post.store');

 /* Post Update, Delete, Edit routes */
 Route:: delete('/admin/posts/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
 Route:: patch('/admin/posts/{post}/update', [PostController::class, 'update'])->name('post.update');
 Route:: get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
