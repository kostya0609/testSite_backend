<?php
use Illuminate\Support\Facades\Route;
use App\Modules\Site\Controllers;

Route::prefix('site')
    ->group(function(){

        Route::prefix('info')->group(function (){
            Route::post('get',Controllers\InfoController::class.'@get');

        });

    });

