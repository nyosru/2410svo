<?php

namespace App\Http\Controllers\Svo;

use App\Http\Controllers\Controller;
use App\Models\ShopItem;
use App\Models\ShopPhoto;
use App\Models\SvoTrebItem;
use App\TDO\ShopCsvDataTdo;
use App\TDO\TrebsCsvDataTdo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ShopScanDatafileController extends Controller
{

    static public $csvFile = 'svo/Dobro.csv';

    /**
     * Импорт данных из CSV файла в базу данных
     * @param $file
     * @param $type
     * @param Request $request
     * @return Array
     */

    static public function scan($file = '', $type = ''): array
    {
        $return = [
            'input_file' => $file,
            'type' => $type,
            'line_to_db' => 0,
            't' => time(),
            'exp' => []
        ];
//        $filePath = self::$csvFile;
        $filePath = $file;
        $return['file'] = $filePath;
        $return['file_puth'] = Storage::path($filePath);
        $return['file_e'] = Storage::exists($filePath);

//        dd($return);

        if (Storage::exists($filePath)) {
            $fileContent = iconv('windows-1251', 'utf-8', Storage::get($filePath));
            $lines = array_filter(explode("\n", $fileContent));
            $return['file_have_line'] = count($lines);

            // Извлекаем заголовки и данные
//            $this->data_head = explode(';', array_shift($lines));

            if (!empty($lines)) {
                // Очищаем таблицу перед импортом новых данных

                if ($type == 'shop') {
                    Schema::disableForeignKeyConstraints();
                    ShopItem::truncate();
                    ShopPhoto::truncate();
                    Schema::enableForeignKeyConstraints();
                } elseif ($type == 'trebs') {
                    SvoTrebItem::truncate();
                }


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
                    if ($type == 'shop') {
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
                    } elseif ($type == 'trebs') {
//                        dd($columns);
                        $tdo = new TrebsCsvDataTdo($columns);
//                        dd($tdo);
//                        dd($tdo->toArray());
                        $item = SvoTrebItem::create($tdo->toArray());
//                        dd($tdo);
//                        dd($item);
                    }

                    $return['line_to_db']++;

                } catch (Exception $exp) {
                    $return['exp'][] = $exp;
                }
            }
        }
//        return response()->json($return);
        return $return;
    }
}
