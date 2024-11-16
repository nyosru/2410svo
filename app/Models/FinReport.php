<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinReport extends Model
{
    use HasFactory;

    protected $table = 'fin_reports';

    protected $fillable = [
        'vid',
        'firma',
        'nom_schet',
        'naim_schet',
        'zateya',
        'm_o_l',
        'znachenie_dok',
        'nom_str',
        'naimenovanie',
        'dobavka',
        'koment',
        'dvizh',
        'foto',
        'debet_nach',
        'kredit_nach',
        'debet',
        'kredit',
        'debet_kon',
        'kredit_kon',
        'deb_kol_nach',
        'kred_kol_nach',
        'deb_kol',
        'kred_kol',
        'deb_kol_kon',
        'kred_kol_kon',
    ];
}
