<tbody>

<tr>
    {{--    @foreach ($data1 as $k => $h)--}}
    {{--        @if( $k == 0 || $k == 2 || $k == 4 || $k == 6 || $k == 8  || $k == 10 || $k == 13 || $k == 14 || $k == 15 || $k == 16 || $k == 17 || $k == 18 )--}}
    {{--            <td class="px-4 py-2 border border-t-2 border-t-gray-500">--}}
    {{--                --}}{{--                                {{ $k }} / --}}
    {{--                {{ $h }}</td>--}}
    {{--        @endif--}}
    {{--    @endforeach--}}
    <td>

        <!-- Кнопка уменьшения количества -->
        <button wire:click="decrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">-</button>

        <!-- Поле ввода для количества -->
        <input type="text" class="w-12 text-center mx-1 border border-gray-300" wire:model="quantities" readonly />

        <!-- Кнопка увеличения количества -->
        <button wire:click="incrementQuantity({{ $item['id'] }})" class="px-2 bg-gray-300">+</button>

        <br/>

{{--        <button class="bg-blue-400 p-1">добавить в корзину</button>--}}

        <!-- Кнопка для добавления в корзину или перехода в корзину -->
        @if ($inCart)
            <a href="{{ route('svo.cart') }}" class="bg-green-400 p-1">Перейти в корзину</a>
        @else
            <button wire:click="addToCart" class="bg-blue-400 p-1">Добавить в корзину</button>
        @endif


    </td>
    @foreach ($item as $k => $h)
        {{--        @if( $k == 12 )--}}
        <td class="px-4 py-2 border border-t-2 border-t-gray-500">
            {{ $k }} /
            {{ $h }}</td>
        {{--        @endif--}}
    @endforeach
</tr>
<tr>
    <td>-</td>
    <td>
        @foreach ($item->photos as $photo)
            <img src="{{ $photo->photo_url }}" alt="Фото {{ $item->name }}" class="w-24 h-24 object-cover">
        @endforeach
    </td>
    <td class="px-4 py-2 border border-t-2 border-t-gray-500">{{ $item->name }}
        <br/>
        <small>
            {{ $item->additive }}
        </small>
    </td>

</tr>

{{--<tr>--}}
{{--    @foreach ($data as $k => $h)--}}
{{--        @if( $k == 1 || $k == 3 || $k == 5 || $k == 7 || $k == 9 || $k == 11 || $k == 19 || $k == 20 || $k == 21 || $k == 22 || $k == 23 || $k == 24 )--}}
{{--            <td class="px-4 py-2 border ">--}}
{{--                --}}{{--                                {{ $k }} / --}}
{{--                {{ $h }}</td>--}}
{{--        @endif--}}
{{--    @endforeach--}}
{{--</tr>--}}

</tbody>
