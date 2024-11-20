<?php

namespace App\Livewire\Svo;

use App\Http\Controllers\Svo\ShopScanDatafileController;
use App\Models\Photo;
use App\Models\ShopPhoto;
use App\Models\SvoTrebItem;
use App\Models\TrebsPhoto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;


class DataScan extends Component
{
    use WithFileUploads;

    public $type_file;
    public $uploadedFile1;
    public $uploadedImages = [];  // Для хранения нескольких изображений
    public $scanResult;
    public $shopPhotosWithoutPhotos;
    public $listFiles = [];
    public $listRealFilesInDb = [];
    public $filesNoInDb = [];
    public $sizeNoFiles = 0;


    public function mount(): void
    {
        $this->checkNoFiles();
        $this->checkOffFiles();
    }


    /**
     * получаем список ссылок на реальные в файлы в бд
     * @return mixed
     */
    public function checkFiles()
    {

        $t1 = Photo::whereNotNull('image_loaded')->whereNotNull('preview_loaded')->pluck('preview_loaded');
        $t = Photo::whereNotNull('image_loaded')->whereNotNull('preview_loaded')->pluck('image_loaded');

        // Объединяем результаты и удаляем повторы
        $res = $t1->merge($t)
//            ->merge($svoTrebQrPhotos)
            ->unique()
            ->sort()
            ->filter(function ($value) {
                return is_string($value); // Оставляем только строки
            })
            ->values() // Преобразуем в индексированный массив
            ->toArray(); // Преобразуем коллекцию в массив

        $this->listFiles = array_map(function ($f) {
            return basename($f);
        }, $res);

//        return $res2;
    }

    public function checkNoFiles(): array
    {
//        $this->listFiles = [];
//        return;

        // Получаем уникальные названия файлов из ShopPhoto
        $shopPhotos = ShopPhoto::doesntHave('photoLoaded')
            ->select('photo_url')
            ->distinct()
            ->pluck('photo_url');

        // Получаем уникальные названия файлов из SvoTrebItem
        $svoTrebPhotos = TrebsPhoto::doesntHave('photoLoaded')
            ->select('photo_url')
            ->distinct()
            ->pluck('photo_url');

        // Получаем уникальные названия файлов из SvoTrebItem
        $svoTrebQrPhotos = SvoTrebItem::doesntHave('qrLoaded')
            ->select('curica')
            ->distinct()
            ->pluck('curica');

        // Объединяем результаты и удаляем повторы
        $this->shopPhotosWithoutPhotos = $shopPhotos->merge($svoTrebPhotos)
            ->merge($svoTrebQrPhotos)
            ->unique()
            ->sort()
            ->filter(function ($value) {
                return is_string($value); // Оставляем только строки
            })
            ->values() // Преобразуем в индексированный массив
            ->toArray(); // Преобразуем коллекцию в массив

//        dd($this->shopPhotosWithoutPhotos->toArray());

        return $this->shopPhotosWithoutPhotos;
    }

    public function listAllFiles(): array
    {
        $this->listFiles = [];
//        return;

        // Получаем уникальные названия файлов из ShopPhoto
        $shopPhotos = ShopPhoto::select('photo_url')
            ->distinct()
            ->pluck('photo_url');

        // Получаем уникальные названия файлов из SvoTrebItem
        $svoTrebPhotos = TrebsPhoto::select('photo_url')
            ->distinct()
            ->pluck('photo_url');

        // Получаем уникальные названия файлов из SvoTrebItem
        $svoTrebQrPhotos = SvoTrebItem::select('curica')
            ->distinct()
            ->pluck('curica');

        // Объединяем результаты и удаляем повторы
        $this->listFiles = $shopPhotos->merge($svoTrebPhotos)
            ->merge($svoTrebQrPhotos)
            ->unique()
            ->sort()
            ->filter(function ($value) {
                return is_string($value); // Оставляем только строки
            })
            ->values() // Преобразуем в индексированный массив
            ->toArray(); // Преобразуем коллекцию в массив

//        dd($this->shopPhotosWithoutPhotos->toArray());

        return $this->listFiles;
    }


