<div>

{{--    {{ print_r($data_head) }}--}}
{{--    ------}}
{{--    {{ print_r($data) }}--}}

    @if(!empty($data))
        <table class="table-auto w-full border-collapse border border-gray-300">

            @if(!empty($data_head))
                <thead>
                <tr>
{{--                    <th class="px-4 py-2 border border-gray-300">{{ $data_head[8] }}</th>--}}
                    @foreach ($data_head as $k => $header)
{{--                        @if( $k == 8 )--}}
{{--                            @continue--}}
{{--                        @endif--}}
                        <th class="px-4 py-2 border border-gray-300">
{{--                            {{$k}} / --}}
                            {{ $header }}</th>
                    @endforeach
                </tr>
                </thead>
            @endif

            <tbody>
{{--            @foreach ($data as $index => $row)--}}
{{--                <tr><td>{{ print_r($row) }}</td></tr>--}}
{{--            @endforeach--}}

            @foreach ($data as $index => $row)
{{--                @if($index > 0)--}}
                    <!-- Пропуск первой строки (заголовки) -->
                    <tr>
{{--                        <td class="px-4 py-2 border border-gray-300">{{ $row[8] }}</td>--}}
{{--                        @foreach ($row as $cell)--}}
{{--                            @if( $k == 8 )--}}
{{--                                @continue--}}
{{--                            @endif--}}
                            <td class="px-4 py-2 border border-gray-300">{{ $row['firma'] }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $row['zateya'] }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $row['mol'] }}</td>
{{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['mol_name'] }}</td>--}}
{{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['mol_link'] }}</td>--}}
{{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['mol_phone'] }}</td>--}}
                        <td class="px-4 py-2 border border-gray-300">{{ $row['doc'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['nom_str'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['name'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['dops'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['comment'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['curica'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['site_tab'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['photo'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['debet_kon'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['kredit_kon'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['debet_kol_kon'] }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $row['kredit_kol_kon'] }}</td>


{{--                        @endforeach--}}
                    </tr>
{{--                @endif--}}
            @endforeach
            </tbody>
        </table>
    @else
        <p>Файл CSV не найден или пуст.</p>
    @endif
</div>
