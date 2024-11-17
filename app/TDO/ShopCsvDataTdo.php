<?php

namespace App\TDO;

class ShopCsvDataTdo
{

    public ?string $firma;
    public string $naimenovanie;
    public ?string $dobavka = null;
    public ?string $kod_t;
    public ?string $sayt_tab;
    public ?string $foto;
    public int $deb_kol_kon;
    public float $tsena1;
    public ?float $tsena2 = null;
    public ?float $tsena3 = null;


    public function __construct( array $data ){

        $this->firma = $data['firma'] ?? null;
        $this->naimenovanie = $data['naimenovanie'] ?? '';
        $this->dobavka = $data['dobavka'] ?? null;
        $this->kod_t = $data['kod_t'] ?? null;
        $this->sayt_tab = $data['sayt_tab'] ?? null;
        $this->foto = $data['foto'] ?? null;
        $this->deb_kol_kon = $data['deb_kol_kon'] ?? 0;
        $this->tsena1 = (float) $data['tsena1'] ?? 0;
        $this->tsena2 = (float) $data['tsena2'] ?? 0;
        $this->tsena3 = (float) $data['tsena3'] ?? 0;
    }

    public function toArray(): array
    {
        return [
            'firma' => $this->firma,
            'naimenovanie' => $this->naimenovanie,
            'dobavka' => $this->dobavka,
            'kod_t' => $this->kod_t,
            'sayt_tab' => $this->sayt_tab,
            'foto' => $this->foto,
            'deb_kol_kon' => $this->deb_kol_kon,
            'tsena1' => $this->tsena1,
            'tsena2' => $this->tsena2,
            'tsena3' => $this->tsena3,
        ];
    }
}
