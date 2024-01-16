<?php

namespace App\Livewire\Forms;

use App\Models\Choice;
use App\Models\Form;
use App\Models\Question;
use Livewire\Component;

class SingleForm extends Component
{
    //* FIRST DATA
    public $form;
    public $questions;
    public $firstQuestion;
    public $lastQuestion;
    //* INPUT
    public $question;
    public $type = "simple";
    public $choice;


    public function mount(Form $form)
    {
        $this->form = $form;
        $this->questions = $form->questions()->orderBy("order")->get();
        $this->firstQuestion = $form->questions()->orderBy('order')->first();
        $this->lastQuestion = $form->questions()->orderByDesc('order')->first();
    }

    public function render()
    {
        return view('livewire.forms.single-form');
    }

    public function storeQuestion()
    {
        $this->validate([
            "question" => 'required',
            "type"     => 'required',
        ]);

        $lastQuestion = Question::where("form_id", $this->form->id)->orderBy('order', 'desc')->first();
        $order = $lastQuestion ? $lastQuestion->order + 1 : 1;

        $data = [
            "form_id"   => $this->form->id,
            "type"      => $this->type,
            "question"  => $this->question,
            "order"     => $order,
        ];


        $this->reset(['question', 'type']);

        Question::create($data);

        $this->mount($this->form);
    }

    public function destroyQuestion($questionId)
    {
        $question = Question::find($questionId);
        $orderQuestion = $question->order;
        $formId = $question->form_id;
        $question->delete();
        Question::where("form_id", $formId)->where("order", ">", $orderQuestion)->decrement('order');

        $this->mount($this->form);
    }

    public function orderUpQuestion($questionId)
    {
        $question = Question::find($questionId);
        $previousQuestion = $this->form->questions->where('order', '<', $question->order)->sortByDesc('order')->first();

        if ($previousQuestion) {
            $tempOrder = $previousQuestion->order;
            $previousQuestion->update(['order' => $question->order]);
            $question->update(['order' => $tempOrder]);
        }

        $this->mount($this->form);
    }

    public function orderDownQuestion($questionId)
    {
        $question = Question::find($questionId);
        $nextQuestion = $this->form->questions->where('order', '>', $question->order)->sortBy('order')->first();

        if ($nextQuestion) {
            $tempOrder = $nextQuestion->order;
            $nextQuestion->update(['order' => $question->order]);
            $question->update(['order' => $tempOrder]);
        }

        $this->mount($this->form);
    }

    public function storeChoice($questionId)
    {
        // Assurez-vous de valider l'entrée du choix
        $this->validate(['choice' => 'required']);

        $lastChoice = Choice::where("question_id", $questionId)->orderBy("order", "desc")->first();
        $order = $lastChoice ? $lastChoice->order + 1 : 1;

        Choice::create([
            "question_id" => $questionId,
            "choice" => $this->choice,
            "order" => $order,
        ]);

        $this->reset(['choice']);

        $this->mount($this->form);
    }

    public function destroyChoice($choiceId)
    {
        $choice = Choice::find($choiceId);
        $orderChoice = $choice->order;
        $questionId = $choice->question_id;
        $choice->delete();
        Choice::where("question_id", $questionId)->where("order", ">", $orderChoice)->decrement('order');

        $this->mount($this->form);
    }

    public function orderUpChoice($choiceId)
    {
        $choice = Choice::find($choiceId);
        $question = Question::find($choice->question_id);
        $previousChoice = $question->choices->where('order', '<', $choice->order)->sortByDesc('order')->first();

        if ($previousChoice) {
            $tempOrder = $previousChoice->order;
            $previousChoice->update(['order' => $choice->order]);
            $choice->update(['order' => $tempOrder]);
        }

        $this->mount($this->form);
    }

    public function orderDownChoice($choiceId)
    {
        $choice = Choice::find($choiceId);
        $question = Question::find($choice->question_id);
        $nextChoice = $question->choices->where('order', '>', $choice->order)->sortBy('order')->first();

        if ($nextChoice) {
            $tempOrder = $nextChoice->order;
            $nextChoice->update(['order' => $choice->order]);
            $choice->update(['order' => $tempOrder]);
        }

        $this->mount($this->form);
    }
}
