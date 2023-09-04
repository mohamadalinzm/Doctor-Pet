<?php

use Illuminate\Support\Facades\Route;
use Shift\Http\Controller\AdminShiftController;
use Shift\Http\Controller\DoctorShiftController;


// routes for Admin ShiftController
Route::middleware(['auth:api', 'role:admin'])->prefix('/admin/shift-management')->group(function () {
    Route::get('/', [AdminShiftController::class, 'index']);
    Route::post('/', [AdminShiftController::class, 'store']);
    Route::get('/shifts/{id}', [AdminShiftController::class, 'show']);
    Route::put('/shifts/{id}/update', [AdminShiftController::class, 'update']);
    Route::delete('/shifts/{id}', [AdminShiftController::class, 'delete']);
});


// routes for DoctorShiftController
Route::middleware(['auth:api', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/shifts', [DoctorShiftController::class, 'index']);
    Route::post('/shifts', [DoctorShiftController::class, 'store']);
    Route::get('/shifts/{id}', [DoctorShiftController::class, 'show']);
    Route::put('/shifts/{id}/update', [DoctorShiftController::class, 'update']);
    Route::delete('/shifts/{id}', [DoctorShiftController::class, 'delete']);
});
