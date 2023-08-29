<?php
namespace App\Modules\Site\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model{

    protected $table = 'l_site_answers';

    public function question():BelongsTo{
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

}
