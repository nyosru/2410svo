<div>
    @if(!empty($data0))

        <style>
            .fin-tab thead {
                position: sticky;
                top: 60px;
                z-index: 10;
            }

            .fin-tab thead th:nth-child(2n) {
                background-color: rgb(245, 245, 245);
            }
        </style>

        <input type="text" wire:model.live="search" placeholder="Поиск по наименованию"
               class="px-4 py-2 border border-gray-300 rounded mb-4"/>

        <table class="fin-tab table-auto w-full border-collapse border border-gray-300">
            @if(!empty($data_head))
                <thead>
                <tr class="bg-white">
                    @foreach ($data_head as $header)
                        <th class="px-4 py-2 border border-gray-300">
                            {!! $header !!}
                        </th>
                    @endforeach
                </tr>
                </thead>
            @endif

            <tbody>

            {{--            {{dd($data['items'])}}--}}
            {{--            {{ dd($data->items()) }}--}}

            {{--                        @foreach ($data0 as $data1)--}}
            @foreach ($data0 as $data1)
                {{--                                {{ dd($data1) }}--}}
                {{--                --}}{{--                {{ dd($data1->id) }}--}}
                {{--                --}}{{-- Передаём каждую строку данных в компонент строки таблицы --}}
                <livewire:svo.fin-data-table-tr :data1="$data1" :key="$loop->index"/>
            @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{--                        {{ $data->links('svo.shop-pagination') }}--}}
            {{--            {{ $pagination->links('svo.shop-pagination') }}--}}
{{--            {{ $pagination->links($paginationView) }}--}}
            {{ $data0->links($paginationView) }}
        </div>

    @else
        <p>Данные не найдены ...</p>
        {{--        <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"--}}
        {{--                wire:click="reloadFile">Загрузить файл повторно--}}
        {{--        </button>--}}
    @endif
</div>
