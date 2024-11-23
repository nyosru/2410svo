<div class="md:container w-full md:mx-auto">
    <h2 class="text-xl font-bold mb-4">
        <a href="{{ route('svo.shop') }}" class="text-blue-500">Добро</a> > Корзина
    </h2>

    @if(empty($cartItems))
        <p>Корзина пуста.</p>
        <p><a wire:navigate href="{{ route('svo.shop') }}" class="text-blue-600 underline">Выбрать товары</a></p>
    @else
        <form wire:submit="sendOrder">
            <div class="flex flex-col w-full border border-gray-300">
                <!-- Заголовок -->
                <div class="flex flex-row w-full bg-gray-100 text-sm font-semibold">
                    <div class="w-[50%] px-4 py-2 border">Товар</div>
                    <div class="w-[20%] px-4 py-2 border text-center">Количество</div>
                    <div class="w-[15%] px-4 py-2 border text-right">Цена</div>
                    <div class="w-[15%] px-4 py-2 border text-right">Сумма</div>
                </div>

                <!-- Товары в корзине -->
                @foreach($cartItems as $item)
                    <div class="flex flex-row items-center w-full border-b border-gray-300 py-2">
                        <!-- Название товара и описание -->
                        <div class="w-[50%] px-4 border-b md:border-none md:py-2">
                            <div class="text-lg font-semibold">{{ $item['item']->naimenovanie }}</div>
                            <small>{{ $item['item']->dobavka }}</small>
                        </div>


                        <!-- Количество -->
                        <div class="w-[20%] px-4 items-center justify-center py-2">
                            <div class="w-full flex items-center justify-center mx-auto">
                                <button wire:click="decrementQuantity({{ $item['item']->id }})" class="px-2 bg-gray-300 mr-1">-</button>
                                <button wire:click="decrementQuantity10({{ $item['item']->id }})" class="px-2 bg-gray-300">-10</button>
                                <input type="text"
                                       readonly
                                       class="w-[50px] text-center mx-1 border border-gray-300"
                                       value="{{ $item['quantity'] }}" />
                                <button wire:click="incrementQuantity10({{ $item['item']->id }})" class="px-2 bg-gray-300">+10</button>
                                <button wire:click="incrementQuantity({{ $item['item']->id }})" class="px-2 bg-gray-300 ml-1">+</button>
                            </div>
                        </div>


                        <!-- Цена -->
                        <div class="w-[15%] px-4 text-right text-sm ml-4 py-2">
                            {{ number_format($item['item']->tsena3, 2, '.', '`') }}
                        </div>

                        <!-- Сумма -->
                        <div class="w-[15%] px-4 text-right text-sm py-2">
                            {{ number_format(round($item['quantity'] * $item['item']->tsena3, 2), 2, '.', '`') }}
                        </div>
                    </div>
                @endforeach

                <!-- Общая сумма -->
                <div class="flex w-full font-semibold">
                    <div class="flex-1 px-4 py-2 border text-right">Итого:</div>
                    <div class="w-[15%] px-4 py-2 border text-right">{{ number_format(round(collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['item']->tsena3), 2), 2, '.', '`') }}</div>
                </div>
            </div>

            <!-- Данные покупателя -->
            <div class="mt-6 mb-10">
                <div class="w-[50%] mx-auto">
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
                            type="submit">Отправить заказ</button>
                </div>
            </div>
        </form>
    @endif
</div>
