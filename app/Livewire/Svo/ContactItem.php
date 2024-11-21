<?php

namespace App\Livewire\Svo;

use Livewire\Component;

class ContactItem extends Component
{

    public $item;

    public function render()
    {
        return view('livewire.svo.contact-item');
    }
}
