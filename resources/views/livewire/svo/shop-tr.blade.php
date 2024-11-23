<div class="w-[1100px] mx-auto">

    {{--    {{ print_r($item->getAttributes()) }}--}}
    <div class="flex flex-row w-[1100px] hover:bg-gray-100 ">

        <div class="w-[180px] flex items-center justify-center p-2">
            @if( empty($item->photos) )
                <div class="max-w-[160px] max-h-[160px] rounded" style="border: 1px solid gray;">&nbsp;</div>
            @else
                @foreach ($item->photos as $photo)

                    {{--                    {{$photo->photo_url}}--}}
                    {{--                    <pre class="text-[10px]" style="max-height: 500px; overflow: auto;">--}}
                    {{--                {{ print_r($photo ?? [],true) }}--}}
                    {{--                    </pre>--}}

                    {{--  {{ $photo->photo_url }}<br/>--}}
                    {{--  <img src="{{ $photo->photo_url }}" alt="Фото {{ $item->name }}" class="w-24 h-24 object-cover"> --}}
                    {{--  <img src="{{ $photo->photo_url->photoLoaded[0]->photoLoaded ?? '' }}"/> --}}

                    {{--                    <br/>--}}
                    @if( !empty( $photo->photoLoaded ))
                        {{--                        @foreach( $photo->photoLoaded as $ph )--}}
                        {{-- {{ $ph->preview_loaded ?? '' }}--}}
                        <img src="{{ $photo->photoLoaded->preview_loaded ?? '' }}"
                             onclick="showModal('{{ $photo->photoLoaded->image_loaded }}')"
                             class="w-[120px]"/>
                        {{--                        @endforeach--}}
                        @break
                        {{--                        <br/>--}}
                        {{--                        <br/>--}}
                    @endif
                @endforeach
            @endif
        </div>

        <div class="flex flex-col w-[600px] justify-between">
            <div>
                <div class="float-right text-[12px]">
                    {{ $item->kod_t }}<br/>
                    <span class="text-[16px]">
                {{ $item->firma }}
                </span>
                </div>
                {{-- ячейка 2 --}}
                <div class="text-lg font-semibold">
                    {{ $item->naimenovanie }} {{ $item->dobavka }}
                </div>
                @if( !empty($item->sayt_tab) )
                    <a href="{{ $item->sayt_tab }}" class="underline text-blue-500"
                       target="_blank">{{ parse_url($item->sayt_tab, PHP_URL_HOST) }}</a>
                @endif
            </div>
            {{-- Ячейка, которая должна быть прижата к нижней границе --}}
            {{--            <div class="mt-auto text-blue-400 underline">--}}

            {{--            </div>--}}
        </div>
        <div class="flex flex-col w-[200px] ">
            <div class="text-right pr-2">
                {{ number_format($item->tsena1,0,'','`') }} ₽<br/>
                {{ number_format($item->tsena2,0,'','`') }} ₽<br/>
                {{ number_format($item->tsena3,0,'','`') }} ₽<br/>
            </div>
        </div>
        <div class="flex flex-col w-[200px] ">
            {{-- купить --}}
            @if ($inCart)
                <a href="{{ route('svo.cart') }}"
                   class="block bg-green-400 text-center text-white px-3 py-1 rounded">В&nbsp;корзине</a>
            @else
                <button wire:click="addToCart" class="block w-full bg-yellow-300 text-center px-3 py-1 rounded">
                    Заказать
                </button>
            @endif

            @if( !empty($item->analog) )
                <div>
                    <a href="#"
                       onclick="toggleBlock('analog{{ $item->id }}'); return false;"
                       {{--                   class="text-blue-400 underline"--}}
                       class="mt-1 block w-full bg-yellow-300 text-center px-3 py-1 rounded text-[14px]"
                    >Предложить аналог</a>
                </div>
            @endif

        </div>
    </div>


    @if( !empty($item->analog) )
        <div class="m-2" id="analog{{ $item->id }}" style="display: none;">
            <div class="flex flex-row-reverse">
                <div class="bg-orange-100 p-6 rounded-lg shadow-lg w-[600px] table-animate ">
                    <span
                        onclick="toggleBlock('analog{{ $item->id }}'); return false;"
                        class="float-right cursor-pointer text-white py-1 px-2 rounded bg-red-200 hover:bg-red-600 text-[10px]">
                        X
                    </span>
                    Аналог:<br/>
                    {!! $item->analog !!}
                </div>
            </div>
        </div>
    @endif
