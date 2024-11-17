<?php

namespace App\Livewire\Svo;

use App\Models\ShopItem;
use App\Models\ShopPhoto;
use App\TDO\ShopCsvDataTdo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use PHPUnit\Framework\Exception;

class Shop extends Component
{

    use WithPagination;

//    protected $paginationTheme = 'tailwind';

//    public $data_head = [];
    public $data;
    public $search = '';
    public $search_not_empty = true;
    public $data_all;
    public $firms;

    public function mount()
    {

        $this->firms =
        $firms = ShopItem::select('firma')  // Указываем нужное поле
            ->distinct()      // Только уникальные значения
            ->orderBy('firma') // Можно отсортировать
            ->get();

//        $this->importCsvData();

////        $filePath = 'IMPot.csv';
//        $filePath = 'Dobro.csv';
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
//                }else{
//                    $this->data[] = explode(';', $line);
//                }
//            }
//        }
    }


    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Разделяем поисковый запрос на слова
        $keywords = explode(' ', trim($this->search));

        // Формируем регулярное выражение для поиска
        $searchPattern = implode('.*', array_map(function($keyword) {
            return preg_quote($keyword, '/');
        }, $keywords));

        // Выполняем запрос с регулярным выражением
        $data = ShopItem::with('photos')
            ->where('naimenovanie', 'REGEXP', $searchPattern)
            ->orWhere('dobavka', 'REGEXP', $searchPattern)
            ->paginate(10);

        // Проверяем, есть ли результаты поиска
        $this->search_not_empty = $data->isNotEmpty();

        return view('livewire.svo.shop', ['data1' => $data])
            ->with('paginationView', 'svo.shop-pagination');
    }
}
