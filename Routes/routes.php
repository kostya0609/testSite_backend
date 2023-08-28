<?php
namespace App\Modules\Site\Controllers\v1;

use Illuminate\Support\Facades\Route;

Route::prefix('site')
    ->group(function (){
        Route::prefix('v1')
            ->group(function(){
                Route::prefix('questions')->group(function (){
                    Route::post('list',QuestionController::class.'@list');
                });
            });
});


