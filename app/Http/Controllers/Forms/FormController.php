<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Models\AnswerChoice;
use App\Models\AnswerForm;
use App\Models\AnswerQuestion;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view("forms.index");
    }

    public function edit(Form $form)
    {
        return view("forms.edit", compact("form"));
    }

    public function finish(Form $form){
        $form->finish = 1;
        $form->save();
        return redirect()->route("forms.index")->with("warning" , "you locked your form");
    }

    public function form(Form $form)
    {
        $questions = $form->questions()->orderBy('order')->get();
        return view("forms.form", compact("form", "questions"));
    }

    public function show(Form $form){
        $answerForms = $form->answerForms;
        return view("forms.show" , compact("form", "answerForms"));
    }
    
    public function store(Request $request, Form $form)
    {
        $answerForm = AnswerForm::create([
            "form_id" => $form->id,
            "user" => $request->user,
            "finish" => 1,
        ]);
    
        $questions = $form->questions;
    
        foreach ($questions->sortBy('order') as $question) {
            switch ($question->type) {
                case 'simple':
                case 'complexe':
                    AnswerQuestion::create([
                        'answer_form_id' => $answerForm->id,
                        'question_id' => $question->id,
                        'answer' => $request->input('reponse_' . $question->id),
                    ]);
                    break;
    
                case 'choix unique':
                    $response = $request->input('reponse_' . $question->id);
                    $answerQuestion = AnswerQuestion::create([
                        'answer_form_id' => $answerForm->id,
                        'question_id' => $question->id,
                        'answer' => $response,
                    ]);
                    // Trouve le choice_id correspondant
                    $choice = $question->choices->where('choice', $response)->first();
                    if ($choice) {
                        AnswerChoice::create([
                            'answer_question_id' => $answerQuestion->id,
                            'choice_id' => $choice->id,
                        ]);
                    }
                    break;
    
                case 'choix multiple':
                    $responses = $request->input('reponse_' . $question->id);
    
                    if (!is_array($responses)) {
                        $responses = [$responses];
                    }
    
                    $responseStr = implode(',', $responses);
    
                    $answerQuestion = AnswerQuestion::create([
                        'answer_form_id' => $answerForm->id,
                        'question_id' => $question->id,
                        'answer' => $responseStr,
                    ]);
    
                    foreach ($responses as $response) {
                        $choice = $question->choices->where('choice', $response)->first();
                        if ($choice) {
                            AnswerChoice::create([
                                'answer_question_id' => $answerQuestion->id,
                                'choice_id' => $choice->id,
                            ]);
                        }
                    }
                    break;
            }
        }
        return redirect()->route("forms.index")->with("success", "You responded to the form!");
    }
    
}
