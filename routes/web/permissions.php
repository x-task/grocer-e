<?php

use App\Http\Controllers\PermissionController;

/* Routes for permissions */
Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
