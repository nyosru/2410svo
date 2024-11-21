<?php

namespace App\Livewire\Svo;

use App\Models\ShopItem;
use App\Models\SvoContact;
use Livewire\Component;

class Contact extends Component
{

    public $data; // Добавляем свойство для хранения текста поиска
    public $search;

    public function mount()
    {
        $this->data = SvoContact::with('photoLoaded')->get();
    }

    public function render()
    {

        // Разделяем поисковый запрос на слова
        $keywords = explode(' ', trim($this->search));

        // Формируем регулярное выражение для поиска
        $searchPattern = implode('.*', array_map(function ($keyword) {
            return preg_quote($keyword, '/');
        }, $keywords));

        // Базовый запрос
        $query = SvoContact::with('photoLoaded');

        // Фильтр по поисковому запросу
        if (!empty($this->search)) {
            $query->where('gruppa', 'REGEXP', $searchPattern)
                ->orWhere('m_o_l', 'REGEXP', $searchPattern)
                ->orWhere('yur_adres', 'REGEXP', $searchPattern);
        }

        // Фильтр по выбранным фирмам
//        if (!empty($this->selectedFirms)) {
//            $query->whereIn('firma', $this->selectedFirms);
//        }

        // Выполняем запрос с пагинацией
//        $this->data = $query->paginate(10);
        $this->data = $query->get();

        return view('livewire.svo.contact');
    }
}
