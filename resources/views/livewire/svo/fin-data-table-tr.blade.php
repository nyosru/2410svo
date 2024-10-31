<tbody>
<tr>
    @foreach ($data1 as $k => $h)
        @if( $k == 0 || $k == 2 || $k == 4 || $k == 6 || $k == 8  || $k == 10 || $k == 13 || $k == 14 || $k == 15 || $k == 16 || $k == 17 || $k == 18 )
            <td class="px-4 py-2 border border-t-2 border-t-gray-500">
                {{--                                {{ $k }} / --}}
                {{ $h }}</td>
        @endif
    @endforeach
    @foreach ($data1 as $k => $h)
        @if( $k == 12 )
            <td class="px-4 py-2 border border-t-2 border-t-gray-500">
                {{--                                {{ $k }} / --}}
                {{ $h }}</td>
        @endif
    @endforeach
</tr>
<tr>
    @foreach ($data1 as $k => $h)
        @if( $k == 1 || $k == 3 || $k == 5 || $k == 7 || $k == 9 || $k == 11 || $k == 19 || $k == 20 || $k == 21 || $k == 22 || $k == 23 || $k == 24 )
            <td class="px-4 py-2 border ">
                {{--                                {{ $k }} / --}}
                {{ $h }}</td>
        @endif
    @endforeach
</tr>
</tbody>
