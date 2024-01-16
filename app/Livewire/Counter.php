<?php

namespace App\Livewire;

use App\Models\Count;
use Livewire\Component;

class Counter extends Component
{
    public $counts;

    public function mount()
    {
        $this->loadCounts();
    }

    public function loadCounts()
    {
        $this->counts = Count::all();
    }

    public function createCounter()
    {
        $newCount = Count::create(['number' => 0]);
        $this->counts->push($newCount);
    }

    public function increment($countId)
    {
        $count = Count::find($countId);
        if ($count) {
            $count->increment('number');
            //* Modification de la ligne ( + favorable )
            $this->counts->where('id', $countId)->first()->number = $count->number;
        }
    }

    public function decrement($countId)
    {
        $count = Count::find($countId);
        if ($count) {
            $count->decrement('number');
            //* Modification de la ligne ( + favorable )
            $this->counts->where('id', $countId)->first()->number = $count->number;
        }
    }

    public function zero($countId)
    {
        $count = Count::find($countId);
        if ($count) {
            $count->update(["number" => 0]);
            //* Modification de la ligne ( + favorable )
            $this->counts->where('id', $countId)->first()->number = 0;
        }
    }

    public function destroy($countId)
    {
        $count = Count::find($countId);
        if ($count) {
            $count->delete();
            //* Modification de la ligne ( + favorable )
            //! EXPLICATION : 
            //^ Cette méthode consiste a faire une boucle sur counts , et rejeter tout les éléments qui n'ont pas le même Id
            //^ Si elle tombe sur elle , alors elle se mets à jour !
            $this->counts = $this->counts->reject(function ($count) use ($countId) {
                return $count->id == $countId;
            });
        }
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
