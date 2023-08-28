<?php
namespace App\Modules\Site\Controllers\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller {
    public function add(Request $request){
        return response()->json([
            'success'     => true,
            'data'        => [
                'question_id' => rand(100, 1000),
            ],
            'message'     => 'Вопрос добавлен'
        ]);
    }

    public function delete(Request $request){
        $question_id = $request->question_id;

        return response()->json([
            'success' => true,
            'message' => 'Вопрос удален' . $question_id,
        ]);
    }

    public function list(Request $request){

        // моковые данные для отладки фронта
        $question_list = [
            [
                'id'       => 1,
                'question' => 'q_1',
                'answers'  => [
                    ['id' => 1, 'answer' => 'a_11'],
                    ['id' => 2, 'answer' => 'a_12'],
                    ['id' => 3, 'answer' => 'a_13']
                ]
            ],
            [
                'id'       => 2,
                'question' => 'q_2',
                'answers'  => [
                    ['id' => 4, 'answer' => 'a_21'],
                    ['id' => 5, 'answer' => 'a_22'],
                    ['id' => 6, 'answer' => 'a_23']
                ]
            ],
            [
                'id'       => 3,
                'question' => 'q_2',
                'answers'  => [
                    ['id' => 7, 'answer' => 'a_31'],
                    ['id' => 8, 'answer' => 'a_32'],
                    ['id' => 9, 'answer' => 'a_33']
                ]
            ]

        ];

        return response()->json([
            'success' => true,
            'data'    => $question_list,
        ]);
    }

    public function save(Request $request){
        return response()->json([
            'success'     => true,
            'message'     => 'Вопросы сохранены'
        ]);
    }
}
