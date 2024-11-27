<header>
    <div class="p-5 block bg-green-200 text-[3rem] font-bold"
         style="background-image: url('/svo/image/bg.jpg'); background-size: cover; background-position: center center;"
    >
        {{--        ЦПУСВО.рф--}}
        <a href="/" title="ЦПУСВО.рф">
            {{--        <img src="/svo/image/logo.jpg" class="ml-[15%] w-[10rem]" />--}}
            <img src="/svo/image/logo2.png" class="ml-[15%] w-[10rem]"/>
        </a>
    </div>
    <livewire:svo.menu/>
</header>


<script>
    document.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');

        if (window.scrollY > 100) {
            // nav.classList.add('bg-red-100', 'fixed', 'top-0', 'left-0', 'w-full', 'md:flex', '1items-center', '1justify-between');
            nav.classList.add('bg-red-100', 'fixed', 'top-0', 'left-0', 'w-full', 'md:flex');
            if (!document.getElementById('smallLogo')) {
                nav.insertAdjacentHTML('afterbegin', `
                    <a href="/" id="smallLogo"  ><img src="/svo/image/logo.jpg" class="ml-4 w-12 h-12"></a>
                `);
            }
        } else {
            // nav.classList.remove('bg-red-100', 'fixed', 'top-0', 'left-0', 'w-full', 'md:flex', '1items-center', '1justify-between');
            nav.classList.remove('bg-red-100', 'fixed', 'top-0', 'left-0', 'w-full', 'md:flex');
            const smallLogo = document.getElementById('smallLogo');
            if (smallLogo) {
                smallLogo.remove();
            }
        }
    });
</script>
