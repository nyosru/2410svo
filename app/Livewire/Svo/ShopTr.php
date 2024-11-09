<?php

namespace App\Livewire\Svo;

use Livewire\Component;

use Illuminate\Support\Facades\Session;

#[Lazy]
class ShopTr extends Component
{
    public $item;
    public $nn = 1;
    public $quantities = 1; // Массив для хранения количества товаров
    public $inCart = false; // Проверка, добавлен ли товар в корзину


    // Метод для увеличения количества
    public function incrementQuantity($itemId)
    {
        $this->quantities++;
    }

    // Метод для уменьшения количества
    public function decrementQuantity($itemId)
    {
        if ( $this->quantities > 0) {
            $this->quantities--;
        }
    }


    public function mount()
    {
        // Проверка, находится ли товар в корзине
        $cart = Session::get('cart', []);
        if (isset($cart[$this->item['id']])) {
            $this->inCart = true;
        }
    }

    // Метод добавления товара в корзину
    public function addToCart()
    {
        $cart = Session::get('cart', []);

        // Добавляем или обновляем товар в корзине
        $cart[$this->item['id']] = [
            'quantity' => $this->quantities,
            'item' => $this->item,
        ];

        // Сохраняем корзину в сессии
        Session::put('cart', $cart);
        $this->inCart = true; // Меняем кнопку на "Перейти в корзину"
    }

    public function render()
    {
        return view('livewire.svo.shop-tr');
    }

}
