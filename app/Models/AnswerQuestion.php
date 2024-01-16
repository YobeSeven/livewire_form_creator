<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        "answer_form_id",
        "question_id",
        "answer",
    ];

    public function answerForm(){
        return $this->belongsTo(AnswerForm::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function answerChoices(){
        return $this->hasMany(AnswerChoice::class);
    }
}
