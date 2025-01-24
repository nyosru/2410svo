<footer class="bg-gray-100 border-t border-gray-300 py-5">
<div class="sm:flex items-center justify-between">
    <div class="flex-1 flex items-center justify-center border-r border-gray-300 text-center">
        <a href="{{ route('file.download.fin') }}"
           class="underline text-blue-600 p-2 hover:bg-orange-500 hover:text-white hover:no-underline" >Фин.часть (файл доступа)</a>
    </div>
    <div class="flex-1 flex items-center justify-center">
    </div>
</div>
<div class="sm:flex items-center justify-between">
    <div class="flex-1 flex items-center justify-center border-r border-gray-300 text-center">
        Все права защищены © {{ date('Y') }}<br/>
        Лучше не нарушать
    </div>
    <div class="flex-1 flex items-center justify-center">
        Создание сайта: <a href="https://php-cat.com" target="_blank"
                           class="underline text-blue-600 p-2 hover:bg-yellow-200" title="php-cat.com">php-cat.com</a>
    </div>
</div>
</footer>
