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


    /**
     * Связь "многие к одному" с Photo.
     */
    public function photoLoaded()
    {
        return $this->belongsTo(Photo::class, 'photo_url', 'image');
    }

}
