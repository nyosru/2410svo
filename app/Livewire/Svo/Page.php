<?php

namespace App\Livewire\Svo;

use Livewire\Component;

class Page extends Component
{
    public $page = 'index';
    public function render()
    {

        return view('livewire.svo.page');
    }
}
