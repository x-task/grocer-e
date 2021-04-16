<?php

use App\Http\Controllers\RoleController;

/* View route */
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
/* Store route */
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
/* Delete route */
Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
/* Edit & Update routes */
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}/update', [RoleController::class, 'update'])->name('roles.update');
/* Attach/Detach rote */
Route::put('/roles/{role}/attach', [RoleController::class, 'attachPermission'])->name('role.permission.attach');
Route::put('/roles/{role}/detach', [RoleController::class, 'detachPermission'])->name('role.permission.detach');
