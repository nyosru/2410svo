<?php

namespace App\TDO;

class FinReportTDO
{
    public string $vid;
    public string $firma;
    public string $nom_schet;
    public string $naim_schet;
    public ?string $zateya;
    public ?string $m_o_l;
    public ?string $znachenie_dok;
    public ?string $nom_str;
    public ?string $naimenovanie;
    public ?string $dobavka;
    public ?string $koment;
    public ?string $dvizh;
    public ?string $foto;

    public ?float $debet_nach;
    public ?float $kredit_nach;
    public ?float $debet;
    public ?float $kredit;
    public ?float $debet_kon;
    public ?float $kredit_kon;
    public ?float $deb_kol_nach;
    public ?float $kred_kol_nach;
    public ?float $deb_kol;
    public ?float $kred_kol;
    public ?float $deb_kol_kon;
    public ?float $kred_kol_kon;

    public function __construct(array $data)
    {
        $this->vid = $data['vid'] ?? '';
        $this->firma = $data['firma'] ?? '';
        $this->nom_schet = $data['nom_schet'] ?? '';
        $this->naim_schet = $data['naim_schet'] ?? '';
        $this->zateya = $data['zateya'] ?? null;
        $this->m_o_l = $data['m_o_l'] ?? null;
        $this->znachenie_dok = $data['znachenie_dok'] ?? null;
        $this->nom_str = $data['nom_str'] ?? null;
        $this->naimenovanie = $data['naimenovanie'] ?? null;
        $this->dobavka = $data['dobavka'] ?? null;
        $this->koment = $data['koment'] ?? null;
        $this->dvizh = $data['dvizh'] ?? null;
        $this->foto = $data['foto'] ?? null;
        $this->debet_nach = $data['debet_nach'] ?? null;
        $this->kredit_nach = $data['kredit_nach'] ?? null;
        $this->debet = $data['debet'] ?? null;
        $this->kredit = $data['kredit'] ?? null;
        $this->debet_kon = $data['debet_kon'] ?? null;
        $this->kredit_kon = $data['kredit_kon'] ?? null;
        $this->deb_kol_nach = $data['deb_kol_nach'] ?? null;
        $this->kred_kol_nach = $data['kred_kol_nach'] ?? null;
        $this->deb_kol = $data['deb_kol'] ?? null;
        $this->kred_kol = $data['kred_kol'] ?? null;
        $this->deb_kol_kon = $data['deb_kol_kon'] ?? null;
        $this->kred_kol_kon = $data['kred_kol_kon'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'vid' => $this->vid,
            'firma' => $this->firma,
            'nom_schet' => $this->nom_schet,
            'naim_schet' => $this->naim_schet,
            'zateya' => $this->zateya,
            'm_o_l' => $this->m_o_l,
            'znachenie_dok' => $this->znachenie_dok,
            'nom_str' => $this->nom_str,
            'naimenovanie' => $this->naimenovanie,
            'dobavka' => $this->dobavka,
            'koment' => $this->koment,
            'dvizh' => $this->dvizh,
            'foto' => $this->foto,
            'debet_nach' => $this->debet_nach,
            'kredit_nach' => $this->kredit_nach,
            'debet' => $this->debet,
            'kredit' => $this->kredit,
            'debet_kon' => $this->debet_kon,
            'kredit_kon' => $this->kredit_kon,
            'deb_kol_nach' => $this->deb_kol_nach,
            'kred_kol_nach' => $this->kred_kol_nach,
            'deb_kol' => $this->deb_kol,
            'kred_kol' => $this->kred_kol,
            'deb_kol_kon' => $this->deb_kol_kon,
            'kred_kol_kon' => $this->kred_kol_kon,
        ];
    }
}
