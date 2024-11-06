<?php

namespace App\Livewire\Svo;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Nyos\Msg;

class Cart extends Component
{
    public $cartItems = [];
    public $name;
    public $phone;

    public function mount()
    {
        $this->cartItems = Session::get('cart', []);
    }

    public function incrementQuantity($itemId)
    {
        if (isset($this->cartItems[$itemId])) {
            $this->cartItems[$itemId]['quantity']++;
            Session::put('cart', $this->cartItems);
        }
    }

    public function incrementQuantity10($itemId)
    {
        if (isset($this->cartItems[$itemId])) {
            $this->cartItems[$itemId]['quantity'] += 10;
            Session::put('cart', $this->cartItems);
        }
    }

    public function decrementQuantity($itemId)
    {
        if (isset($this->cartItems[$itemId]) && $this->cartItems[$itemId]['quantity'] > 1) {
            $this->cartItems[$itemId]['quantity']--;
            Session::put('cart', $this->cartItems);
        }
    }

    public function decrementQuantity10($itemId)
    {
        if (isset($this->cartItems[$itemId]) && $this->cartItems[$itemId]['quantity'] > 1) {
            $this->cartItems[$itemId]['quantity'] -= 10;
            if ($this->cartItems[$itemId]['quantity'] < 0) {
                $this->cartItems[$itemId]['quantity'] = 0;
            }
            Session::put('cart', $this->cartItems);
        }
    }

    public function updateQuantity($itemId, $quantity)
    {
        // Округляем значение до целого числа
        $quantity = (int)round($quantity);

        if ($quantity < 0) {
            $quantity = 0;
        }

        if (isset($this->cartItems[$itemId])) {
            $this->cartItems[$itemId]['quantity'] = $quantity;
            Session::put('cart', $this->cartItems);
        }
    }

    public function sendOrder(){

        $msg = '🌟🌟🌟Новый заказ!🌟🌟🌟'.PHP_EOL;
        $itogo = 0;
        $msg1 = '';
        foreach($this->cartItems as $id_item => $v){

            if( $v['quantity'] == 0 )
                continue;

            $sum =  round($v['item']->price1*$v['quantity'],2 ) ;

            $msg1 .= '+ '.$v['item']->name.' / '.$v['item']->additive. PHP_EOL
                .' ('.$v['item']->price1.'р*'.$v['quantity'].'шт) = '.number_format( $sum ,2,'.','`') .' руб'. PHP_EOL. PHP_EOL;

            $itogo += $sum;
        }

        $msg .= 'Кто: '.$this->name .PHP_EOL;
        $msg .= 'Телефон: '.$this->phone .PHP_EOL;
        $msg .= 'Итого: '.number_format( $itogo ,2,'.','`').' руб'.PHP_EOL.'-------- что в заказе -------'.PHP_EOL.$msg1;

        for( $e = 1; $e<=10; $e++ ) {
            $s = env('TELEGA_ADRESAT_'.$e,null);
            if( !empty($s) )
            Msg::$admins_id[] = $s;
        }

        Msg::sendTelegramm($msg,null,2, env('TOKEN_ORDER_TELEGA') );
        Session::put('cart', []);
        $this->redirectRoute('svo.cart.ok');
    }

    public function render()
    {
        return view('livewire.svo.cart');
    }
}