</div>


@if(1==2)

    {{--    <pre class="text-[10px]" style="max-height: 350px; overflow: auto;">--}}
    {{--        {{ print_r($item) }}--}}
    {{--        {{ print_r($item->photos->photoLoaded->image_loaded) }}--}}
    {{--</pre>--}}

    <div
        class="shop-tr-item
                flex flex-row
                text-lg xfont-semibold
                xxbg-gray-200
                ">

        <!-- Фото товара -->
        <div class="text-center
                xh-[114px] w-[150px] p-1
                border border-1 border-gray-300
                text-[10px]
                ">

            @if($item->photos->isNotEmpty())
                @foreach($item->photos as $photo)
                    @if(!empty($photo->photoLoaded->image_loaded) )
                        <img src="{{ $photo->photoLoaded->image_loaded  }}" class="mx-auto w-[120px]"/>
                    @endif
                @endforeach
            @endif

        </div>

        <!-- Информация о товаре -->
        <div class="flex flex-col flex-grow">

            <div class="flex flex-row w-full">
                <div class="w-[50%] text-center border border-1 border-gray-300 p-1">{{ $item->firma ?? '-' }}</div>
                <div class="w-[50%] text-center border border-1 border-gray-300 p-1">{{ $item->kod_t ?? '-' }}</div>
            </div>

            <div class="text-center border border-1 border-gray-300 p-1">
                {{ $item->naimenovanie }} / {{ $item->dobavka }}
            </div>

            <div class="text-center border border-1 border-gray-300 p-1">
                @if( !empty($item->sayt_tab) )
                    <a href="{{ $item->sayt_tab }}" class="text-blue-400 underline"
                       target="_blank">{{$item->sayt_tab}}</a>
                @endif
            </div>
        </div>

        <!-- Блок для кнопок -->
        <div class="
