<nav id="mainNav"  style="z-index:500;" class="space-x-4 text-center p-2 rounded text-2xl mb-2">

{{--    <a wire:navigate href="{{ route('index') }}"--}}
{{--       class=" px-4 py-1 rounded {{ Route::is('index') ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Главная</a>--}}

    <a wire:navigate href="{{ route('svo.shop') }}"
       class=" px-4 py-1 rounded {{ Route::is('svo.shop') ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Добро</a>

    @if($cartItemsCount > 0)
    <a wire:navigate href="{{ route('svo.cart') }}"
       class=" px-4 py-1 rounded {{ ( Route::is('svo.cart') || Route::is('svo.cart.ok') ) ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Корзина</a>
    @endif

    <a wire:navigate href="{{ route('trebs') }}"
       class=" px-4 py-1 rounded {{ Route::is('trebs') ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Требы</a>

    <a wire:navigate href="{{ route('pomnim') }}"
       class=" px-4 py-1 rounded {{ Route::is('pomnim') ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Мы помним</a>

{{--    <a wire:navigate href="{{ route('fin') }}"--}}
{{--       class=" px-4 py-1 rounded {{ Route::is('fin') ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Фин&nbsp;отчёт</a>--}}

{{--    <a wire:navigate href="{{ route('page', ['page' => 'contact']) }}"--}}
{{--       class=" px-4 py-1 rounded {{ Route::is('page') && request('page') === 'contact' ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Контакты</a>--}}

    <a wire:navigate href="{{ route('contact') }}"
       class=" px-4 py-1 rounded {{ Route::is('contact') ? 'bg-[#fe0000] text-[#feff00]' : '' }}">Контакты</a>

</nav>
