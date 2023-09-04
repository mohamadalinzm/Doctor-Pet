<?php

use Illuminate\Support\Facades\Route;
use Comment\Http\Controller\Admin\CommentController;


Route::prefix('api/v1')->middleware(['api'])->group(function () {

    Route::prefix('admin')
        ->group(function(){
            Route::prefix('comments')->group(function(){
                Route::match(['get','post'],'/',[CommentController::class, 'index'])->name('comments.index');
                Route::post('/store',[CommentController::class, 'store'])->name('comments.store');
                Route::delete('/destroy/{comment}',[CommentController::class, 'destroy'])->name('comments.destroy');
                Route::post('/update/{comment}',[CommentController::class, 'update'])->name('comments.update');

            });
        });

});