w-[200px] h-[114px] text-center
border border-1 border-gray-300
p-1">

            <div class="block mb-2 mt-2">
                <!-- Кнопка уменьшения количества -->
                <button wire:click="decrementQuantity({{ $item->id }})" class="px-2 bg-gray-300">-</button>

                <!-- Поле ввода для количества -->
                <input type="text" class="w-12 text-center mx-1 border border-gray-300" wire:model="quantities"
                       readonly/>

                <!-- Кнопка увеличения количества -->
                <button wire:click="incrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">+</button>
            </div>

            @if ($inCart)
                <a href="{{ route('svo.cart') }}" class="block bg-green-400 xtext-white px-3 py-1 rounded">Перейти в&nbsp;корзину</a>
            @else
                <button wire:click="addToCart" class="block w-full bg-yellow-300 xtext-white px-3 py-1 rounded">
                    Заказать
                </button>
            @endif
        </div>

        <!-- Блок для каждой цены с фиксированной шириной -->
        <div class="flex flex-col w-[150px] text-right">
            <div
                class="w-[150px] border border-1 border-blue-300 p-1 pr-2">{{ number_format($item->tsena1,0,'','`') }}</div>
            <div
                class="w-[150px] border border-1 border-blue-300 p-1 pr-2">{{ number_format($item->tsena2,0,'','`') }}</div>
            <div
                class="w-[150px] border border-1 border-blue-300 p-1 pr-2">{{ number_format($item->tsena3,0,'','`') }}</div>
        </div>


    </div>
    {{--    {{ print_r($item->getAttributes(),true) }}--}}
    </div>



    @if( 1==2 )

        <div
            class="flex flex-col md:flex-row items-center border-b border-gray-300 py-4 px-2 @if( $nn % 2 !== 0 ) bg-gray-100 @endif">
            <!-- Фото товара -->
            <div class="flex-shrink-0 w-24 h-24">
                @foreach ($item->photos as $photo)
                    <img src="{{ $photo->photo_url }}" alt="Фото {{ $item->name }}"
                         class="w-full h-full object-cover">
                @endforeach
            </div>

            <!-- Информация о товаре -->
            <div class="flex flex-col justify-between ml-4 flex-grow">
                <div>
                </div>
                <div class="text-lg font-semibold">
                    {{ $item->name }} / {{ $item->additive }}
                </div>
                <div class="text-lg font-semibold">
                    {{--            {{ print_r($item) }}--}}
                </div>
            </div>


            <!-- Блок для кнопок -->
            <div class="xflex xitems-center mt-4 md:mt-0 ml-auto text-center w-full md:w-[150px]">

                <div class="block mb-2 mt-2">
                    <!-- Кнопка уменьшения количества -->
                    <button wire:click="decrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">-</button>

                    <!-- Поле ввода для количества -->
                    <input type="text" class="w-12 text-center mx-1 border border-gray-300" wire:model="quantities"
                           readonly/>

                    <!-- Кнопка увеличения количества -->
                    <button wire:click="incrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">+</button>
                </div>


                @if ($inCart)
                    <a href="{{ route('svo.cart') }}" class="block bg-green-400 xtext-white px-3 py-1 rounded">Перейти
                        в&nbsp;корзину</a>
                @else
                    <button wire:click="addToCart" class="block w-full bg-yellow-300 xtext-white px-3 py-1 rounded">
                        Заказать
                    </button>
                @endif
            </div>


            <!-- Блок для каждой цены с фиксированной шириной -->
            <div class="flex  flex-col ml-4 space-x-2">
                <div class="text-lg font-semibold text-right pr-2"
                     style="width: 100px; xborder: 1px solid green;">{{ number_format($item->price1,0,'','`') }}</div>
                <div class="text-lg font-semibold text-right pr-2"
                     style="width: 100px; xborder: 1px solid green;">{{ number_format($item->price2,0,'','`') }}</div>
                <div class="text-lg font-semibold text-right pr-2"
                     style="width: 100px; xborder: 1px solid green;">{{ number_format($item->price3,0,'','`') }}</div>
            </div>


            @if(1==2)
                <tr
                    class="@if( $nn % 2 === 0 ) bg-gray-100 @endif "
                >
                    {{--    @foreach ($data1 as $k => $h)--}}
                    {{--        @if( $k == 0 || $k == 2 || $k == 4 || $k == 6 || $k == 8  || $k == 10 || $k == 13 || $k == 14 || $k == 15 || $k == 16 || $k == 17 || $k == 18 )--}}
                    {{--            <td class="px-4 py-2 border border-t-2 border-t-gray-500">--}}
                    {{--                --}}{{--                                {{ $k }} / --}}
                    {{--                {{ $h }}</td>--}}
                    {{--        @endif--}}
                    {{--    @endforeach--}}
                    <td
                        {{--        :class="{ 'bg-gray-200': $nn % 2 === 0, 'bg-gray-400': $nn % 2 !== 0 } "  --}}
                    >
                        {{--        {{ $nn }} /        {{ $nn % 2  }} /--}}
                        @foreach ($item->photos as $photo)
                            <img src="{{ $photo->photo_url }}" alt="Фото {{ $item->name }}"
                                 class="w-24 h-24 object-cover">
                        @endforeach
                    </td>

                    <td class="px-4 py-2
{{--    border border-t-2 border-t-gray-500--}}
">{{ $item->name }}
                        <br/>
                        <small>
                            {{ $item->additive }}
                        </small>
                    </td>

                    <td class="text-center">

                        <div class="mb-2 mt-2">
                            <!-- Кнопка уменьшения количества -->
                            <button wire:click="decrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">-
                            </button>

                            <!-- Поле ввода для количества -->
                            <input type="text" class="w-12 text-center mx-1 border border-gray-300"
                                   wire:model="quantities"
                                   readonly/>

                            <!-- Кнопка увеличения количества -->
                            <button wire:click="incrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">+
                            </button>
                        </div>


                        {{--        <button class="bg-blue-400 p-1">добавить в корзину</button>--}}

                        <!-- Кнопка для добавления в корзину или перехода в корзину -->
                        @if ($inCart)
                            <a href="{{ route('svo.cart') }}" class="bg-green-400 p-1 rounded">Перейти в корзину</a>
                        @else

                            <button wire:click="addToCart" class="block-inline mx-auto bg-yellow-400 p-1 rounded">
                                Купить
                            </button>

                        @endif


                    </td>
                    @if(1==2)
                        @foreach ($item as $k => $h)
                            {{--        @if( $k == 12 )--}}
                            <td class="px-4 py-2 border border-t-2 border-t-gray-500">
                                {{ $k }} /
                                {{ $h }}</td>
                            {{--        @endif--}}
                        @endforeach
                    @endif
                </tr>
            @endif

            @endif
        </div>

    @endif
