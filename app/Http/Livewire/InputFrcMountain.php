<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputFrcMountain extends Component
{
    public $inputValue = [
        'montant' => null,
        'reliquat' => null,
    ];

    public function render()
    {
        return view('livewire.input-frc-mountain');
    }
}
