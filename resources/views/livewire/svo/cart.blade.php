<div>
    <div class="md:container w-full md:mx-auto">
        <h2 class="text-xl font-bold mb-4">
            <a href="{{ route('svo.shop') }}" class="text-blue-500">Добро</a> > Корзина
        </h2>

        @if(empty($cartItems))
            <p>Корзина пуста.</p>
            <p><a wire:navigate href="{{ route('svo.shop') }}" class="text-blue-600 underline">Выбрать товары</a></p>
        @else
            <form wire:submit="sendOrder">
                <div
                    x-data="{
                    quantities: @entangle('quantities').live,
                    prices: {{ json_encode(collect($cartItems)->pluck('item.tsena3', 'item.id')) }},
                    total: 0,
                    formatNumber(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '\'');
                    },
                    calculateTotal() {
                        this.total = Object.keys(this.quantities).reduce((sum, id) => {
                            const quantity = this.quantities[id];
                            const price = this.prices[id];
                            return sum + (quantity * price);
                        }, 0);
                    }
                 }"
                    x-init="calculateTotal()"
                    @quantity-updated.window="calculateTotal()"
                    class="flex flex-col w-full border border-gray-300">

                    <!-- Заголовок -->
                    <div class="flex flex-row w-full bg-gray-100 text-sm font-semibold">
                        <div class="w-[5%] px-4 py-2 border">&nbsp;</div>
                        <div class="w-[50%] px-4 py-2 border">Товар</div>
                        <div class="w-[25%] px-4 py-2 border text-center">Количество</div>
                        <div class="w-[10%] px-4 py-2 border text-right">Цена</div>
                        <div class="w-[10%] px-4 py-2 border text-right">Сумма</div>
                    </div>

                    <!-- Товары в корзине -->
                    @foreach($cartItems as $item)
                        <div
                            x-data="{
                            price: {{ $item['item']->tsena3 }},
                            quantity: $wire.entangle('quantities.{{ $item['item']->id }}').live,
                        }"
                            class="flex flex-row items-center w-full border-b border-gray-300 py-2">

                            <!-- Название товара и описание -->
                            <div class="w-[5%] text-center">
                                <a href="#"
                                   title="Удалить из корзины"
                                   class="text-red-200 hover:text-red-500"
                                   wire:click.prevent="removeFromCart({{ $item['item']->id }})"
                                   wire:confirm="Удалить товар из корзины ?">x</a>
                            </div>

                            <div class="w-[50%] px-4 border-b md:border-none md:py-2">
                                <div class="text-lg font-semibold">{{ $item['item']->naimenovanie }}</div>
                                <small>{{ $item['item']->dobavka }}</small>
                            </div>

                            <!-- Количество -->
                            <div class="w-[25%] px-4 items-center justify-center py-2">
                                <div class="w-full flex items-center justify-center mx-auto">
                                    <button type="button"
                                            @click="quantity = Math.max(0, quantity - 1); $dispatch('quantity-updated')"
                                            class="px-2 bg-gray-300 mr-1">-
                                    </button>
                                    <button type="button"
                                            @click="quantity = Math.max(0, quantity - 10); $dispatch('quantity-updated')"
                                            class="px-2 bg-gray-300">-10
                                    </button>

                                    <input type="text"
                                           x-model="quantity"
                                           readonly
                                           class="w-[50px] text-center mx-1 border border-gray-300"/>

                                    <button type="button"
                                            @click="quantity += 10; $dispatch('quantity-updated')"
                                            class="px-2 bg-gray-300">+10
                                    </button>
                                    <button type="button"
                                            @click="quantity++; $dispatch('quantity-updated')"
                                            class="px-2 bg-gray-300 ml-1">+
                                    </button>
                                </div>
                            </div>

                            <!-- Цена -->
                            <div class="w-[10%] px-4 text-right text-sm ml-4 py-2">
                                <span x-text="formatNumber(price.toFixed(2))"></span>
                            </div>

                            <!-- Сумма -->
                            <div class="w-[10%] px-4 text-right text-sm py-2">
                                <span x-text="formatNumber((quantity * price).toFixed(2))"></span>
                            </div>
                        </div>
                    @endforeach

                    <!-- Общая сумма -->
                    <div class="flex w-full font-semibold">
                        <div class="flex-1 px-4 py-2 border text-right">Итого:</div>
                        <div class="w-[15%] px-4 py-2 border text-right">
                            <span x-text="formatNumber(total.toFixed(2))"></span>
                        </div>
                    </div>
                </div>

                <!-- Данные покупателя -->
                <div class="mt-6 mb-10">
                    <div class="w-[50%] mx-auto">
                        <h3 class="text-lg font-semibold">Данные покупателя</h3>
                        <label for="name">Имя:</label>
                        <input type="text"
                               required
                               wire:model="name" class="border p-2 w-full mb-2"/>

                        <label for="phone">Телефон:</label>
                        <input type="text"
                               required
                               wire:model="phone" class="border p-2 w-full mb-2"/>

                        <button class="bg-blue-500 text-white px-4 py-2 mt-2"
                                type="submit">Отправить заказ
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>

