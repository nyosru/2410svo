<?php

namespace App\TDO;

class TrebsCsvDataTdo
{
    public $firma;
    public $zateya = '';
    public $mol = '';
    public $mol_name = '';
    public $mol_link = '';
    public $mol_phone = '';
    public $doc = '';
    public $nom_str = '';
    public $name = '';
    public $dops = '';
    public $comment = '';
    public $curica = '';
    public $site_tab = '';
    public $photo = '';
    public $debet_kon = 0.0;
    public $kredit_kon = 0.0;
    public $debet_kol_kon = 0.0;
    public $kredit_kol_kon = 0.0;

    public function __construct(array $data)
    {
        $this->firma = trim($data[0] ?? '');
        $this->zateya = trim($data[1] ?? '');
        $this->mol = trim($data[2] ?? '');
        $this->mol_name = trim($data['mol_name'] ?? '');
        $this->mol_link = trim($data['mol_link'] ?? '');
        $this->mol_phone = trim($data['mol_phone'] ?? '');
        $this->doc = trim($data[3] ?? '');
        $this->nom_str = trim($data[4] ?? '');
        $this->name = trim($data[5] ?? '');
        $this->dops = trim($data[6] ?? '');
        $this->comment = trim($data[7] ?? '');
        $this->curica = trim($data[8] ?? '');
        $this->site_tab = trim($data[9] ?? '');
        $this->photo = trim($data[10] ?? '');

        // Замена запятой на точку и округление чисел до 2 знаков после запятой
        $this->debet_kon = isset($data[11]) ? round((float) str_replace(',', '.', trim($data[11])), 2) : 0.0;
        $this->kredit_kon = isset($data[12]) ? round((float) str_replace(',', '.', trim($data[12])), 2) : 0.0;
        $this->debet_kol_kon = isset($data[13]) ? round((float) str_replace(',', '.', trim($data[13])), 2) : 0.0;
        $this->kredit_kol_kon = isset($data[14]) ? round((float) str_replace(',', '.', trim($data[14])), 2) : 0.0;
    }

    public function toArray()
    {
        return [
            'firma' => $this->firma,
            'zateya' => $this->zateya,
            'mol' => $this->mol,
            'mol_name' => $this->mol_name,
            'mol_link' => $this->mol_link,
            'mol_phone' => $this->mol_phone,
            'doc' => $this->doc,
            'nom_str' => $this->nom_str,
            'name' => $this->name,
            'dops' => $this->dops,
            'comment' => $this->comment,
            'curica' => $this->curica,
            'site_tab' => $this->site_tab,
            'photo' => $this->photo,
            'debet_kon' => $this->debet_kon,
            'kredit_kon' => $this->kredit_kon,
            'debet_kol_kon' => $this->debet_kol_kon,
            'kredit_kol_kon' => $this->kredit_kol_kon
        ];
    }
}
