<?php
namespace App\Modules\Site\Controllers\v1;
use App\Modules\Site\Action\v1\QuestionAction;
use App\Modules\Site\Model\Question;
use App\Modules\Site\Model\Log;
use App\Modules\Site\Model\Answer;
use App\Http\Controllers\Controller;
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
        $user_id     = $request->user_id;
        $question_id = $request->question_id;

        if(!$user_id || !$question_id)
            return response()->json([
                'success'   => false,
                'message'   => 'Нет user_id или нет question_id.',
            ]);

        DB::beginTransaction();
        try {
            Answer::where('question_id', '=', $question_id)->delete();
            Question::where('id', '=', $question_id)->delete();

            $log = new Log();
            $logMessage = "Вопрос с ID $question_id был удален со всеми ответами";
            $log->setLog(
                $question_id,
                $user_id,
                $logMessage
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Вопрос успешно удален',
            ]);

        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


    }

    public function list(Request $request){

        $questionModels = Question::orderBy('id', 'asc')->with('answers')->get();

        return response()->json([
            'success' => true,
            'data'    => $questionModels,
        ]);
    }

}