@if(1==2)
<div class="md:container w-full md:mx-auto">
    <h2 class="text-xl font-bold mb-4">
        <a href="{{ route('svo.shop') }}" class="text-blue-500">Добро</a> > Корзина
    </h2>

    @if(empty($cartItems))
        <p>Корзина пуста.</p>
        <p><a wire:navigate href="{{ route('svo.shop') }}" class="text-blue-600 underline">Выбрать товары</a></p>
    @else
        <form wire:submit="sendOrder">
            <div
                x-data="{ quantities: @entangle('quantities'), prices: @entangle('prices') }"
                class="flex flex-col w-full border border-gray-300">
                <!-- Заголовок -->
                <div class="flex flex-row w-full bg-gray-100 text-sm font-semibold">
                    <div class="w-[5%] px-4 py-2 border">&nbsp;</div>
                    <div class="w-[50%] px-4 py-2 border">Товар</div>
                    <div class="w-[25%] px-4 py-2 border text-center">Количество</div>
                    <div class="w-[10%] px-4 py-2 border text-right">Цена</div>
                    <div class="w-[10%] px-4 py-2 border text-right">Сумма</div>
                </div>

                <!-- Товары в корзине -->
                @foreach($cartItems as $item)
                    <div
                        x-data="{
                            price: {{ $item['item']->tsena3 }},
                            quantity: {{ $item['quantity'] }}
{{--                            quantity: quantities[{{ $item['item']->id }}],--}}
{{--                            price: prices[{{ $item['item']->id }}]--}}
                            }
                            "
                        class="flex flex-row items-center w-full border-b border-gray-300 py-2">
                        <!-- Название товара и описание -->

