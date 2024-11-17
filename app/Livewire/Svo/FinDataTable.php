<?php

namespace App\Livewire\Svo;

use App\Models\FinReport;
use Livewire\Component;
use Livewire\WithPagination;

class FinDataTable extends Component
{
    use WithPagination;

    public $search = ''; // Добавляем свойство для хранения текста поиска
    public $data; // Добавляем свойство для хранения текста поиска

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

//    public $source = 'model'; // Источник данных: 'file' или 'model'


    public function updatedSearch()
    {
        // Перезагружаем данные при изменении значения поиска
//        $this->loadData();
        $this->resetPage();
    }

    public function updating($name, $value)
    {
        if ($name === 'perPage') {
            $this->resetPage(); // Сбрасываем страницу при изменении количества записей
        }
    }

//    public function mount()
//    {
//        $this->loadData();
//    }


    public function loadData()
    {
//        $this->data = $this->source === 'file'
//            ? $this->loadFromFile()
//            : $this->loadFromModel();
//        if (!empty($this->search)) {
//        $this->data = FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->paginate($this->perPage);

        $this->data = FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->limit(100);
//        $this->data = FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->paginate($this->perPage);

//        } else {
//            $this->data = FinReport::paginate($this->perPage);
//        }
//        $this->data = FinReport::limit(50)->get();
    }

    public function render()
    {
//        dd($this->data->items());

        return view(
            'livewire.svo.fin-data-table'
            , [
//                'data' => FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->limit(100)
//                'data' => FinReport::paginate($this->perPage)

                'data0' => FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->paginate($this->perPage),

////                'data' => !empty($this->search) ? FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->paginate($this->perPage) : FinReport::get()->paginate($this->perPage)
//                'data' => FinReport::where('naimenovanie', 'like', '%' . $this->search . '%')->paginate($this->perPage)
////                'data0' => $this->data->items(), // Отправляем только элементы коллекции
//                'pagination' => $this->data, // Для пагинации
            ]
        )->with('paginationView', 'svo.shop-pagination');
    }

//    private function loadFromFile()
//    {
//        $filePath = 'svo/IMOCB.csv';
//
//        if (!\Storage::exists($filePath)) {
//            return collect(); // Возвращаем пустую коллекцию, если файл отсутствует
//        }
//
//        $file = iconv('windows-1251', 'utf-8', \Storage::get($filePath));
//        $lines = explode("\n", $file);
//
//        $data = collect($lines)
//            ->map(fn($line) => explode(';', trim($line)))
//            ->filter(fn($row) => count($row) >= count($this->data_head))
//            ->skip(($this->page - 1) * $this->perPage) // Пропускаем записи для текущей страницы
//            ->take($this->perPage);
//
//        return $data->map(fn($row) => (object)$row); // Приводим к объекту для единообразия
//    }

}
