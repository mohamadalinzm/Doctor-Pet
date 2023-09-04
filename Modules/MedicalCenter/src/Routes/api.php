<?php

use Illuminate\Support\Facades\Route;
use MedicalCenter\Http\Controllers\Admin\MedicalCenter\CreateMedicalCenterController;
use MedicalCenter\Http\Controllers\Admin\MedicalCenter\DeleteMedicalCenterController;
use MedicalCenter\Http\Controllers\Admin\MedicalCenter\ListMedicalCenterController;
use MedicalCenter\Http\Controllers\Admin\MedicalCenter\UpdateMedicalCenterController;
use MedicalCenter\Http\Controllers\Admin\Service\CreateServiceController;
use MedicalCenter\Http\Controllers\Admin\Service\DeleteServiceController;
use MedicalCenter\Http\Controllers\Admin\Service\ListServiceController;
use MedicalCenter\Http\Controllers\Admin\Service\UpdateServiceController;
use MedicalCenter\Http\Controllers\Admin\Type\CreateTypeController;
use MedicalCenter\Http\Controllers\Admin\Type\DeleteTypeController;
use MedicalCenter\Http\Controllers\Admin\Type\ListTypeController;
use MedicalCenter\Http\Controllers\Admin\Type\UpdateTypeController;


Route::prefix('api/v1')->middleware(['api'])->group(function () {

    Route::prefix('admin')
        ->group(function(){
            Route::prefix('medical-centers')->group(function(){
                Route::match(['get','post'],'/',[ListMedicalCenterController::class, 'index'])->name('medical-centers.index');
                Route::post('/store',[CreateMedicalCenterController::class, 'store'])->name('medical-centers.store');
                Route::delete('/destroy/{medical-center}',[DeleteMedicalCenterController::class, 'destroy'])->name('medical-centers.destroy');
                Route::post('/update/{medical-center}',[UpdateMedicalCenterController::class, 'update'])->name('medical-centers.update');

                Route::prefix('services')
                    ->group(function(){
                        Route::match(['get','post'],'/',[ListServiceController::class, 'index'])->name('services.index');
                        Route::post('/store',[CreateServiceController::class, 'store'])->name('services.store');
                        Route::delete('/destroy/{service}',[DeleteServiceController::class, 'destroy'])->name('services.destroy');
                        Route::post('/update/{service}',[UpdateServiceController::class, 'update'])->name('services.update');
                    });

                Route::prefix('types')
                    ->group(function(){
                        Route::match(['get','post'],'/',[ListTypeController::class, 'index'])->name('types.index');
                        Route::post('/store',[CreateTypeController::class, 'store'])->name('types.store');
                        Route::delete('/destroy/{type}',[DeleteTypeController::class, 'destroy'])->name('types.destroy');
                        Route::post('/update/{type}',[UpdateTypeController::class, 'update'])->name('types.update');
                    });
            });
    });

});
