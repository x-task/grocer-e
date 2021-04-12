<?php

use App\Http\Controllers\UserController;

/* User Update, Delete routes */


/* Only User with Role of Admin can view this page */
Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
});

/* Route so Users can edit their profile, also Admin can edit profiles */
Route::middleware(['auth', 'can:view,user'])->group(function () {
    Route::get('users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::delete('users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});
