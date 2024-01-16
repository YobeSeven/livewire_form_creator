<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "user",
        "finish",
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function answerForms(){
        return $this->hasMany(AnswerForm::class);
    }
}
