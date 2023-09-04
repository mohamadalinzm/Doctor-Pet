<?php

use Illuminate\Support\Facades\Route;
use User\Http\Controller\Admin\AdminUserController;


Route::prefix('user-management/admin')->group(function () {

    // Create
    Route::post('users', [AdminUserController::class, 'store'])
         ->name('users.store');


    // Show
    Route::get('users/{id}', [AdminUserController::class, 'show'])
         ->name('users.show');


   // Update
    Route::put('users/{user}', [AdminUserController::class, 'update'])
         ->name('users.update');


    // Delete
    Route::delete('users/{user}', [AdminUserController::class, 'delete'])
         ->name('users.delete');


    // List
    Route::get('users', [AdminUserController::class, 'index'])
         ->name('users.index');

    // List
    Route::get('users', [AdminUserController::class, 'index'])
         ->name('users.index');
});



