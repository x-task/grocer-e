<?php

use App\Http\Controllers\PermissionController;

/* Routes for permissions */
Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
/* Store route */
Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
/* Delete route */
Route::delete('/permissions/{permission}/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
/* Edit & Update routes */
Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update');
/* Attach/Detach rote */
Route::put('/permissions/{permission}/attach', [PermissionController::class, 'attachRole'])->name('permission.role.attach');
Route::put('/permissions/{permission}/detach', [PermissionController::class, 'detachRole'])->name('permission.role.detach');

