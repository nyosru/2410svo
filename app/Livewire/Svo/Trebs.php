<?php

namespace App\Livewire\Svo;

use App\Models\SvoTrebItem;
use Livewire\Component;

class Trebs extends Component
{
    public $data = [];
//    public $file = 'IMPot.csv';

//    public function mount(){
//        $this->data = SvoTrebItem::all();
//    }

    public function render()
    {
        $this->data = SvoTrebItem::all();
        return view('livewire.svo.trebs');
    }
}
