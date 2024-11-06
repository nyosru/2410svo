<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['shop_item_id', 'photo_url'];

    public function shopItem()
    {
        return $this->belongsTo(ShopItem::class);
    }
}
