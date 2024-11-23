<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','ЦПУСВО.рф')</title>
    @stack('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/svo/css.css"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/svo/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/svo/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/svo/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/svo/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/svo/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/svo/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/svo/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/svo/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/svo/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/svo/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/svo/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/svo/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/svo/favicon/favicon-16x16.png">
    <link rel="manifest" href="/svo/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ff5555">
    <meta name="msapplication-TileImage" content="/svo/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ff5555">

    <script>

        function toggleBlock(blockId) {
            const block = document.getElementById(blockId);
            if (block) {
                block.style.display = (block.style.display === 'none' || block.style.display === '')
                    ? 'block'
                    : 'none';
            } else {
                console.warn(`Элемент с id="${blockId}" не найден.`);
            }
        }

        function showModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            modalImage.src = imageUrl; // Устанавливаем изображение
            modal.classList.remove('hidden'); // Показываем модальное окно
        }

        function hideModal(event) {
            const modal = document.getElementById('imageModal');

            if (event?.target?.id === 'imageModal' || !event) {
                modal.classList.add('hidden'); // Скрываем модальное окно
            }
        }

        function copyToClipboard(id) {
            var copyText = document.getElementById(id).textContent; // Получаем текст из span
            navigator.clipboard.writeText(copyText).then(() => {
                // alert('Скопировано: ' + copyText);
            }).catch(err => {
                console.error('Ошибка при копировании: ', err);
            });
        }

    </script>


    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-animate {
            opacity: 0;
            animation: fadeIn 2s ease-out forwards;
        }

        .copy-btn {
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .copy-btn:hover {
            background-color: #3b82f6;
        }


    </style>


</head>
<body>

@include('layouts/header')

<main class="min-h-[75vh]">
    @yield('content')
    {{ $slot }}

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(99021806, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/99021806" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</main>

@include('layouts/footer')

<!-- Модальное окно -->
<div
    id="imageModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden table-animate"
    onclick="hideModal()"
>
    <div class="relative bg-white p-4 rounded shadow-lg max-w-4xl">
        {{--                                    <button--}}
        {{--                                        class="absolute top-2 right-2 text-gray-600 hover:text-gray-800"--}}
        {{--                                        onclick="hideModal(event)"--}}
        {{--                                    >--}}
        {{--                                        ✕--}}
        {{--                                    </button>--}}
        <img id="modalImage" src="" alt="Full-size" class="rounded max-w-full max-h-screen"/>
    </div>
</div>

@livewireScripts
@stack('scripts')
</body>
</html>
