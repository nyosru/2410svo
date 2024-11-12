<?php

namespace App\Http\Controllers\Svo;

use App\Http\Controllers\Controller;
use App\Models\ShopItem;
use App\Models\ShopPhoto;
use App\TDO\ShopCsvDataTdo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ShopScanDatafileController extends Controller
{

    public $csvFile = 'svo/Dobro.csv';

    /**
     * Импорт данных из CSV файла в базу данных
     */
    public function scan(Request $request)
    {
        $return = [
            'line_to_db' => 0
        ];
        $filePath = $this->csvFile;

        if (Storage::exists($filePath)) {
            $fileContent = iconv('windows-1251', 'utf-8', Storage::get($filePath));
            $lines = array_filter(explode("\n", $fileContent));

            $return['file_have_line'] = count($lines);

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

                $return['line_to_db'] ++;

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
        return response()->json($return);
    }
}
