<?php

namespace App\Http\Controllers\Svo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\StringController;
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
    // заголовки столбцов
    static public $header = [];
    static public $now_up_id = [];

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
                    self::$header = explode(';', $line);

                    // Применение транслитерации к каждому элементу заголовков
                    foreach (self::$header as &$headerElement) {
                        $headerElement = StringController::transliterate($headerElement);
                    }

                    $nn++;
                    continue;
                }

                try {
                    // Создаем объект TDO для обработки данных
                    if ($type == 'shop') {
                        $columns = explode(';', $line);
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
                        $data = self::prepareDataTrebs($line);
//                        dd($data);
//                        dd($columns);
                        $tdo = new TrebsCsvDataTdo($data['data']);
//                        dd($tdo);
//                        dd($tdo->toArray());

                        if ($tdo->uroven == 2) {
                            $tdo->setUpId(self::$now_up_id[1]);
//                            dd($tdo);
                        } elseif ($tdo->uroven == 3) {
                            $tdo->setUpId(self::$now_up_id[2]);
                        } elseif ($tdo->uroven == 4) {
                            $tdo->setUpId(self::$now_up_id[3]);
                        }

                        $item = SvoTrebItem::create($tdo->toArray());

                        if ($item->uroven == 1) {
                            self::$now_up_id = [1 => $item->id];
                        } elseif ($item->uroven == 2) {
                            self::$now_up_id[2] = $item->id;
//                            dd($item);
                        } elseif ($item->uroven == 3) {
                            self::$now_up_id[3] = $item->id;
                        }

//                        dd($tdo);
//                        dd($item);
                    }

                    $return['line_to_db']++;
                } catch
                (Exception $exp) {
                    $return['exp'][] = $exp;
                }
            }
        }
//        return response()->json($return);
        return $return;
    }

    /**
     * подготовка данных для добавления в дто Требы
     * @param String $line
     * @return Array
     * header\in\data
     */
    static public function prepareDataTrebs(string $line): array
    {
        $return = [];
        $return['header'] = self::$header;
        $return['in'] =
        $columns = explode(';', $line);
        $return['data'] = [];
        foreach ($columns as $k => $v) {
            $return['data'][self::$header[$k]] = $v;
        }

        return $return;
    }

}
