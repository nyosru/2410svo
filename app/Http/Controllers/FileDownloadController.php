<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function downloadFin()
    {
        // Путь к файлу, который нужно скачать
        $filePath = 'fin-files/Fin.rdp'; // Убедитесь, что файл существует по этому пути

        // Проверка существования файла и его скачивание
        if (Storage::exists($filePath)) {
            return Storage::download($filePath, 'ФинЧасть.rdp'); // Имя файла при скачивании
        }

        return abort(404); // Возврат ошибки 404, если файл не найден
    }
}
