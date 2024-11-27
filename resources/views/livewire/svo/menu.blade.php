<nav id="mainNav"  style="z-index:500;" class="space-x-4 text-center p-2 text-2xl mb-2">

    <a wire:navigate href="{{ route('index') }}"
       class=" p-2 {{ Route::is('index') ? 'bg-orange-500 text-white' : '' }}">Главная</a>

    <a wire:navigate href="{{ route('svo.shop') }}"
       class=" p-2 {{ Route::is('svo.shop') ? 'bg-orange-500 text-white' : '' }}">Добро</a>

    @if($cartItemsCount > 0)
    <a wire:navigate href="{{ route('svo.cart') }}"
       class=" p-2 {{ ( Route::is('svo.cart') || Route::is('svo.cart.ok') ) ? 'bg-orange-500 text-white' : '' }}">Корзина</a>
    @endif

    <a wire:navigate href="{{ route('trebs') }}"
       class=" p-2 {{ Route::is('trebs') ? 'bg-orange-500 text-white' : '' }}">Требы</a>

{{--    <a wire:navigate href="{{ route('fin') }}"--}}
{{--       class=" p-2 {{ Route::is('fin') ? 'bg-orange-500 text-white' : '' }}">Фин&nbsp;отчёт</a>--}}

{{--    <a wire:navigate href="{{ route('page', ['page' => 'contact']) }}"--}}
{{--       class=" p-2 {{ Route::is('page') && request('page') === 'contact' ? 'bg-orange-500 text-white' : '' }}">Контакты</a>--}}

    <a wire:navigate href="{{ route('contact') }}"
       class=" p-2 {{ Route::is('contact') ? 'bg-orange-500 text-white' : '' }}">Контакты</a>

</nav>
