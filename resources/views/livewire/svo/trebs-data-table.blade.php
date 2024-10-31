<div>
    @if(!empty($data))
        <table class="table-auto w-full border-collapse border border-gray-300">

            @if(!empty($data_head))
                <thead>
                <tr>
                    @foreach ($data_head as $header)
                        <th class="px-4 py-2 border border-gray-300">{{ $header }}</th>
                    @endforeach
                </tr>
                </thead>
            @endif

            <tbody>
            @foreach ($data as $index => $row)
                @if($index > 0)
                    <!-- Пропуск первой строки (заголовки) -->
                    <tr>
                        @foreach ($row as $cell)
                            <td class="px-4 py-2 border border-gray-300">{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <p>Файл CSV не найден или пуст.</p>
    @endif
</div>
