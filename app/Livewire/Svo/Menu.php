<?php

namespace App\Livewire\Svo;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Menu extends Component
{
    public $cartItemsCount;

    public function mount()
    {
        // Предполагается, что метод getCartItemsCount() возвращает количество товаров в корзине
        $this->cartItemsCount = $this->getCartItemsCount();
    }

    public function getCartItemsCount()
    {
        $e = Session::get('cart', []);
        return !empty($e) ? count($e) : false;
    }


    public function render()
    {
        return view('livewire.svo.menu');
    }
}
