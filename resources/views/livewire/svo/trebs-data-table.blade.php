<div class="mb-[100px] block w-[1200px] mx-auto bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">

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

    <script>
        function copyToClipboard(id) {
            var copyText = document.getElementById(id).textContent; // Получаем текст из span
            navigator.clipboard.writeText(copyText).then(() => {
                // alert('Скопировано: ' + copyText);
            }).catch(err => {
                console.error('Ошибка при копировании: ', err);
            });
        }

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

    </script>



    <!-- Header Row -->
    <div class="flex flex-row bg-gray-200
{{--sticky top-[40px]--}}
        ">
        <div class="flex flex-col flex-grow">
            <div class="p-1 text-center border border-gray-300">Фирма МОЛ Телефон Комент</div>
            <div class="flex flex-row ">
                <div class="flex-1 p-1 text-center border border-gray-300">Наименование</div>
                <div class="flex-1 p-1 text-center border border-gray-300">КодТ</div>

            </div>
            <div class="flex-1 p-1 text-center border border-gray-300">СайтТаб</div>
            {{--            <div class="flex-1 p-2 text-center">КодТ</div>--}}
        </div>
        <div class="flex flex-col w-[110px]">
            <div class="flex-1 p-1 text-center border border-gray-300">Дебет</div>
            <div class="flex-1 p-1 text-center border border-gray-300">Кол</div>
            <div class="flex-1 p-1 text-center border border-gray-300">&nbsp;</div>
        </div>
        <div class="flex flex-col w-[110px] ">
            <div class="flex-1 p-1 text-center border border-gray-300">Кредит</div>
            <div class="flex-1 p-1 text-center border border-gray-300">Кол</div>
            <div class="flex-1 p-1 text-center border border-gray-300">&nbsp;</div>
        </div>
        <div class="flex flex-col w-[110px] ">
            <div class="flex-1 p-1 text-center border border-gray-300">QR&nbsp;код
{{--                <br/>--}}
{{--                <span class="text-[10px]">для&nbsp;перевода</span>--}}
            </div>
            <div class="flex-1 p-1 text-center border border-gray-300">Для ЮрЛиц</div>
            <div class="flex-1 p-1 text-center border border-gray-300">Аналог</div>
        </div>
{{--        <div class="flex flex-col w-[110px] text-center p-1">--}}
{{--            Уровень--}}
{{--        </div>--}}
    </div>


{{--            <div class="flex-1 p-2 text-center">Кредит<br>кол</div>--}}
{{--            <div class="flex-1 p-2 text-center">Курица<br>Для ЮП</div>--}}
{{--            <div class="flex-1 p-2 text-center">Уровень</div>--}}
{{--        </div>--}}
{{--        <!-- Data Rows -->--}}
{{--        <div class="flex text-sm border-b border-gray-300">--}}
{{--            <div class="flex-1 p-2 text-center">АНО "ЦПУ СВО"</div>--}}
{{--            <div class="flex-1 p-2 text-center">Название + Добавка</div>--}}
{{--            <div class="flex-1 p-2 text-center">Таб1</div>--}}
{{--            <div class="flex-1 p-2 text-center">12345</div>--}}
{{--            <div class="flex-1 p-2 text-center">100.00</div>--}}
{{--            <div class="flex-1 p-2 text-center">200.00</div>--}}
{{--            <div class="flex-1 p-2 text-center">Аналог</div>--}}
{{--            <div class="flex-1 p-2 text-center">1</div>--}}
{{--        </div>--}}
{{--        <div class="flex text-sm border-b border-gray-300">--}}
{{--            <div class="flex-1 p-2 text-center">ООО "Пример"</div>--}}
{{--            <div class="flex-1 p-2 text-center">Товар + Доп</div>--}}
{{--            <div class="flex-1 p-2 text-center">Таб2</div>--}}
{{--            <div class="flex-1 p-2 text-center">67890</div>--}}
{{--            <div class="flex-1 p-2 text-center">300.00</div>--}}
{{--            <div class="flex-1 p-2 text-center">400.00</div>--}}
{{--            <div class="flex-1 p-2 text-center">Аналог</div>--}}
{{--            <div class="flex-1 p-2 text-center">2</div>--}}
{{--        </div>--}}
{{--        <!-- Add more rows as needed -->--}}
{{--    </div>--}}

<livewire:svo.trebs-data-table-lower :data_head="$data_head"
                                     wire:lazy
/>
</div>