    public function listRealFilesInDb(): array
    {
        $this->listRealFilesInDb = [];
//        return;

        // Получаем уникальные названия файлов из ShopPhoto
        $shopPhotos = Photo::select('image_loaded')
            ->distinct()
            ->pluck('image_loaded');
        $shopPhotos2 = Photo::select('preview_loaded')
            ->distinct()
            ->pluck('preview_loaded');

//        // Получаем уникальные названия файлов из SvoTrebItem
//        $svoTrebPhotos = TrebsPhoto::select('photo_url')
//            ->distinct()
//            ->pluck('photo_url');
//
//        // Получаем уникальные названия файлов из SvoTrebItem
//        $svoTrebQrPhotos = SvoTrebItem::select('curica')
//            ->distinct()
//            ->pluck('curica');

        // Объединяем результаты и удаляем повторы
        $this->listRealFilesInDb = $shopPhotos->merge($shopPhotos2)
//            ->merge($svoTrebQrPhotos)
            ->unique()
            ->sort()
            ->filter(function ($value) {
                return is_string($value); // Оставляем только строки
            })
            ->values() // Преобразуем в индексированный массив
            ->toArray(); // Преобразуем коллекцию в массив

//        dd($this->shopPhotosWithoutPhotos->toArray());

        return $this->listRealFilesInDb;
    }


    public function scanFile()
    {
        // Валидация для основного файла
//        $this->validate([
//            'type_file' => 'required',
//            'uploadedFile1' => 'required|file',
//        ]);

        // Сохранение файла в зависимости от выбранного типа
        try {
            if ($this->type_file == 'shop') {
                $savedFile = $this->uploadedFile1->storeAs('svo', 'Dobro.csv');
            } elseif ($this->type_file == 'trebs') {
                $savedFile = $this->uploadedFile1->storeAs('svo', 'Trebs.csv');
            } elseif ($this->type_file == 'fin') {
                $savedFile = $this->uploadedFile1->storeAs('svo', 'IMOCB.csv');
            }

            // Вызов сканирования и сохранение результата
            $this->scanResult = (array)ShopScanDatafileController::scan($savedFile, $this->type_file);
//dd($this->scanResult);
            $this->checkNoFiles();

            session()->flash('message', 'Файл успешно сканирован!');
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка при сканировании файла: ' . $e->getMessage());
        }
        return;
    }


    /**
     * Собираем массив из файлов, что лежат на сервере и не используются на сайте (из папки storage/app/public/images).
     * Также вычисляем общий размер файлов, отсутствующих в БД.
     *
     * @return array
     */
    public function checkOffFiles(): array
    {
        // Получить файлы из папки /storage/app/public/images
        $folderFiles = Storage::disk('public')->files('images');

        // Убираем путь `public/images/`, оставляем только имена файлов
        $folderFileNames = array_map(function ($f) {
            return basename($f);
        }, $folderFiles);
//dd($folderFileNames);
        // Получаем список файлов из базы
//        $databaseFiles = $this->listAllFiles('real_all');
        $databaseFiles = $this->listRealFilesInDb();
        $databaseFilesNames = array_map(function ($f) {
            return basename($f);
        }, $databaseFiles);
//dd($databaseFilesNames );

        // Находим файлы в папке, которых нет в базе
        $list = array_diff($folderFileNames, $databaseFilesNames);
        $this->filesNoInDb = array_values($list);

        // Рассчитываем общий размер файлов, отсутствующих в БД
        $this->sizeNoFiles = array_reduce(
            $this->filesNoInDb,
            function ($carry, $file) {
                // Проверяем размер файла через Storage
                return $carry + Storage::disk('public')->size("images/{$file}");
            },
            0 // Начальное значение суммы
        );

        $this->sizeNoFiles = round($this->sizeNoFiles / 1024 / 1024, 2);

        \Log::info('Файлы в папке, которых нет в БД:', [
            'missingInDb' => $this->filesNoInDb,
            'totalSize' => $this->sizeNoFiles
        ]);

        return $this->filesNoInDb; // Возвращаем массив с отсутствующими файлами
    }


