<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ParseInputValue extends Component
{
    public $inputValue;

    public function render()
    {
        return view('livewire.parse-input-value');
    }
    
    public function changeInput(){
        dd($this->inputValue);
    }
}