{{--                        price: {{ $item['item']->tsena3 }}--}}

                        <div class="w-[5%] text-center">
                            <a href="#"
                               title="Удалить из корзины"
                               class="text-red-200 hover:text-red-500"
                               wire:click.prevent="removeFromCart({{ $item['item']->id }})"
                               wire:confirm="Удалить товар из корзины ?">x</a>
                        </div>

                        <div class="w-[50%] px-4 border-b md:border-none md:py-2">
                            <div class="text-lg font-semibold">{{ $item['item']->naimenovanie }}</div>
                            <small>{{ $item['item']->dobavka }}</small>
                        </div>

                        <!-- Количество -->
                        @if(1==2)
                            <div class="w-[25%] px-4 items-center justify-center py-2">
                                <div class="w-full flex items-center justify-center mx-auto">
                                    <button type="button" wire:click="decrementQuantity({{ $item['item']->id }})"
                                            class="px-2 bg-gray-300 mr-1">-
                                    </button>
                                    <button type="button" wire:click="decrementQuantity10({{ $item['item']->id }})"
                                            class="px-2 bg-gray-300">-10
                                    </button>
                                    <input type="text"
                                           readonly
                                           class="w-[50px] text-center mx-1 border border-gray-300"
                                           value="{{ $item['quantity'] }}"/>
                                    <button type="button"
                                            @click="quantity--"
                                            {{--                                        wire:click="incrementQuantity10({{ $item['item']->id }})" --}}
                                            class="px-2 bg-gray-300">+10
                                    </button>
                                    <button type="button"
                                            @click="quantity-=10"
                                            {{--                                        wire:click="incrementQuantity({{ $item['item']->id }})" --}}
                                            class="px-2 bg-gray-300 ml-1">+
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Количество -->
                        <div class="w-[25%] px-4 items-center justify-center py-2"
{{--                             x-data="{ quantity: {{ $item['quantity'] }} }"--}}
                        >

                            quantity: {{ $item['quantity'] }}

                            <div class="w-full flex items-center justify-center mx-auto">
                                <button type="button"
                                        {{--                                        @click="quantity--"--}}
                                        {{--                                        @click="quantity = Math.max(0, quantity - 1)"--}}
                                        @click="quantity = Math.max(0, quantity - 1);
                                            $wire.set('quantities.{{ $item['item']->id }}', quantity);
                                            quantities[{{ $item['item']->id }}] = quantity"
                                        {{--                                        wire:click="decrementQuantity({{ $item['item']->id }})" --}}
                                        class="px-2 bg-gray-300 mr-1">-
                                </button>
                                <button type="button"
                                        {{--                                        @click="quantity-=10"--}}
                                        {{--                                        @click="quantity = Math.max(0, quantity - 10)"--}}
                                        @click="quantity = Math.max(0, quantity - 10);
                                            $wire.set('quantities.{{ $item['item']->id }}', quantity);
                                            quantities[{{ $item['item']->id }}] = quantity"
                                        {{--                                        wire:click="decrementQuantity10({{ $item['item']->id }})" --}}
                                        class="px-2 bg-gray-300">-10
                                </button>
                                {{--                                {{$item['item']->id}} / {{$item['id']}} /--}}
                                <input type="text"
                                       x-model="quantity"
                                       readonly
                                       class="w-[50px] text-center mx-1 border border-gray-300"
                                       wire:model.defer="quantities.{{$item['item']->id}}"
                                       value="1"
                                    {{--                                       value="{{ $item['quantity'] }}"--}}
                                />
                                <button type="button"
                                        {{--                                        @click="quantity += 10"--}}
                                        @click="quantity += 10;
                                            $wire.set('quantities.{{ $item['item']->id }}', quantity);
                                            quantities[{{ $item['item']->id }}] = quantity"
                                        {{--                                        wire:click="incrementQuantity10({{ $item['item']->id }})" --}}
                                        class="px-2 bg-gray-300">+10
                                </button>
                                <button type="button"
                                        {{--                                        @click="quantity++"--}}
                                        @click="quantity++;
                                            $wire.set('quantities.{{ $item['item']->id }}', quantity);
                                            quantities[{{ $item['item']->id }}] = quantity"
                                        {{--                                        wire:click="incrementQuantity({{ $item['item']->id }})" --}}
                                        class="px-2 bg-gray-300 ml-1">+
                                </button>
                            </div>
                        </div>


                        <!-- Цена -->
                        <div class="w-[10%] px-4 text-right text-sm ml-4 py-2">
{{--                            {{ number_format($item['item']->tsena3, 2, '.', '`') }}--}}
{{--                            <br/>--}}
{{--                            price: <span x-text="price.toFixed(2) + ' ₽'"></span>--}}
{{--                            <br/>--}}
{{--                            price: <span x-text="price"></span>--}}
{{--                            price: --}}
                            <span x-text="price.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '\'')"></span>
                        </div>

                        <!-- Сумма -->
                        <div class="w-[10%] px-4 text-right text-sm py-2">
{{--                            {{ number_format(round($item['quantity'] * $item['item']->tsena3, 2), 2, '.', '`') }}--}}
{{--                            <br/>--}}
{{--                           summa: <span x-text="(quantity * price).toFixed(2) + ' ₽'"></span>--}}
{{--                            <br/>--}}
{{--                           summa2: <span x-text="(quantity * price).toFixed(2).toLocaleString('ru-RU')"></span>--}}
{{--                            <br/>--}}
{{--                           summa2: --}}
                            <span x-text="(quantity * price).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '\'')"></span>
                        </div>
                    </div>
                @endforeach

                <!-- Общая сумма -->
                <div class="flex w-full font-semibold">
                    <div class="flex-1 px-4 py-2 border text-right">Итого:</div>
                    <div
                        class="w-[15%] px-4 py-2 border text-right">
                        {{ number_format(round(collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['item']->tsena3), 2), 2, '.', '`') }}
                        <br/>
                        <strong>Общая сумма:</strong>
                        <br/>
                        <span
                            x-text="Object.keys(quantities).reduce((total, id) => total + (quantities[id] * prices[id]), 0).toFixed(2) + ' ₽'"></span>
                        <br/>
                        22-<span x-text="total.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '\'')"></span>
                    </div>
                </div>

            </div>

            <!-- Данные покупателя -->
            <div class="mt-6 mb-10">
                <div class="w-[50%] mx-auto">
                    <h3 class="text-lg font-semibold">Данные покупателя</h3>
                    <label for="name">Имя:</label>
                    <input type="text"
                           required
                           wire:model="name" class="border p-2 w-full mb-2"/>

                    <label for="phone">Телефон:</label>
                    <input type="text"
                           required
                           wire:model="phone" class="border p-2 w-full mb-2"/>

                    <button class="bg-blue-500 text-white px-4 py-2 mt-2"
                            type="submit">Отправить заказ
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>
@endif
</div>
