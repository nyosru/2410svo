<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    /**
     * Атрибуты, которые можно массово присваивать.
     */
    protected $fillable = [
        'image',
        'image_loaded',
        'preview_loaded'
    ];


    /**
     * Связь "один ко многим" с ShopPhoto.
     */
    public function shopPhotos()
    {
        return $this->hasMany(ShopPhoto::class, 'photo_url', 'image');
    }

    /**
     * Связь "один ко многим" с моделью TrebsPhoto.
     */
    public function trebsPhotos()
    {
        return $this->hasMany(TrebsPhoto::class, 'photo_url', 'image');
    }

}
