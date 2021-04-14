<?php

use App\Http\Controllers\UserController;

/* User Update, Delete routes */


/* Only User with Role of Admin can use these routes */
Route::middleware(['role:Admin', 'auth'])->group(function () {
    /* View all Users route */
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
    /* Attach and Detach routes */
    Route::put('users/{user}/attach', [UserController::class, 'attach'])->name('user.role.attach');
    Route::put('users/{user}/detach', [UserController::class, 'detach'])->name('user.role.detach');

});

/* Route so Users can edit their profile, also Admin can edit profiles */
Route::middleware(['auth', 'can:view,user'])->group(function () {
    /* User's profile route */
    Route::get('users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    /* User's update route */
    Route::put('users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
    /* User's delete route */
    Route::delete('users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});
