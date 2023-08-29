<?php
namespace App\Modules\Site\Controllers\v1;
use App\Modules\Site\Action\v1\QuestionAction;
use App\Modules\Site\Model\Log;

use App\Http\Controllers\Controller;
use App\Modules\Site\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller {
    public function add(Request $request){
        $user_id = $request->user_id;
        $data    = $request->data;

        if(!$user_id)
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id.',
            ]);

        DB::beginTransaction();
        try {
            $newQuestion = new Question();

            $newQuestion = QuestionAction::setQuestion($newQuestion, $data);

            $question_id = $newQuestion->id;

            $log = new Log();
            $logMessage = 'Новый вопрос добавлен';
            $log->setLog(
                $newQuestion->id,
                $user_id,
                $logMessage
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Успешно',
                'data'    => [
                    'question_id'=> $question_id
                ],
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
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
