<?php

use Animal\Http\Controller\Admin\AnimalAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api','auth:api'])->prefix('api/animals/')->group(function () {
    Route::get('/', [AnimalAdminController::class, 'list']);
    Route::get('/show/{animal_id}', [AnimalAdminController::class, 'show']);
    Route::post('/', [AnimalAdminController::class, 'store']);
    Route::post('/{animal_id}/update', [AnimalAdminController::class, 'update']);
    Route::delete('/{animal_id}/delete', [AnimalAdminController::class, 'delete']);
});

