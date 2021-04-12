<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


/* Middleware that checks if a group of Routes are authorized */
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');


});


// Route with middleware, checks if the user is authenticated to see the post.
// Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');
