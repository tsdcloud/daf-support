<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LabelRecipeSheet extends Component
{
    public $recipe_sheet_id;
    public $libelle;
    public $prix_unitaire;
    public $quantite;
    public $prix_total;
    public $site_prod;

    public $data=[];

    public function render()
    {
         return view('livewire.label-recipe-sheet');
    }
    public function store()
    {
        dd('ok');
    }
}
