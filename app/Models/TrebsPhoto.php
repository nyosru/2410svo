<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrebsPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['svo_trebs_item_id', 'photo_url'];

    public function trebsItem()
    {
        return $this->belongsTo(SvoTrebItem::class,  'svo_trebs_item_id', 'id');
    }

    /**
     * Связь "многие к одному" с Photo.
     */
    public function photoLoaded()
    {
        return $this->belongsTo(Photo::class , 'photo_url', 'image');
    }
}
