<div>
    @foreach( $data as $row )
        <div class="flex flex-row xbg-gray-200  ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]
         @if($row['uroven'] > 1) border-l border-l-[10px] border-orange-200 @endif
        ">
            <div class="flex flex-col flex-grow">
                <div class="p-1 text-center border border-gray-300">
                    {{--                    {{ print_r($row,true) }}--}}
                    {{--                    <br/>--}}
                    {{--                    <br/>--}}
                    {{ $row['firma'] }}
                    {{--                    {{ $row['mol_name'] }}--}}
                    {{--                    {{ $row['mol_phone'] }}--}}

                    @if( !empty( $row['mol_link'] ) )
                        <a class="text-blue-700 underline" href="{{ $row['mol_link'] }}" target="_blank">
                            @endif
                            {{ $row['mol_name'] }}
                            @if( !empty( $row['mol_link'] ) )
                        </a>
                    @endif
                    &nbsp;
                    @if( !empty($row['mol_phone'] ) )
                        <a class="text-blue-700 underline" href="tel:{{ $row['mol_phone'] }}" target="_blank">
                            {{ $row['mol_phone'] }}
                        </a>
                    @endif
                    {{ $row['comment'] ?? '' }}

                </div>
                <div class="flex flex-row ">
                    <div
                        class="flex-1 p-1 text-center border border-gray-300">{{$row['name'] ?? ''}} {{$row['dops'] ?? ''}}</div>
                    <div class="flex-1 p-1 text-center border border-gray-300">
                        {{$row['zateya'] ?? ''}} &nbsp;
                    </div>

                </div>
                <div class="flex-1 p-1 text-center border border-gray-300">
                    {{$row['site_tab'] ?? ''}} &nbsp;</div>
                {{--            <div class="flex-1 p-2 text-center">КодТ</div>--}}

            </div>
            <div class="flex flex-col w-[110px]">
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    {{ (isset($row['debet_kon']) && $row['debet_kon'] <> 0) ? number_format($row['debet_kon'],2,'.','`') : '-' }}
                </div>
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    {{ (isset($row['debet_kon']) && $row['debet_kon'] <> 0) ? number_format($row['debet_kol_kon'],2,'.','`') : '-' }}
                </div>
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">&nbsp;</div>
            </div>
            <div class="flex flex-col w-[110px] ">
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    {{ (isset($row['debet_kon']) && round( (float) $row['debet_kon']) <> 0) ? number_format($row['kredit_kon'],2,'.','`') : '-' }}
                </div>
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    {{ (isset($row['debet_kon']) && round( (float) $row['debet_kon']) <> 0) ? number_format($row['kredit_kol_kon'],2,'.','`') : '-' }}
                </div>
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">&nbsp;</div>
            </div>
            <div class="flex flex-col w-[110px] ">
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">

                    @if( !empty( $row['curica'] ) )
                        <A href="{{$row['curica']}}"
                           class="text-blue-700 underline" target="_blank">Курица</A>
                    @else
                        -
                    @endif

                </div>
                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    -
                    {{--                    Для ЮЛ--}}
                </div>

                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    {{--                    Аналог--}}
                </div>
            </div>
            <div class="flex flex-col w-[110px] p-1 text-center border border-gray-300">
                {{$row['uroven'] ?? '-'}}
            </div>

        </div>
        {{--        {{ print_r($row,true) }}--}}

        @if(!empty($row['children_count']) && $row['children_count'] > 0)
            <div class="bg-orange-200 p-2 rounded ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]">

                <a class="text-blue-700 underline" href="#"
                   wire:click.prevent="switchPodrobnee({{ $row['id'] }})">Подробнее @if(isset($show_podrobnee[$row['id']]) && $show_podrobnee[$row['id']])
                        ( скрыть )
                    @endif </a>

                <span wire:loading wire:target="switchPodrobnee({{ $row['id'] }})" class="hidden text-gray-500 ml-2">
                    Загружаю...
                </span>


            </div>

            @if( isset($show_podrobnee[$row['id']]) && $show_podrobnee[$row['id']] )
                <div wire:key="details-{{ $row['id'] }}">
                    <livewire:svo.trebs-data-table-lower
                        :key="$row['id']"
                        :up_id="$row['id']"
                        :up_uroven="$row['uroven']"
                    />
                </div>
            @endif
        @endif
    @endforeach
</div>


