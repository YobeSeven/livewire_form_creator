<?php

namespace App\Livewire\Forms;

use App\Models\Form;
use Livewire\Component;

class ListForms extends Component
{
    public $forms;

    protected $listeners = ['loadForms' => 'loadForms'];

    public function mount()
    {
        $this->loadForms();
    }

    public function loadForms()
    {
        $this->forms = Form::all();
    }

    public function destroy($formId)
    {
        // Logique pour supprimer le formulaire avec l'ID donné
        $form = Form::find($formId);
        if ($form) {
            $form->delete();
        }

        // Rechargez la liste des formulaires après la suppression
        $this->loadForms();
    }

    public function finish($formId)
    {
        // Recherchez le formulaire par son ID
        $form = Form::find($formId);

        if ($form) {
            // Mettez à jour la colonne 'finish' à 1 (ou true)
            $form->update(['finish' => 1]);

            // Rechargez la liste des formulaires après la mise à jour
            $this->loadForms();
        }
    }



    public function render()
    {
        return view('livewire.forms.list-forms');
    }
}
