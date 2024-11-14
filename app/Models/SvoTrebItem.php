<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SvoTrebItem extends Model
{
    use HasFactory;

    protected $table = 'svo_trebs_items';

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array
     */
    protected $fillable = [
        'firma',
        'zateya',
        'mol',
        'mol_name',
        'mol_link',
        'mol_phone',
        'doc',
        'nom_str',
        'name',
        'dops',
        'comment',
        'curica',
        'site_tab',
        'photo',
        'debet_kon',
        'kredit_kon',
        'debet_kol_kon',
        'kredit_kol_kon',
    ];
}
