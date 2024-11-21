<?php

namespace App\Livewire\Svo;

use App\Models\SvoContact;
use Livewire\Component;

class Contact extends Component
{

    public $data; // Добавляем свойство для хранения текста поиска

    public function mount()
    {
        $this->data = SvoContact::with('photoLoaded')->get();
    }

    public function render()
    {
        return view('livewire.svo.contact');
    }
}
