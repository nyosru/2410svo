<?php

namespace App\Livewire\Svo;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class TrebsDataTable extends Component
{
    public $data_head = [];
    public $data = [];

    public function mount()
    {
        $filePath = 'IMPot.csv';
        $filePath1 = 'svo/'.$filePath;
        // Проверка, существует ли файл
        if (Storage::exists($filePath1)) {
            $file = Storage::get($filePath1);
            $file = iconv('windows-1251', 'utf-8', $file);
//            dd( Storage::path($file ) );
            $lines = explode("\n", $file);

            // Чтение строк файла и преобразование их в массив
            foreach ($lines as $line) {
                if( empty($this->data_head)) {
//                $this->data[] = str_getcsv($line);
                    $this->data_head = explode(';', $line);
                }else{
                    $this->data[] = explode(';', $line);
                }
            }
        }
    }

    public function render()
    {
//        $filePath = 'svo/IMPot.csv';
//        $file = Storage::get($filePath);
//        dd( Storage::path($filePath ) );

        return view('livewire.svo.trebs-data-table');
    }
}
