<?php

namespace App\Modules\Site\Action\v1;

use App\Modules\Site\Action\TaskDot;
use App\Modules\Site\Action\TaskTarget;

class QuestionAction {
    public static function setQuestion($model, $data){
        if($data['question']) $model->question = $data['question'];

        $model->save();

        return $model;
    }

}

