<?php

use Address\Http\Controller\AddressController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api','auth:api'])->prefix('api/address/')->group(function () {
    Route::get('/', [AddressController::class, 'list']);
    Route::get('/show/{address}', [AddressController::class, 'show']);
    Route::post('/setDefault/{address}', [AddressController::class, 'setDefault']);
    Route::post('/', [AddressController::class, 'store']);
    Route::put('/{address}/update', [AddressController::class, 'update']);
    Route::delete('/{address}/delete', [AddressController::class, 'delete']);
});

