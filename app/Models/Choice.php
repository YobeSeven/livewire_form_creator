<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        "question_id",
        "choice",
        "order",
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function answerChoices(){
        return $this->hasMany(AnswerChoice::class);
    }
}
