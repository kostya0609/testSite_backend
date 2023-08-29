<?php
namespace App\Modules\Site\Controllers\v1;

use Illuminate\Support\Facades\Route;

Route::prefix('site')
    ->group(function (){
        Route::prefix('v1')
            ->group(function(){
                Route::prefix('questions')->group(function (){
                    Route::post('add',QuestionController::class.'@add');
                    Route::post('edit',QuestionController::class.'@edit');
                    Route::post('delete',QuestionController::class.'@delete');
                    Route::post('list',QuestionController::class.'@list');
                });

                Route::prefix('answers')->group(function (){
                    Route::post('add',AnswerController::class.'@add');
                    Route::post('edit',AnswerController::class.'@edit');
                    Route::post('delete',AnswerController::class.'@delete');
                });
            });
});


