<?php

namespace App\TDO;

class SvoContactTDO
{
    public string|null $firma;
    public string|null $gruppa;
    public string|null $m_o_l;
    public string|null $telefon;
    public string|null $yur_adres;
    public string|null $mylo;
    public string|null $sayt_tab;
    public string|null $foto;

    /**
     * Конструктор DTO.
     *
     * @param array $data Входные данные.
     */
    public function __construct(array $data)
    {
        $this->firma = $data['firma'] ?? null;
        $this->gruppa = $data['gruppa'] ?? null;
        $this->m_o_l = $data['m_o_l'] ?? null;
        $this->telefon = $data['telefon'] ?? null;
        $this->yur_adres = $data['yur_adres'] ?? null;
        $this->mylo = $data['mylo'] ?? null;
        $this->sayt_tab = $data['sayt_tab'] ?? null;
        $this->foto = $data['foto'] ?? null;
    }

    /**
     * Создать DTO из массива.
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Преобразовать DTO в массив.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'firma' => $this->firma,
            'gruppa' => $this->gruppa,
            'm_o_l' => $this->m_o_l,
            'telefon' => $this->telefon,
            'yur_adres' => $this->yur_adres,
            'mylo' => $this->mylo,
            'sayt_tab' => $this->sayt_tab,
            'foto' => $this->foto,
        ];
    }
}
