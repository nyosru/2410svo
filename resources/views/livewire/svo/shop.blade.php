<div>
    @if(!empty($data))
        <table class="table-auto w-full border-collapse border border-gray-300">

            @if( 1 == 2 && !empty($data_head))
                <thead>

                {{--                <tr>--}}
                {{--                    @foreach ($data_head as $k => $header)--}}
                {{--                        <th class="px-4 py-2 border border-gray-300">{{ $k }} / {{ $header }}</th>--}}
                {{--                    @endforeach--}}
                {{--                </tr>--}}

                <tr>
                    <th>0</th>
                    @foreach ($data_head as $k => $header)
                        {{--                        @if( $k == 0 || $k == 2 || $k == 4 || $k == 6 || $k == 8  || $k == 10 || $k == 13 || $k == 14 || $k == 15 || $k == 16 || $k == 17 || $k == 18 )--}}
                        <th class="px-4 py-2 border border-gray-300">
                            {{ $k }} /
                            {{ $header }}</th>
                        {{--                        @endif--}}
                    @endforeach
                    {{--                    @foreach ($data_head as $k => $header)--}}
                    {{--                        @if( $k == 12 )--}}
                    {{--                            <th class="px-4 py-2 border border-gray-300">--}}
                    {{--                                --}}{{--                                {{ $k }} / --}}
                    {{--                                {{ $header }}</th>--}}
                    {{--                        @endif--}}
                    {{--                    @endforeach--}}
                </tr>
                {{--                <tr>--}}
                {{--                    @foreach ($data_head as $k => $header)--}}
                {{--                        @if( $k == 1 || $k == 3 || $k == 5 || $k == 7 || $k == 9 || $k == 11 || $k == 19 || $k == 20 || $k == 21 || $k == 22 || $k == 23 || $k == 24 )--}}
                {{--                            <th class="px-4 py-2 border border-gray-300">--}}
                {{--                                --}}{{--                                {{ $k }} / --}}
                {{--                                {{ $header }}</th>--}}
                {{--                        @endif--}}
                {{--                    @endforeach--}}
                {{--                </tr>--}}

                </thead>
            @endif

{{--            {{ dd($data) }}--}}
            {{--            <tbody>--}}
            @foreach ($data as $data1)
                <livewire:svo.shop-tr :item=$data1 />
            @endforeach
            {{--            </tbody>--}}
        </table>
    @else
        <p>Файл CSV не найден или пуст.</p>
    @endif
</div>
