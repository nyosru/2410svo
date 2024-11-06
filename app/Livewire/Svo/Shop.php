<?php

namespace App\Livewire\Svo;

use App\Models\ShopItem;
use App\Models\ShopPhoto;
use App\TDO\ShopCsvDataTdo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PHPUnit\Framework\Exception;

class Shop extends Component
{

//    public $data_head = [];
    public $data;
    public $csvFile = 'svo/Dobro.csv';

    public function mount()
    {
        $this->importCsvData();

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


    /**
     * Импорт данных из CSV файла в базу данных
     */
    public function importCsvData()
    {
        $filePath = $this->csvFile;

        if (Storage::exists($filePath)) {
            $fileContent = iconv('windows-1251', 'utf-8', Storage::get($filePath));
            $lines = array_filter(explode("\n", $fileContent));

            // Извлекаем заголовки и данные
//            $this->data_head = explode(';', array_shift($lines));

            if (!empty($lines)) {
                // Очищаем таблицу перед импортом новых данных
                Schema::disableForeignKeyConstraints();
                ShopItem::truncate();
                ShopPhoto::truncate();
                Schema::enableForeignKeyConstraints();

                // Переименование файла после успешного импорта
                if (1 == 2) {
                    $currentDateTime = now()->format('Y-m-d_H-i-s');
                    $newFileName = pathinfo($filePath, PATHINFO_FILENAME) . "_$currentDateTime.csv";
                    $newFilePath = 'svo/' . $newFileName;
                    Storage::move($filePath, $newFilePath);
                }
            }

            $nn = 0;

            foreach ($lines as $line) {

                if ($nn == 0) {
                    $nn++;
                    continue;
                }

                try {
                    $columns = explode(';', $line);
                    // Создаем объект TDO для обработки данных
                    $tdo = new ShopCsvDataTdo($columns);
                    $shopItem = ShopItem::create($tdo->toArray());

                    // Если есть фотографии, добавляем их
                    if (!empty($tdo->photo)) {
                        $photos = explode('+', $tdo->photo);
                        foreach ($photos as $photoUrl) {
                            if (!empty($photoUrl)) {
                                ShopPhoto::create([
                                    'shop_item_id' => $shopItem->id,
                                    'photo_url' => trim($photoUrl),
                                ]);
                            }
                        }
                    }
                } catch (Exception $exp) {
                }
            }
        }
    }

    public function render()
    {
//        $e = ShopItem::with('photos')->all();
        $e = ShopItem::with('photos')->get();
//        $this->data = $e->toArray();
        $this->data = $e;

        return view('livewire.svo.shop');
    }
}
