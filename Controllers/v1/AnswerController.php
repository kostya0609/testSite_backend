<?php

namespace App\Modules\Site\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerController extends Controller{

    public function add(Request $request){
        return response()->json([
            'success'     => true,
            'data'        => [
                'answer_id' => rand(100, 1000),
            ],
            'message'     => 'Ответ в вопрос добавлен'
        ]);
    }

    public function delete(Request $request){
        return response()->json([
            'success' => true,
            'message' => 'Ответ из вопроса удален'
        ]);
    }

}
