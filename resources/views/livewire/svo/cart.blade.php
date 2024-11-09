<div class="md:container w-full md:mx-auto">
    <h2 class="text-xl font-bold mb-4"><a href="{{ route('svo.shop') }}" class="text-blue-500">Добро</a> > Корзина</h2>

    @if(empty($cartItems))
        <p>Корзина пуста.</p>
        <p><a wire:navigate href="{{ route('svo.shop') }}" class="text-blue-600 underline">Выбрать товары</a></p>
    @else
        <form wire:submit="sendOrder" >
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
            <tr>
                <th class="px-4 py-2 border">Товар</th>
                <th class="px-4 py-2 border">Количество</th>
                <th class="px-4 py-2 border">Цена</th>
                <th class="px-4 py-2 border">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td class="px-4 py-2 border">
{{--                        <img src="{{ $item['item']->photo->first() }}" />--}}
{{--                        <br/>--}}
{{--                        {{ $item['item']->photo->first() }}--}}
{{--                        <br/>--}}
                        {{ $item['item']->name }}<br/>
                        <small>{{ $item['item']->additive }}</small>
                    </td>
                    <td class="text-center">
                    <button wire:click="decrementQuantity({{ $item['item']->id }})" class="px-2 bg-gray-300">-</button>
                        <button wire:click="decrementQuantity10({{ $item['item']->id }})" class="px-2 bg-gray-300">-10</button>
                        <input
{{--                            type="number"--}}
                            type="text"
                               step="1"
                               min="0"
                               readonly
{{--                               wire:input.live="updateQuantity({{ $item['item']->id }}, $event.target.value)"--}}
                               class="w-[75px] text-center mx-1 border border-gray-300"
                               value="{{ $item['quantity'] }}" />
                        <button wire:click="incrementQuantity10({{ $item['item']->id }})" class="px-2 bg-gray-300">+10</button>
                        <button wire:click="incrementQuantity({{ $item['item']->id }})" class="px-2 bg-gray-300">+</button>
                    </td>
                    <td class="px-4 py-2 border text-right">{{ number_format($item['item']->price1,2,'.','`') }}</td>
                    <td class="px-4 py-2 border text-right">{{ number_format(round($item['quantity'] * $item['item']->price1,2),2,'.','`') }}</td>
                </tr>
            @endforeach

            <!-- Нижняя строка для общей суммы -->
            <tr>
                <td colspan="3" class="px-4 py-2 border text-right font-semibold">Итого:</td>
                <td class="px-4 py-2 border font-semibold text-right">{{ number_format(round(collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['item']->price1),2),2,'.','`') }}</td>
            </tr>
            </tbody>
        </table>

        <div class="mt-6 mb-10">
            <div class="w-[50%] mx-auto" >
            <h3 class="text-lg font-semibold">Данные покупателя</h3>
            <label for="name">Имя:</label>
            <input type="text"
                   required
                   wire:model="name" class="border p-2 w-full mb-2" />

            <label for="phone">Телефон:</label>
            <input type="text"
                   required
                   wire:model="phone" class="border p-2 w-full mb-2" />

            <button class="bg-blue-500 text-white px-4 py-2 mt-2"
                type="submit"
                >Отправить заказ</button>
            </div>
        </div>
        </form>
    @endif
</div>