    public function uploadImages()
    {
        // Валидация изображений
//        $this->validate([
//            'uploadedImages' => 'required|array|min:1',  // Минимум одно изображение
//            'uploadedImages.*' => 'image|max:5024',       // Ограничение для изображений
//        ]);

        try {
            $saved = '';

            foreach ($this->uploadedImages as $image) {
                // Получаем оригинальное имя файла
                $originalFileName = $image->getClientOriginalName();

                // Получаем расширение файла
                $fileExtension = $image->getClientOriginalExtension();

                // Логируем каждое изображение перед загрузкой
                \Log::info('Загружается изображение: ', ['image' => $originalFileName]);

                // Сохраняем изображение в публичной папке 'images' и получаем имя файла
//                $imageName = $image->storeAs('images', $originalFileName, 'public');

                if (in_array($originalFileName, $this->listAllFiles())) {
//                    $imageName = $image->store('images', 'public');
                    $imageName = $image->storeAs(
                        'images',
                        date('Ymd_HIs') . '.' . rand() . '.' . $fileExtension,
                        'public'
                    );
//                    \Log::info('111', ['$imageName' => $imageName]);

                    $previewCreated = $this->createPreview($imageName);

//                    \Log::info('$previewCreated', $previewCreated);

                    if (($previewCreated['result'])) {
                        $previewPath = 'storage/images/' . $previewCreated['preview_name'];
                        $previewUrl = asset($previewPath);
                    }

                    \Log::info('$previewCreated', ['$previewCreated' => $previewCreated]);

                    // Обновить или создать запись в photo
                    Photo::updateOrCreate(
                        ['image' => $originalFileName], // Условие поиска
                        [
                            'image_loaded' => '/storage/' . $imageName, // Поля для обновления
                            'preview_loaded' => '/' . $previewPath
                        ]
                    );

                    $saved .= $originalFileName . ' <img src="' . $previewUrl . '" class="w-[100px]" /> ';
                } else {
                    \Log::info('не нашли ', ['line' => __LINE__]);
                }
            }

            session()->flash('message', 'Картинки успешно загружены! (time:' . time() . ') файлы: ' . $saved);
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Ошибка при загрузке изображений: ', ['exception' => $e->getMessage()]);

            session()->flash('error', 'Ошибка при загрузке картинок: ' . $e->getMessage());
        }
        $this->checkNoFiles();
    }

    public function render()
    {
        return view('livewire.svo.data-scan');
    }


    public function createPreview($imageName)
    {
        $return = [
            'result' => false,
            'preview_name' => ''
        ];

        \Log::info('start fn createPreview', [__LINE__, $imageName]);

        try {
            // Обрезаем путь, если он начинается с /storage/
            $imageName = str_replace('/storage/', '', $imageName);

            $originalFile = storage_path('app/public/' . $imageName);
            $baseName = pathinfo($originalFile, PATHINFO_FILENAME);
            $extension = pathinfo($originalFile, PATHINFO_EXTENSION);
            $return['preview_name'] =
            $previewName = $baseName . '.prev200.' . $extension;
            $previewPath = storage_path('app/public/images/' . $previewName);

            \Log::info('fn createPreview originalFile', [$originalFile]);
            \Log::info('fn createPreview previewPath', [$previewPath]);

            // Проверяем существование файла
            if (!file_exists($originalFile)) {
                throw new \Exception("Файл не найден: $originalFile");
            }

            // Проверяем MIME-тип
            $mimeType = mime_content_type($originalFile);
//            if (!in_array($mimeType, ['image/jpeg', 'image/png'])) {
            if (!in_array($mimeType, ['image/jpeg'])) {
                throw new \Exception("Неподдерживаемый формат файла: $mimeType");
            }

            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($originalFile);

            $originalSize = $image->getSize();
            $width = 200;
            $height = (int)($originalSize->getHeight() * ($width / $originalSize->getWidth()));

            $size = new \Imagine\Image\Box($width, $height);
            $image->resize($size, \Imagine\Image\ImageInterface::FILTER_LANCZOS);

            $image->save($previewPath, [
                'jpeg_quality' => 85,
                'format' => 'jpeg',
            ]);

            \Log::info('Превью успешно создано', ['previewPath' => $previewPath]);

            $return['result'] = true;
        } catch (\Exception $e) {
            \Log::error('Ошибка при создании превью: ' . $e->getMessage(), ['line' => __LINE__]);
        }

        return $return;
    }


}
