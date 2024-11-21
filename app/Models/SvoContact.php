<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SvoContact extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'svo_contact';

    /**
     * Атрибуты, которые можно массово заполнять.
     *
     * @var array
     */
    protected $fillable = [
        'firma',
        'gruppa',
        'm_o_l',
        'telefon',
        'yur_adres',
        'mylo',
        'sayt_tab',
        'foto',
    ];


    /**
     * Связь "многие к одному" с Photo.
     */
    public function photoLoaded()
    {
        return $this->belongsTo(Photo::class , 'foto', 'image');
    }
}
