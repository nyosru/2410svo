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

                @if( $row['uroven'] != 1 )
                    @continue
                @endif

                {{--                @if($index > 0)--}}
                <!-- Пропуск первой строки (заголовки) -->
                <tr>
                    {{--                        <td class="px-4 py-2 border border-gray-300">{{ $row[8] }}</td>--}}
                    {{--                        @foreach ($row as $cell)--}}
                    {{--                            @if( $k == 8 )--}}
                    {{--                                @continue--}}
                    {{--                            @endif--}}
                    <td class="px-4 py-2 border border-gray-300">
                        {{ $row['uroven'] }}
                        ({{ $row['children_count'] }})
                    </td>
                    <td class="px-4 py-2 border border-gray-300">{{ $row['firma'] }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $row['zateya'] }}
                        {{--                            <br/>--}}
                        {{--                                <span class="text-sm">{{ $row['comment'] }}</span>--}}
                    </td>
                    {{--                            <td class="px-4 py-2 border border-gray-300">{{ $row['mol'] }}</td>--}}

                    <td class="px-4 py-2 border border-gray-300">
                        <a class="text-blue-700 underline" href="{{ $row['mol_link'] }}"
                           target="_blank">{{ $row['mol_name'] }}</a>
                        <br/>
                        <nobr>
                            <a class="text-blue-700 underline" href="tel:{{ $row['mol_phone'] }}"
                               target="_blank">{{ $row['mol_phone'] }}</a>
                        </nobr>
                    </td>

                    {{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['mol_name'] }}</td>--}}
                    {{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['mol_link'] }}</td>--}}
                    {{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['mol_phone'] }}</td>--}}

                    <td class="px-4 py-2 border border-gray-300">{{ $row['doc'] }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $row['nom_str'] }}</td>

                    <td class="px-4 py-2 border border-gray-300">
                        {{ $row['name'] }}
                        <br/>
                        <span class="text-sm">
                            {{ $row['dops'] }}
                            </span>
                    </td>
                    {{--                        <td class="px-4 py-2 border border-gray-300">{{ $row['dops'] }}</td>--}}

                    <td class="px-4 py-2 border border-gray-300">{{ $row['comment'] }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        @if(!empty( $row['curica'] ))
                            <a
                                class="text-blue-700 underline"
                                href="{{ $row['curica'] }}" target="_blank">QR&nbsp;код для&nbsp;перевода</a>
                        @endif
                    </td>

                    <td class="px-4 py-2 border border-gray-300">{{ $row['site_tab'] }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $row['photo'] }}</td>

                    <td class="text-right px-4 py-2 border border-gray-300">{{ ( isset($row['debet_kon']) && $row['debet_kon'] > 0 ) ? number_format($row['debet_kon'],2,'.','`') : '-' }}</td>
                    <td class="text-right px-4 py-2 border border-gray-300">{{ ( isset($row['kredit_kon']) && $row['kredit_kon'] > 0 ) ? number_format($row['kredit_kon'],2,'.','`') : '-' }}</td>
                    <td class="text-right px-4 py-2 border border-gray-300">{{ ( isset($row['debet_kol_kon']) && $row['debet_kol_kon'] > 0 ) ? number_format($row['debet_kol_kon'],2,'.','`') : '-' }}</td>
                    <td class="text-right px-4 py-2 border border-gray-300">{{ ( isset($row['kredit_kol_kon']) && $row['kredit_kol_kon'] > 0 ) ? number_format($row['kredit_kol_kon'],2,'.','`') : '-' }}</td>


                    {{--                        @endforeach--}}
                </tr>
                {{--                @endif--}}
                @if( $row['children_count'] > 0 )
                    <tr>
                        <td colspan="20" ><div class="bg-orange-300 p-1 ml-[10px]"> подробнее </div></td>
                    </tr>
                @endif
@endforeach
</tbody>
</table>
@else
<p>Файл CSV не найден или пуст.</p>
@endif
</div>
