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
            <img src="{{ $photo->photo_url }}" alt="Фото {{ $item->name }}" class="w-24 h-24 object-cover">
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
            <button wire:click="decrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">-</button>

            <!-- Поле ввода для количества -->
            <input type="text" class="w-12 text-center mx-1 border border-gray-300" wire:model="quantities" readonly/>

            <!-- Кнопка увеличения количества -->
            <button wire:click="incrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">+</button>
        </div>


        {{--        <button class="bg-blue-400 p-1">добавить в корзину</button>--}}

        <!-- Кнопка для добавления в корзину или перехода в корзину -->
        @if ($inCart)
            <a href="{{ route('svo.cart') }}" class="bg-green-400 p-1 rounded">Перейти в корзину</a>
        @else

            <button wire:click="addToCart" class="block-inline mx-auto bg-yellow-400 p-1 rounded">Купить</button>

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
