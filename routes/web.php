<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

/* Middleware that checks if a group of Routes are authorized */
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');
    /* View all posts Create and Store routes */
    Route::get('/admin/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('post.store');

    /* Post Update, Delete, Edit routes */
    Route::delete('/admin/posts/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');

    /* User View profile, Update routes */
    Route::get('admin/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('admin/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');

    /* User Index routes */

    Route::delete('/admin/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});

/* Only User with Role of Admin can view this page */
Route::middleware('role:Admin')->group(function () {
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
});
// Route with middleware, checks if the user is authenticated to see the post.
// Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');