@if(1==2)
    <div class="block w-[1200px] mx-auto pl-[{{ (( $row['uroven'] ?? 1 )-1)*40 }}px]">

        @if( empty($upup) && !empty($data_head))
            <div class="flex flex-row gap-2 bg-gray-200 p-2 rounded" style="position:sticky; top: 60px;">
                @foreach ($data_head as $l => $header)
                    @if( $l <= 3)
                        <div class="basis-[200px] font-bold text-center"
                            {{--                         style="border-right: 1px solid gray;"--}}
                        >
                            {{--                        {{ $l }}/--}}
                            {!! $header  !!}</div>
                    @else
                        <div class="basis-[150px] font-bold text-center"
                            {{--                         @if($l<=6) style="border-right: 1px solid gray;" @endif --}}
                        >{!! $header  !!}</div>
                    @endif
                @endforeach
            </div>
        @endif

        @foreach( $data as $row )
            <div class="flex flex-row gap-2 bg-gray-100 p-2 rounded
                        ml-[{{ ($row['uroven']-1)*40 }}px]
                        mb-[2px]
                        "
                 style="border-left: 2px solid orange;"
            >

                {{--            {{ print_r($row) }}--}}

                <div class="basis-[{{ 200 - (( $row['uroven'] ?? 1 )-1)*40 }}px] ">
                    @if( $row['uroven'] == 1 )
                        {{--                    {{ $row['id'] }} / {{ $row['uroven'] }} <br/>--}}
                        {{ $row['firma'] }}
                    @endif
                </div>

                <div class="basis-[200px] ">
                    {{ $row['zateya'] }}
                    <br/>
                    @if( !empty( $row['curica'] ) )
                        <A href="{{$row['curica']}}"
                           class="text-blue-700 underline" target="_blank">Оплатить по QR</A>
                    @endif
                </div>


                {{--            <div class="basis-1/6">--}}
                <div class="basis-[200px] ">
                    {{--            <div class="flex-1">--}}
                    {{ $row['name'] }}
                    <br/>
                    <span class="text-sm">{{ $row['dops'] }}</span>
                </div>

                {{--            <div class="basis-1/6">--}}
                <div class="basis-[200px] text-center">
                    {{--            <div class="flex-1">--}}
                    @if( !empty( $row['mol_link'] ) )
                        <a class="text-blue-700 underline" href="{{ $row['mol_link'] }}" target="_blank">
                            @endif
                            {{ $row['mol_name'] }}
                            @if( !empty( $row['mol_link'] ) )
                        </a>
                    @endif
                    <br/>
                    <a class="text-blue-700 underline" href="tel:{{ $row['mol_phone'] }}" target="_blank">
                        {{ $row['mol_phone'] }}
                    </a>
                </div>


                {{--            <div class="flex-1">--}}
                {{--            <div class="basis-1/8">--}}
                <div class="basis-[150px] text-right">
                    {{ (isset($row['debet_kon']) && $row['debet_kon'] > 0) ? number_format($row['debet_kon'],2,'.','`') : '-' }}
                    <br/>
                    {{ (isset($row['debet_kol_kon']) && $row['debet_kol_kon'] > 0) ? number_format($row['debet_kol_kon'],2,'.','`') : '-' }}
                </div>
                {{--            <div class="flex-1">--}}
                {{--            <div class="basis-1/8">--}}
                <div class="basis-[150px]  text-right">
                    {{ (isset($row['kredit_kon']) && $row['kredit_kon'] > 0) ? number_format($row['kredit_kon'],2,'.','`') : '-' }}
                    <br/>
                    {{ (isset($row['kredit_kol_kon']) && $row['kredit_kol_kon'] > 0) ? number_format($row['kredit_kol_kon'],2,'.','`') : '-' }}
                </div>

            </div>

            @if(1==2)
                <div class="flex flex-row gap-2 bg-gray-200 p-2 rounded
ml-[{{ ($row['uroven']-1)*40 }}px]
"
                     style="border-left: 2px solid orange;"
                >

                    {{--            <tr>--}}
                    {{--                <td colspan="10">--}}
                    <div class="basis-1/2">
                        $data_row: {{ print_r($row) }}
                        {{--                <br/>--}}
                        {{--                <br/>--}}
                        {{--                <br/>--}}
                    </div>
                    {{--                </td>--}}
                    {{--            </tr>--}}

                </div>
                {{--    <div>--}}
            @endif

            @if(!empty($row['children_count']) && $row['children_count'] > 0)
                <div class="bg-orange-200 p-2 rounded ml-[{{ (( $row['uroven'] ?? 1 )-1)*40 }}px]">
                    <a class="text-blue-700 underline" href="#"
                       wire:click.prevent="switchPodrobnee({{ $row['id'] }})">Подробнее @if(isset($show_podrobnee[$row['id']]) && $show_podrobnee[$row['id']])
                            ( скрыть )
                        @endif </a>
                    {{--                @if(isset($loading_details[$row['id']]) && $loading_details[$row['id']])--}}
                    <span wire:loading wire:target="switchPodrobnee({{ $row['id'] }})"
                          class="hidden text-gray-500 ml-2">
Загружаю...
</span>
                    {{--                @endif--}}
                </div>

                @if( isset($show_podrobnee[$row['id']]) && $show_podrobnee[$row['id']] )
                    <div wire:key="details-{{ $row['id'] }}">
                        <livewire:svo.trebs-data-table-lower
                            :key="$row['id']"
                            :up_id="$row['id']"
                            :up_uroven="$row['uroven']"
                        />
                    </div>
                @endif
            @endif
        @endforeach

    </div>
@endif
