<header>
    <div class="p-5 block bg-green-200 text-[3rem] font-bold">
        ЦПУСВО.рф
    </div>
    <nav class="space-x-4 text-center p-2">
        <a wire:navigate href="{{ route('index') }}"
           class=" p-2 {{ Route::is('index') ? 'bg-orange-500 text-white' : '' }}">Главная</a>
        <a wire:navigate href="{{ route('trebs') }}"
           class=" p-2 {{ Route::is('trebs') ? 'bg-orange-500 text-white' : '' }}">Требы</a>
        <a wire:navigate href="{{ route('fin') }}"
           class=" p-2 {{ Route::is('fin') ? 'bg-orange-500 text-white' : '' }}">Фин отчёт</a>
        <a wire:navigate href="{{ route('page', ['page' => 'contact']) }}"
           class=" p-2 {{ Route::is('page') && request('page') === 'contact' ? 'bg-orange-500 text-white' : '' }}">Контакты</a>
    </nav>
</header>
