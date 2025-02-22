<?php

namespace App\Http\Controllers\Svo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\StringController;
use App\Models\FinReport;
use App\Models\ShopItem;
use App\Models\ShopPhoto;
use App\Models\SvoContact;
use App\Models\SvoTrebItem;
use App\Models\TrebsPhoto;

use App\TDO\FinReportTDO;
use App\TDO\ShopCsvDataTdo;
use App\TDO\SvoContactTDO;
use App\TDO\TrebsCsvDataTdo;
use App\DTO\SvoContactDTO;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * @return array
     */

//    static public function scan($file = '', $type = ''): Array
    static public function scan($file = '', $type = '')
    {
        $return = [
            'input_file' => $file,
            'type' => $type,
            'line_to_db' => 0,
            't' => time(),
            'exp' => []
        ];

        if (Storage::exists($file)) {

            setlocale(LC_ALL, 'ru_RU.UTF-8');

            $content0 = Storage::get($file);
//            $content = iconv('windows-1251', 'utf-8', $content);
            $content = mb_convert_encoding($content0, "UTF-8", "WINDOWS-1251");
            $content0 = '';
            $lines = array_filter(explode("\n", $content));
            $return['file_have_line'] = count($lines);
        }

//        return $return;


//
//
////        $filePath = self::$csvFile;
//        $filePath = $file;
//        $return['file'] = $filePath;
//        $return['file_puth'] = Storage::path($filePath);
//        $return['file_e'] = Storage::exists($filePath);
//
////        dd($return);
//
//
//            // Извлекаем заголовки и данные
//            $data_head = explode(';', array_shift($lines));
//
            if (!empty($lines)) {
//                // Очищаем таблицу перед импортом новых данных
//
                Schema::disableForeignKeyConstraints();
                if ($type == 'shop') {
                    ShopItem::truncate();
                    ShopPhoto::truncate();
                } elseif ($type == 'trebs') {
                    SvoTrebItem::truncate();
                    TrebsPhoto::truncate();
                } elseif ($type == 'contact') {
                    SvoContact::truncate();
                } elseif ($type == 'fin') {
                    FinReport::truncate();
                }
                Schema::enableForeignKeyConstraints();
//
//
//        // Переименование файла после успешного импорта
//        if (1 == 2) {
//            $currentDateTime = now()->format('Y-m-d_H-i-s');
//            $newFileName = pathinfo($filePath, PATHINFO_FILENAME) . "_$currentDateTime.csv";
//            $newFilePath = 'svo/' . $newFileName;
//            Storage::move($filePath, $newFilePath);
//        }
////            }
//
                $nn = 0;

                foreach ($lines as $line) {
                    $return['colvo_separator'][] = $line;
                    $return['colvo_separator'][] = substr_count($line, ';');

                    // тащим заголовки
                    if ($nn == 0) {
                        self::$header = explode(';', $line);
//                self::$header = str_getcsv($line);

                        // Применение транслитерации к каждому элементу заголовков
                        foreach (self::$header as &$headerElement) {
                            $headerElement = Str::snake(StringController::transliterate($headerElement));
                        }
//                    dd(self::$header);
                        $return['header'] = self::$header;

                        $nn++;
                        continue;
                    }
//                dd(self::$header);

                    try {
                        // Создаем объект TDO для обработки данных
                        if ($type == 'shop') {
//                    if(1==2) {
                            $return['columns'] =
                            $columns = self::prepareDataShop($line, self::$header);
//                    }

//                        dd($columns);
                            if (1 == 1) {
                                $tdo = new ShopCsvDataTdo($columns['data']);

                                $shopItem = ShopItem::create($tdo->toArray());

                                // Если есть фотографии, добавляем их
                                if (!empty($tdo->foto)) {
                                    $photos = explode('+', $tdo->foto);
                                    foreach ($photos as $photoUrl) {
                                        if (!empty($photoUrl)) {
                                            ShopPhoto::create([
                                                'shop_item_id' => $shopItem->id,
                                                'photo_url' => trim($photoUrl),
                                            ]);
                                        }
                                    }
                                }
                            } //

                        } //
                        elseif ($type == 'contact') {
//
                            $data = self::prepareDataContact($line);
//                        dd($data);
                            $tdo = new SvoContactTDO($data['data']);
                            $item = SvoContact::create($tdo->toArray());
//
//                    } elseif ($type == 'fin') {
//                        $data = self::prepareDataFinOtchet($line);
//                        $tdo = new FinReportTDO($data['data']);
//                        $item = FinReport::create($tdo->toArray());
////                        dd($data);
//
                        } //
                        elseif ($type == 'trebs') {
                            $data = self::prepareDataTrebs($line);
//                        dd($data);
                            $tdo = new TrebsCsvDataTdo($data['data']);

//                        if( $data['data']['uroven'] == 2 )
//                            dd([$data,$tdo]);

                            if ($tdo->uroven == 2) {
                                $tdo->setUpId(self::$now_up_id[1]);
                            } elseif ($tdo->uroven == 3) {
                                $tdo->setUpId(self::$now_up_id[2]);
                            } elseif ($tdo->uroven == 4) {
                                $tdo->setUpId(self::$now_up_id[3]);
                            }

                            $item = SvoTrebItem::create($tdo->toArray());

//                    dd(__LINE__);


                            // Если есть фотографии, добавляем их
                            if (!empty($tdo->photo)) {
//                            dd($tdo->photo);
                                $photos = explode('+', $tdo->photo);
//                            dd($photos);
                                foreach ($photos as $photoUrl) {
                                    if (!empty($photoUrl)) {
                                        TrebsPhoto::create([
                                            'svo_trebs_item_id' => $item->id,
                                            'photo_url' => trim($photoUrl),
                                        ]);
                                    }
                                }
                            }

                            if ($item->uroven == 1) {
                                self::$now_up_id = [1 => $item->id];
                            } elseif ($item->uroven == 2) {
                                self::$now_up_id[2] = $item->id;
                            } elseif ($item->uroven == 3) {
                                self::$now_up_id[3] = $item->id;
                            }
                        }
////                    dd(__LINE__);
                        $return['line_to_db']++;
                    } //
                    catch (Exception $exp) {
                        $return['exp'][] = $exp;
                        dd($exp);
                    }
                }
            }
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

    /**
     * подготовка данных для добавления в дто shop
     * @param String $line
     * @return Array
     * header\in\data
     */
    static public function prepareDataShop(string $line, array $header): array
    {

        $return = ['data' => []];
        $return['in'] =
        $columns = explode(';', $line);

//        $columns2 = str_getcsv($line);
//        dd([$columns,$columns2]);

        foreach ($columns as $k => $v) {

            $v = trim($v);

            if (isset($header[$k])) {

                if (
                    $header[$k] == 'tsena1' ||
                    $header[$k] == 'tsena2' ||
                    $header[$k] == 'tsena3') {
                    $return['data'][$header[$k]] = round((float)$v, 2);
                } elseif ($header[$k] == 'deb_kol_kon') {
                    $return['data'][$header[$k]] = round((float)$v, 0);
                } else {
                    $return['data'][$header[$k]] = $v;
                }
            }
        }

//        dd($return['data']);

        return $return;
    }

    /**
     * подготовка данных для добавления в дто фин отчёты
     * @param String $line
     * @return Array
     * header\in\data
     */
    static public function prepareDataFinOtchet(string $line): array
    {
        $return = [];
        $return['header'] = self::$header;
        $return['in'] =
        $columns = explode(';', $line);
        $return['data'] = [];
        foreach ($columns as $k => $v) {
            if (self::$header[$k] == "debet_nach" ||
                self::$header[$k] == "kredit_nach" ||
                self::$header[$k] == "debet" ||
                self::$header[$k] == "kredit" ||
                self::$header[$k] == "debet_kon" ||
                self::$header[$k] == "kredit_kon" ||
                self::$header[$k] == "deb_kol_nach" ||
                self::$header[$k] == "kred_kol_nach" ||
                self::$header[$k] == "deb_kol" ||
                self::$header[$k] == "kred_kol" ||
                self::$header[$k] == "deb_kol_kon" ||
                self::$header[$k] == "kred_kol_kon"
            ) {
                $return['data'][self::$header[$k]] = round((float)trim($v), 2);
            } else {
                $return['data'][self::$header[$k]] = trim($v);
            }
        }

        return $return;
    }

    /**
     * подготовка данных для добавления в дто фин отчёты
     * @param String $line
     * @return Array
     * header\in\data
     */
    static public function prepareDataContact(string $line): array
    {
        $return = [];
        $return['header'] = self::$header;
        $return['in'] =
        $columns = explode(';', $line);
        $return['data'] = [];
        foreach ($columns as $k => $v) {
//            if (self::$header[$k] == "debet_nach" ||
//                self::$header[$k] == "kredit_nach" ||
//                self::$header[$k] == "debet" ||
//                self::$header[$k] == "kredit" ||
//                self::$header[$k] == "debet_kon" ||
//                self::$header[$k] == "kredit_kon" ||
//                self::$header[$k] == "deb_kol_nach" ||
//                self::$header[$k] == "kred_kol_nach" ||
//                self::$header[$k] == "deb_kol" ||
//                self::$header[$k] == "kred_kol" ||
//                self::$header[$k] == "deb_kol_kon" ||
//                self::$header[$k] == "kred_kol_kon"
//            ) {
//                $return['data'][self::$header[$k]] = round((float)trim($v), 2);
//            } else {
            $return['data'][self::$header[$k]] = trim($v);
//            }
        }

        return $return;
    }

}
