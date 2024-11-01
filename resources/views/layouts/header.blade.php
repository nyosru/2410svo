<header>
    <div class="p-5 block bg-green-200 text-[3rem] font-bold"
    style="background-image: url('/svo/image/bg.jpg'); background-size: cover; background-position: center center;"
    >
{{--        ЦПУСВО.рф--}}
        <a href="/" title="ЦПУСВО.рф">
        <img src="/svo/image/logo.jpg" class="ml-[15%] w-[10rem]" />
        </a>
    </div>
    <nav id="mainNav"  class="space-x-4 text-center p-2 text-2xl ">
        <a wire:navigate href="{{ route('index') }}"
           class=" p-2 {{ Route::is('index') ? 'bg-orange-500 text-white' : '' }}">Главная</a>
        <a wire:navigate href="{{ route('shop') }}"
           class=" p-2 {{ Route::is('shop') ? 'bg-orange-500 text-white' : '' }}">Добро</a>
        <a wire:navigate href="{{ route('trebs') }}"
           class=" p-2 {{ Route::is('trebs') ? 'bg-orange-500 text-white' : '' }}">Требы</a>
        <a wire:navigate href="{{ route('fin') }}"
           class=" p-2 {{ Route::is('fin') ? 'bg-orange-500 text-white' : '' }}">Фин отчёт</a>
        <a wire:navigate href="{{ route('page', ['page' => 'contact']) }}"
           class=" p-2 {{ Route::is('page') && request('page') === 'contact' ? 'bg-orange-500 text-white' : '' }}">Контакты</a>
    </nav>
</header>


<script>
    document.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');

        if (window.scrollY > 100) {
            nav.classList.add('bg-red-100', 'fixed', 'top-0', 'left-0', 'w-full', 'flex', '1items-center', '1justify-between');
            if (!document.getElementById('smallLogo')) {
                nav.insertAdjacentHTML('afterbegin', `
                    <a href="/"><img id="smallLogo" src="/svo/image/logo.jpg" class="ml-4 w-12 h-12"></a>
                `);
            }
        } else {
            nav.classList.remove('bg-red-100', 'fixed', 'top-0', 'left-0', 'w-full', 'flex', 'items-center', 'justify-between');
            const smallLogo = document.getElementById('smallLogo');
            if (smallLogo) {
                smallLogo.remove();
            }
        }
    });
</script>
