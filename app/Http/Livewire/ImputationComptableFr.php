<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImputationComptableFr extends Component
{
    public $comptes;
    public $recipe_sheet;
    public $imputation_comptable;
    public function mount($recipe_sheet,$comptes){
        $this->comptes = $comptes;
        $this->recipe_sheet = $recipe_sheet;
    }
    public function render()
    {
        return view('livewire.imputation-comptable-fr');
    }

    // public function checkNumComptableValidation(){
    //     if(Str::length($this->imputation_comptable['num_comptable']) <= 8){
    //         $this->success['num_comptable'] = true;
    //     }
    // }

    // public function checkCodeTiersValidation(){
    //     if(Str::length($this->imputation_comptable['code_tiers']) <= 8){
    //         $this->success['code_tiers'] = true;
    //     }
    // }

    // public function checkSectionAnalytiqueValidation(){
    //     if(Str::length($this->imputation_comptable['code_tiers']) <= 8){
    //         $this->success['code_tiers'] = true;
    //     }
    // }
}
