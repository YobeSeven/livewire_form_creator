<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "answer_question_id",
        "choice_id"
    ];

    public function answerQuestion(){
        return $this->belongsTo(AnswerQuestion::class);
    }

    public function choice(){
        return $this->belongsTo(Choice::class);
    }
}
