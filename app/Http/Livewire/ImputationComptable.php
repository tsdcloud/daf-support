<?php

namespace App\Http\Livewire;
use Illuminate\Support\Str;

use Livewire\Component;

class ImputationComptable extends Component
{
    public $fiche_depense;
    public $comptes;

    public $imputation_comptable = [];
    public $error = [];
    public $success = [
        'num_comptable' => '',
        'num_compte_general' => '',
        'code_tiers' => ''
    ];

    public $display_submit_btn = false;

    public function mount($fiche_depense, $comptes){
        $this->fiche_depense = $fiche_depense;
        $this->comptes = $comptes;
    }

    public function render()
    {
        return view('livewire.imputation-comptable');
    }

    public function checkNumComptableValidation(){
        if(Str::length($this->imputation_comptable['num_comptable']) <= 8){
            $this->success['num_comptable'] = true;
        }
    }

    public function checkCodeTiersValidation(){
        if(Str::length($this->imputation_comptable['code_tiers']) <= 8){
            $this->success['code_tiers'] = true;
        }
    }

    public function checkSectionAnalytiqueValidation(){
        if(Str::length($this->imputation_comptable['code_tiers']) <= 8){
            $this->success['code_tiers'] = true;
        }
    }
}
