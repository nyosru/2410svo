<?php

namespace App\Livewire\Svo;

use App\Http\Controllers\Svo\ShopScanDatafileController;
use App\Models\Photo;
use App\Models\ShopPhoto;
use App\Models\SvoTrebItem;
use App\Models\TrebsPhoto;
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


    public function mount()
    {
        $this->checkNoFiles();
    }




    public function checkNoFiles()
    {
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

        // Объединяем результаты и удаляем повторы
        $this->shopPhotosWithoutPhotos = $shopPhotos->merge($svoTrebPhotos)
            ->unique()
            ->sort()
            ->values(); // Преобразуем в индексированный массив
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
        return ;
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

                // Логируем каждое изображение перед загрузкой
                \Log::info('Загружается изображение: ', ['image' => $originalFileName]);

                // Сохраняем изображение в публичной папке 'images' и получаем имя файла
//                $imageName = $image->storeAs('images', $originalFileName, 'public');

                $save = false;

                try {
                    ShopPhoto::where('photo_url', $originalFileName)->firstOrFail();
                    $save = true;
                    \Log::info('нашли ', ['line' => __LINE__ ]);
                } catch (\Exception $ex) {
                }

                if (!$save) {
                    try {
                        TrebsPhoto::where('photo_url', $originalFileName)->firstOrFail();
                        $save = true;
                        \Log::info('нашли ', ['line' => __LINE__ ]);
                    } catch (\Exception $ex) {
                    }
                }

                if (!$save) {
                    try {
                        SvoTrebItem::where('curica', $originalFileName)->firstOrFail();
                        $save = true;
                        \Log::info('нашли ', ['line' => __LINE__ ]);
                    } catch (\Exception $ex) {
                    }
                }

                if ($save) {

                    $imageName = $image->store('images', 'public');

                    // Генерация имени для превью
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
                    $baseName = pathinfo($imageName, PATHINFO_FILENAME);
                    $previewName = $baseName . '.prev200.' . $extension;
                    $previewPath = 'images/' . $previewName;
                    $previewCreated = $this->createPreview( public_path('/storage/'.$imageName), public_path('/storage/' . $previewPath ) );

                    \Log::info( '$previewCreated' , [ '$previewCreated' => $previewCreated ] );

                    // Обновить или создать запись в photo
                    Photo::updateOrCreate(
                        ['image' => $originalFileName], // Условие поиска
                        [
                            'image_loaded' => '/storage/' . $imageName, // Поля для обновления
                        'preview_loaded' => '/storage/' . $previewPath
                        ]
                    );

                    $saved .= $originalFileName . ' <img src="'.'/storage/' . $previewPath.'" class="w-[100px]" /> ';
                }else{
                    \Log::info('не нашли ', ['line' => __LINE__ ]);
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



    public function createPreview($filePath, $previewPath)
    {
        try {
            $imagine = new Imagine();

            // Загружаем изображение
            $image = $imagine->open($filePath);

            // Получаем размеры оригинального изображения
            $originalSize = $image->getSize();

            // Устанавливаем ширину 200px, высота рассчитывается автоматически
            $width = 200;
            $height = (int)($originalSize->getHeight() * ($width / $originalSize->getWidth()));

            $size = new Box($width, $height);

            // Меняем размер изображения с сохранением пропорций
            $image->resize($size, ImageInterface::FILTER_LANCZOS);

            // Сохраняем превью
            $image->save($previewPath);

            return true;
        } catch (\Exception $e) {
            \Log::error('Ошибка при создании превью: ' . $e->getMessage());
            return false;
        }
    }



}
