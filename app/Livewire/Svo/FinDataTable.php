<?php

namespace App\Livewire\Svo;

use App\Models\FinReport;
use Livewire\Component;
use Livewire\WithPagination;

class FinDataTable extends Component
{
    use WithPagination;

    public $data_head = [
        'Вид<br/>Фирма',
        'НомСчет<br/>НаимСчет',
        'Затея<br/>МОЛ',
        'ЗначениеДок<br/>НомСтр',
        'Наименование<br/>Добавка',
        'Комент<br/>Движ',
        'ДебетНач<br/>ДебКолНач',
        'КредитНач<br/>КредКолНач',
        'Дебет<br/>ДебКол',
        'Кредит<br/>КредКол',
        'ДебетКон<br/>ДебКолКон',
        'КредитКон<br/>КредКолКон',
    ];

    public $perPage = 50; // Количество строк на странице
    public $source = 'model'; // Источник данных: 'file' или 'model'

    public function updating($name, $value)
    {
        if ($name === 'perPage') {
            $this->resetPage(); // Сбрасываем страницу при изменении количества записей
        }
    }

    public function render()
    {
        $data = $this->source === 'file'
            ? $this->loadFromFile()
            : $this->loadFromModel();

        return view('livewire.svo.fin-data-table', compact('data'));
    }

    private function loadFromFile()
    {
        $filePath = 'svo/IMOCB.csv';

        if (!\Storage::exists($filePath)) {
            return collect(); // Возвращаем пустую коллекцию, если файл отсутствует
        }

        $file = iconv('windows-1251', 'utf-8', \Storage::get($filePath));
        $lines = explode("\n", $file);

        $data = collect($lines)
            ->map(fn($line) => explode(';', trim($line)))
            ->filter(fn($row) => count($row) >= count($this->data_head))
            ->skip(($this->page - 1) * $this->perPage) // Пропускаем записи для текущей страницы
            ->take($this->perPage);

        return $data->map(fn($row) => (object) $row); // Приводим к объекту для единообразия
    }

    private function loadFromModel()
    {
        return FinReport::paginate($this->perPage);
    }
}
