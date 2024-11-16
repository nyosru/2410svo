<div>
    @if(!empty($data))

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
            @foreach ($data as $data1)
                {{-- Передаём каждую строку данных в компонент строки таблицы --}}
                <livewire:svo.fin-data-table-tr :data1="$data1" :key="$loop->index"/>
            @endforeach
            </tbody>
        </table>


        <div class="my-4">
            {{ $data->links('svo.shop-pagination') }}
        </div>

    @else
        <p>Файл CSV не найден или пуст.</p>
        <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                wire:click="reloadFile">Загрузить файл повторно
        </button>
    @endif
</div>
