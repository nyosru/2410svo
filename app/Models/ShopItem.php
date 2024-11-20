<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "firma",
        "naimenovanie",
        "dobavka",
        "kod_t",
        "sayt_tab",

        "analog",
        "foto",

        "deb_kol_kon",
        "tsena1",
        "tsena2",
        "tsena3"
    ];


    // Добавляем связь с фотографиями
    public function photos()
    {
        return $this->hasMany(ShopPhoto::class, 'shop_item_id');
    }

}
