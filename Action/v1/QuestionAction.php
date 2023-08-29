<?php

namespace App\Modules\Site\Action\v1;

class QuestionAction {
    public static function setQuestion($model, $data){
        if($data['question']) $model->question = $data['question'];

        $model->save();

        return $model;
    }

}

