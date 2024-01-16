<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerForm extends Model
{
    use HasFactory;

    protected $fillable = [
        "form_id",
        "user",
        "finish",
    ];

    public function form(){
        return $this->belongsTo(Form::class);
    }

    public function answerQuestions(){
        return $this->hasMany(AnswerQuestion::class);
    }
}
