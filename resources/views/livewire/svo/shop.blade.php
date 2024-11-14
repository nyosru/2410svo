<div>
    <div class="py-3 text-center">
        Быстрый поиск: <input wire:model.live="search" type="text" class="border border-2 p-1"/>
    </div>
    {{--    {{ $search }}--}}
    {{--    {{ count($data1)  }}--}}
    @if(count($data1) > 0 )

        <div class="container mx-auto my-1 lg:w-[80%]">

            <div
                style="position: sticky; xtop: 60px;"
                class="flex flex-col md:flex-row items-center border-b border-gray-300 py-2 px-2 bg-gray-200 top-[127px] md:top-[60px]">
                <!-- Фото товара -->
                <div class="flex-shrink-0 w-24 h-2">
                    &nbsp;
                </div>

                <!-- Информация о товаре -->
                <div class="flex flex-col justify-between ml-4 flex-grow">
                    <div class="text-lg font-semibold">
                       Наименование
                    </div>
                </div>

                <!-- Блок для каждой цены с фиксированной шириной -->
                <div class="flex ml-4 space-x-2">
                    <div class="text-lg font-semibold text-right pr-2" style="width: 100px;">цена1</div>
                    <div class="text-lg font-semibold text-right pr-2" style="width: 100px;">цена2</div>
                    <div class="text-lg font-semibold text-right pr-2" style="width: 100px;">цена3</div>
                </div>

                <!-- Блок для кнопок -->
                <div class="xflex xitems-center collapse md:visible md:w-[150px]">
                    &nbsp;
                </div>


            </div>


            @foreach ($data1 as $index=>$data12)
                {{--                {{ print_r($data1) }}--}}
                {{--{{ $data12->name }}--}}
                {{--<br/>--}}
                {{--            @foreach ($data as $data1)--}}
                {{--                                {{ dd($data1) }}--}}
                <livewire:svo.shop-tr :item=$data12
                                      :key="$data12->id"
                                      :nn="$index"
                />
            @endforeach
{{--            </tbody>--}}
{{--        </table>--}}

            <div class="my-6">
                {{ $data1->links($paginationView) }}
            </div>
        </div>

    @else
        <p class="text-center bg-yellow-300 p-5 rounded">Товаров не найдено ({{ $search }})</p>
    @endif
</div>
