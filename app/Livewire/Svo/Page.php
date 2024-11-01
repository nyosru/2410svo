<?php

namespace App\Livewire\Svo;

use App\Models\HtmlPage;
use Livewire\Component;

class Page extends Component
{
    public $page = 'index';
    public $htmlContent;

    public function mount()
    {
        // Поиск страницы по переменной $page
        $pageRecord = HtmlPage::where('page_variable', $this->page)->first();

        // Если запись найдена, то загружаем её HTML контент
        $this->htmlContent = $pageRecord ? $pageRecord->html_content : '-- данные не найдены --';
    }

    public function render()
    {

        return view('livewire.svo.page');
    }
}
