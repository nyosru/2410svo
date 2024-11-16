<?php

namespace App\Livewire\Svo;

use App\Models\SvoTrebItem;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class TrebsDataTable extends Component
{

    public $data_head = [
//        'Уровень',
        'Фирма',
        'Затея',
//        'МОЛ',
//        'МОЛ ссылка',
//        'МОЛ телефон',

//        'ЗначениеДок',
//        'НомСтр',
        'Наименование<br/>Комент',
        'МОЛ',
//        'Добавка',
//        'Курица',
//        'СайтТаб',
//        'Фото',
        'ДебетКон',
        'КредитКон',
        'ДебКолКон',
        'КредКолКон'
    ];
    public $data = [];

    public $loading_details = [];


    public function mount()
    {
//        $this->data = SvoTrebItem::query()
//            ->whereUroven(1)
//            ->withCount('children') // Подсчёт связанных записей
//            ->get()
//            ->toArray();

//        $filePath = 'IMPot.csv';
//        $filePath1 = 'svo/'.$filePath;
//        // Проверка, существует ли файл
//        if (Storage::exists($filePath1)) {
//            $file = Storage::get($filePath1);
//            $file = iconv('windows-1251', 'utf-8', $file);
////            dd( Storage::path($file ) );
//            $lines = explode("\n", $file);
//
//            // Чтение строк файла и преобразование их в массив
//            foreach ($lines as $line) {
//                if( empty($this->data_head)) {
////                $this->data[] = str_getcsv($line);
//                    $this->data_head = explode(';', $line);
//                    break;
//                }else{
//                    $this->data[] = explode(';', $line);
//                }
//            }
//
//            $this->data = SvoTrebItem::all();
////            $this->data = $t->get();
//
//        }
    }


    public function toggleVisibility($index)
    {
        $this->expanded[$index] = !$this->expanded[$index]; // Переключаем состояние
    }

    public function render()
    {
//        $filePath = 'svo/IMPot.csv';
//        $file = Storage::get($filePath);
//        dd( Storage::path($filePath ) );

        return view('livewire.svo.trebs-data-table');
    }
}
