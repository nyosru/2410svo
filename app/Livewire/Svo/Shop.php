<?php

namespace App\Livewire\Svo;

use App\Models\ShopItem;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedFirms = []; // Массив выбранных фирм
    public $firms; // Список всех доступных фирм

    public function mount()
    {
        // Получаем список уникальных фирм
        $this->firms = ShopItem::select('firma')
            ->distinct()
            ->orderBy('firma')
            ->get()
            ->pluck('firma')
            ->toArray();
    }

    public function updatedSelectedFirms()
    {
        $this->resetPage(); // Сбрасываем пагинацию при изменении фильтра
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
        $query = ShopItem::with('photos.photoLoaded')->whereNotNull('foto');

        // Фильтр по поисковому запросу
        if (!empty($this->search)) {
            $query->where('naimenovanie', 'REGEXP', $searchPattern)
                ->orWhere('dobavka', 'REGEXP', $searchPattern);
        }

        // Фильтр по выбранным фирмам
        if (!empty($this->selectedFirms)) {
            $query->whereIn('firma', $this->selectedFirms);
        }

        // Выполняем запрос с пагинацией
        $data = $query->paginate(10);

        return view('livewire.svo.shop', [
            'data1' => $data,
        ])->with('paginationView', 'svo.shop-pagination');
    }
}
