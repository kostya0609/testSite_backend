<?php

namespace App\Modules\Site\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Modules\Site\Action\v1\AnswerAction;
use App\Modules\Site\Model\Question;
use App\Modules\Site\Model\Answer;
use App\Modules\Site\Model\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller{

    public function add(Request $request){
        $user_id     = $request->user_id;
        $question_id = $request->data['question_id'];
        $data        = $request->data;

        if(!$user_id || !$question_id)
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id или нет question_id.',
            ]);

        DB::beginTransaction();
        try {
            $newAnswer = new Answer();

            $newAnswer = AnswerAction::setAnswer($newAnswer, $data);

            $answer_id = $newAnswer->id;

            $log = new Log();
            $logMessage = "В вопрос с ID $question_id добавлен новый ответ с ID $answer_id";
            $log->setLog(
                $question_id,
                $user_id,
                $logMessage
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Успешно',
                'data'    => [
                    'answer_id'=> $answer_id
                ],
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


        $taskModel = Question::with(['dots.targets', 'dots.city', 'files'])->find($task_id);

        return response()->json([
            'success'     => true,
            'data'        => [
                'answer_id' => rand(100, 1000),
            ],
            'message'     => 'Ответ в вопрос добавлен'
        ]);
    }

    public function delete(Request $request){
        $user_id     = $request->user_id;
        $answer_id   = $request->answer_id;

        if(!$user_id || !$answer_id)
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id или нет answer_id.',
            ]);

        DB::beginTransaction();
        try {
            $question_id = Answer::find($answer_id)->question->id;

            Answer::where('id', '=', $answer_id)->delete();

            $log = new Log();
            $logMessage = "Из вопроса с ID $question_id удален ответ с ID $answer_id";
            $log->setLog(
                $question_id,
                $user_id,
                $logMessage
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Ответ успешно удален',
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
