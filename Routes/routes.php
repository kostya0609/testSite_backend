<?php
namespace App\Modules\TestSite\Controllers\v1;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')
    ->group(function (){
        Route::prefix('site')
            ->group(function(){
                Route::prefix('questions')->group(function (){
                    Route::post('list',Controllers\v1\QuestionController::class.'@list');
                });
            });
});


