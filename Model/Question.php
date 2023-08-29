<?php
namespace App\Modules\Site\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Question extends Model{

    protected $table = 'l_site_questions';

    public function answers():Hasmany{
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

}
