<?php

namespace App\TDO;

class TrebsCsvDataTdo
{
    public $firma;
    public $up_id = null;
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
        $this->firma = $data['Firma'] ?? '';
        $this->zateya = $data['Zateya'] ?? '';

//        $this->mol = $data['Mol'] ?? '';

        $this->mol_name = $data['MOL'] ?? '';
        $this->mol_phone = $data['Telefon'] ?? '';
        $this->mol_link = $data['SaytTab'] ?? '';

        $this->name = $data['Naimenovanie'] ?? '';
        $this->dops = $data['Dobavka'] ?? '';
        $this->comment = $data['Koment'] ?? '';

        $this->curica = $data['Kuritsa'] ?? '';
        $this->photo = $data['Foto'] ?? '';

        $this->doc = $data['ZnachenieDok'] ?? '';
        $this->nom_str = $data['NomStr'] ?? '';
        $this->uroven = $data['Uroven'] ?? '';

        if (!empty($data['up_id'])) {
            $this->up_id = $data['up_id'];
        }

        // Замена запятой на точку и округление чисел до 2 знаков после запятой
        if (!empty($data['DebetKon'])) {
            $this->debet_kon = round((float)str_replace(',', '.', trim($data['DebetKon'])), 2);
        }

        if (!empty($data['KreditKon'])) {
            $this->kredit_kon = round((float)str_replace(',', '.', trim($data['KreditKon'])), 2);
        }

        if (!empty($data['DebKolKon'])) {
            $this->debet_kol_kon = round((float)str_replace(',', '.', trim($data['DebKolKon'])), 2);
        }

        if (!empty($data['KredKolKon'])) {
            $this->kredit_kol_kon = round((float)str_replace(',', '.', trim($data['KredKolKon'])), 2);
        }
    }

    public function setUpId( $val )
    {
        $this->up_id = $val;
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
            'kredit_kol_kon' => $this->kredit_kol_kon,
            'uroven' => $this->uroven,
            'up_id' => $this->up_id,
        ];
    }
}
