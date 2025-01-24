<?php

namespace App\Livewire\Svo\DataScan;

use Livewire\Component;
use Livewire\WithFileUploads;

class FinFile extends Component
{
    use WithFileUploads;

    public $file;

    public function save()
    {
        // Валидация загружаемого файла
        $this->validate([
            'file' => 'required|file|max:10240', // Максимум 10MB
        ]);

        // Сохранение файла с фиксированным именем 'Fin.rdp'
        $this->file->storeAs('fin-files', 'Fin.rdp');

        // При необходимости можно сохранить путь в базе данных или выполнить другие действия

        session()->flash('messageFile', 'Файл успешно загружен' );
    }

    public function render()
    {
        return view('livewire.svo.data-scan.fin-file');
    }
}
