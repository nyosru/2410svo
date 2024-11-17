<div>
    <div class="py-3 text-center">
        Быстрый поиск: <input wire:model.live="search" type="text" class="border border-2 p-1"/>
    </div>
    {{--    {{ $search }}--}}
    {{--    {{ count($data1)  }}--}}
    @if(count($data1) > 0 )

        <div class="container mx-auto xmy-1 w-[1400px]">

            <div class="flex flex-row">
                <div class="w-[200px]">
                    Фильтр по Фирмам:
                    @foreach ($firms as $firm)
                        <label class="block"><input type="checkbox" value="{{ $firm->firma }}" />{{ $firm->firma }}</label>
                    @endforeach
                </div>
                <div class="w-[1200px]">
                    <div
                        class="
                sticky top-[60px]

                flex flex-row
                text-lg font-semibold
                bg-gray-200
                ">

                        <!-- Фото товара -->
                        <div class="text-center
                h-[114px] w-[150px] p-1
                border border-1 border-blue-300
                ">

                        </div>

                        <!-- Информация о товаре -->
                        <div class="flex flex-col flex-grow">

                            <div class="flex flex-row w-full">
                                <div class="w-[50%] text-center border border-1 border-blue-300 p-1">Фирма</div>
                                <div class="w-[50%] text-center border border-1 border-blue-300 p-1">КодТ</div>
                            </div>

                            <div class="text-center border border-1 border-blue-300 p-1">
                                Наименование Добавка
                            </div>

                            <div class="text-center border border-1 border-blue-300 p-1">
                                СайтТаб
                            </div>
                        </div>

                        <!-- Блок для кнопок -->
                        <div class="
                w-[200px] h-[114px] text-center
                border border-1 border-blue-300
                p-1">
                            &nbsp;Кол-во
                        </div>

                        <!-- Блок для каждой цены с фиксированной шириной -->
                        <div class="flex flex-col w-[150px] text-right">
                            <div class="w-[150px] border border-1 border-blue-300 p-1 pr-2">Цена 1</div>
                            <div class="w-[150px] border border-1 border-blue-300 p-1 pr-2">Цена 2</div>
                            <div class="w-[150px] border border-1 border-blue-300 p-1 pr-2">Цена 3</div>
                        </div>

                    </div>
                    <style>
                        .shop-tr-item:nth-child(even) {
                            background-color: rgb(240, 240, 240);
                        }
                    </style>

                    @foreach ($data1 as $index=>$data12)
                        <livewire:svo.shop-tr :item=$data12
                                              :key="$data12->id"
                                              :nn="$index"
                        />
                    @endforeach

                    <div class="my-6">
                        {{ $data1->links($paginationView) }}
                    </div>
                </div>
            </div>
        </div>

    @else
        <p class="text-center bg-yellow-300 p-5 rounded">Товаров не найдено ({{ $search }})</p>
    @endif
</div>
