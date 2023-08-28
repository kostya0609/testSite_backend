<?php
use Illuminate\Support\Facades\Route;
use App\Modules\Site\Controllers;

Route::prefix('site')
    ->group(function(){

        Route::prefix('questions')->group(function (){
            Route::post('list',Controllers\QuestionController::class.'@list');

        });

    });

