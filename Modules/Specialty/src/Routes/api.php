<?php

use Illuminate\Support\Facades\Route;
use Specialty\Http\Controllers\Admin\SpecialtyController;


Route::prefix('api/v1')->middleware(['api'])->group(function () {

    Route::prefix('admin')
        ->group(function(){
            Route::prefix('specialties')->group(function(){
                Route::match(['get','post'],'/',[SpecialtyController::class, 'index'])->name('specialties.index');
                Route::post('/store',[SpecialtyController::class, 'store'])->name('specialties.store');
                Route::delete('/destroy/{specialty}',[SpecialtyController::class, 'destroy'])->name('specialties.destroy');
                Route::post('/update/{specialty}',[SpecialtyController::class, 'update'])->name('specialties.update');

            });
        });

});
