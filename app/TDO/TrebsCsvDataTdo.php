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


    public ?string $analog = null;
    public ?string $poluchatel = null;
    public ?int $i_n_n = null;
    public ?int $k_p_p = null;
    public ?int $rschet = null;
    public ?string $bank = null;
    public ?int $b_i_k = null;
    public ?string $kor_schet = null;
    public ?string $adres_banka = null;

    public function __construct(array $data)
    {
        $this->firma = $data['firma'] ?? '';
        $this->zateya = $data['zateya'] ?? '';

        $this->mol_name = $data['m_o_l'] ?? '';
        $this->mol_phone = $data['telefon'] ?? '';
        $this->mol_link = $data['sayt_tab'] ?? '';

        $this->name = $data['naimenovanie'] ?? '';
        $this->dops = $data['dobavka'] ?? '';
        $this->comment = $data['koment'] ?? '';

        $this->curica = $data['kuritsa'] ?? '';
        $this->photo = $data['foto'] ?? '';

        $this->doc = $data['znachenie_dok'] ?? '';
        $this->nom_str = $data['nom_str'] ?? '';
        $this->uroven = $data['uroven'] ?? '';

        if (!empty($data['up_id'])) {
            $this->up_id = $data['up_id'];
        }

        if (!empty($data['analog'])) {
            $this->analog = $data['analog'];
        }
        if (!empty($data['poluchatel'])) {
            $this->poluchatel = $data['poluchatel'];
        }
        if (!empty($data['i_n_n'])) {
            $this->i_n_n = (int)$data['i_n_n'];
        }
        if (!empty($data['k_p_p'])) {
            $this->k_p_p = (int)$data['k_p_p'] ?? '';
        }
        if (!empty($data['rschet'])) {
            $this->rschet = (int)$data['rschet'];
        }
        if (!empty($data['bank'])) {
            $this->bank = $data['bank'];
        }
        if (!empty($data['b_i_k'])) {
            $this->b_i_k = (int)$data['b_i_k'];
        }
        if (!empty($data['kor_schet'])) {
            $this->kor_schet = (int)$data['kor_schet'];
        }
        if (!empty($data['adres_banka'])) {
            $this->adres_banka = $data['adres_banka'];
        }

        // Замена запятой на точку и округление чисел до 2 знаков после запятой
        if (!empty($data['debet_kon']) && $data['debet_kon'] <> 0) {
            $this->debet_kon = round((float)str_replace(',', '.', trim($data['debet_kon'])), 2);
        }

        if (!empty($data['kredit_kon']) && $data['kredit_kon'] <> 0) {
            $this->kredit_kon = round((float)str_replace(',', '.', trim($data['kredit_kon'])), 2);
        }

        if (!empty($data['deb_kol_kon']) && $data['deb_kol_kon'] <> 0) {
            $this->debet_kol_kon = round((float)str_replace(',', '.', trim($data['deb_kol_kon'])), 2);
        }

        if (!empty($data['kred_kol_kon']) && $data['kred_kol_kon'] <> 0) {
            $this->kredit_kol_kon = round((float)str_replace(',', '.', trim($data['kred_kol_kon'])), 2);
        }
    }

    public function setUpId($val)
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

            'analog' => $this->analog,
            'poluchatel' => $this->poluchatel,
            'i_n_n' => $this->i_n_n,
            'k_p_p' => $this->k_p_p,
            'rschet' => $this->rschet,
            'bank' => $this->bank,
            'b_i_k' => $this->b_i_k,
            'kor_schet' => $this->kor_schet,
            'adres_banka' => $this->adres_banka,

        ];
    }
}
