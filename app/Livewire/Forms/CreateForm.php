<?php

namespace App\Livewire\Forms;

use App\Models\Form;
use Livewire\Component;

class CreateForm extends Component
{
    public $name;
    public $user;

    public function render()
    {
        return view('livewire.forms.create-form');
    }

    public function store()
    {
        // Valider les données
        $this->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
        ]);

        // Créer un nouveau formulaire
        Form::create([
            'name' => $this->name,
            'user' => $this->user,
            'finish' => 0
        ]);

        // Réinitialiser les champs
        $this->reset(['name', 'user']);

        // Émettre un événement pour informer que le formulaire a été ajouté
        $this->dispatch('loadForms', 'ListForms');
    }
}
