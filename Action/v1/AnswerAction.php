<?php

namespace App\Modules\Site\Action\v1;

class AnswerAction{

    public static function setAnswer($model, $data){
        if($data['question_id']) $model->question_id = $data['question_id'];
        if($data['answer'])      $model->answer      = $data['answer'];

        $model->save();

        return $model;
    }

}
