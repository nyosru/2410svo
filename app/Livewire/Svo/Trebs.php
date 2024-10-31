<?php

namespace App\Livewire\Svo;

use Livewire\Component;

class Trebs extends Component
{
    public $data = [];
    public $file = 'IMPot.csv';

    public function mount(){

    }

    public function render()
    {
        return view('livewire.svo.trebs');
    }
}
