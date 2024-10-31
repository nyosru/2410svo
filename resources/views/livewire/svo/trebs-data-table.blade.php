<div>
    @if(!empty($data))
        <table class="table-auto w-full border-collapse border border-gray-300">

            @if(!empty($data_head))
                <thead>
                <tr>
                    <th class="px-4 py-2 border border-gray-300">{{ $data_head[8] }}</th>
                    @foreach ($data_head as $k => $header)

                        @if( $k == 8 )
                            @continue
                        @endif

                        <th class="px-4 py-2 border border-gray-300">{{$k}} / {{ $header }}</th>
                    @endforeach
                </tr>
                </thead>
            @endif

            <tbody>
            @foreach ($data as $index => $row)
                @if($index > 0)
                    <!-- Пропуск первой строки (заголовки) -->
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">{{ $row[8] }}</td>
                        @foreach ($row as $cell)
                            @if( $k == 8 )
                                @continue
                            @endif
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
