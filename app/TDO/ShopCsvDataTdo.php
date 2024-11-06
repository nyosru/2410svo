<?php

namespace App\TDO;

class ShopCsvDataTdo
{
    public $name;
    public $additive;
    public $code;
    public $photo;
    public $stock_balance;
    public $price1;
    public $price2;
    public $price3;

    public function __construct(array $data)
    {
        $this->name = trim($data[0]);
        $this->additive = trim($data[1]);
        $this->code = trim($data[2]);
        $this->photo = trim($data[3]);
        $this->stock_balance = (float) trim($data[4]);
        $this->price1 = (float) trim($data[5]);
        $this->price2 = (float) trim($data[6]);
        $this->price3 = (float) trim($data[7]);
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'additive' => $this->additive,
            'code' => $this->code,
            'photo' => $this->photo,
            'stock_balance' => $this->stock_balance,
            'price1' => $this->price1,
            'price2' => $this->price2,
            'price3' => $this->price3,
        ];
    }
}
