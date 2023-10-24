<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImputationComptableFac extends Component
{
    public $comptes;
    public $fiche_approv_caisse;
    public $imputation_comptable;

    public function mount($comptes, $fiche_approv_caisse){
        $this->comptes = $comptes;
        $this->fiche_approv_caisse = $fiche_approv_caisse;
    }
    public function render()
    {
        return view('livewire.imputation-comptable-fac');
    }
}
