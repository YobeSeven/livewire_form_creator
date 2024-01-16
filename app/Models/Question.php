<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        "form_id",
        "type",
        "question",
        "order",
    ];

    public function form(){
        return $this->belongsTo(Form::class);
    }

    public function choices(){
        return $this->hasMany(Choice::class);
    }

    public function answerQuestions(){
        return $this->hasMany(AnswerQuestion::class);
    }
}
