<?php

namespace App\Modules\Site\Model;;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model{
    protected $table = 'l_site_logs';
    protected $dates = ['date'];

    public function question():BelongsTo{
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function setLog($question_id, $user_id, $event){
        $this->question_id = $question_id;
        $this->user_id     = $user_id;
        $this->date        = Carbon::now();
        $this->event       = $event;
        $this->save();
    }

}
