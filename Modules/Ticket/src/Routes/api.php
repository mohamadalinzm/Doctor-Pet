<?php

use Illuminate\Support\Facades\Route;
use Ticket\Http\Controller\Admin\TicketController;


Route::prefix('api/v1')->middleware(['api'])->group(function () {

    Route::prefix('admin')
        ->group(function(){
            Route::prefix('tickets')->group(function(){
                Route::match(['get','post'],'/',[TicketController::class, 'index'])->name('tickets.index');
                Route::post('/store',[TicketController::class, 'store'])->name('tickets.store');
                Route::delete('/destroy/{ticket}',[TicketController::class, 'destroy'])->name('tickets.destroy');
                Route::post('/update/{ticket}',[TicketController::class, 'update'])->name('tickets.update');

            });
        });

});
