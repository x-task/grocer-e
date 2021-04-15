<?php

use App\Http\Controllers\RoleController;

/* View route */
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
/* Store route */
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

