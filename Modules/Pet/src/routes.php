<?php

use Illuminate\Support\Facades\Route;
use Pet\Http\Controller\Costumer\PetCostumerController;

Route::middleware(['api','auth:api'])->prefix('api/pets/')->group(function () {
    Route::get('/', [PetCostumerController::class, 'list']);
    Route::get('/show/{pet}', [PetCostumerController::class, 'show']);
    Route::post('/', [PetCostumerController::class, 'store']);
    Route::post('/{pet}/update', [PetCostumerController::class, 'update']);
    Route::delete('/{pet}/delete', [PetCostumerController::class, 'delete']);
});

