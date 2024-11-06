<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'additive',
        'code',
        'photo',
        'stock_balance',
        'price1',
        'price2',
        'price3',
    ];


    // Добавляем связь с фотографиями
    public function photos()
    {
        return $this->hasMany(ShopPhoto::class, 'shop_item_id');
    }

}
