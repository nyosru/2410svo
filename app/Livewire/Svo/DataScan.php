<?php
namespace App\Livewire\Svo;

use App\Http\Controllers\Svo\ShopScanDatafileController;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataScan extends Component
{
    use WithFileUploads;

    public $type_file;
    public $uploadedFile;
    public $scanResult;

    public function scanFile()
    {
        // Проверка выбора файла и типа
        $this->validate([
            'type_file' => 'required',
            'uploadedFile' => 'required|file',
        ]);

        // Сохранение файла в зависимости от выбранного типа

        if( $this->type_file == 'shop' ) {
//            $filePath = '/storage/app/private/svo/Dobro.csv';
            $savedFile = $this->uploadedFile->storeAs('svo', 'Dobro.csv');
        }elseif( $this->type_file == 'trebs' ) {
//            $filePath = '/storage/app/private/svo/Trebs.csv';
            $savedFile = $this->uploadedFile->storeAs('svo', 'Trebs.csv');
        }

//        $savedFile = $this->uploadedFile->storeAs('private/svo', basename($filePath));

        // Вызов сканирования и сохранение результата
        $this->scanResult = (array) ShopScanDatafileController::scan($savedFile, $this->type_file);
    }

    public function render()
    {
        return view('livewire.svo.data-scan');
    }
}
