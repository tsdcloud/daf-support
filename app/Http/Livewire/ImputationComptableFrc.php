<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImputationComptableFrc extends Component
{
    public $comptes;
    public $fiche_retour_caisse;
    public $imputation_comptable;

    public function mount($fiche_retour_caisse,$comptes){
        $this->comptes = $comptes;
        $this->fiche_retour_caisse = $fiche_retour_caisse;
    }
    public function render()
    {
        return view('livewire.imputation-comptable-frc');
    }
}
