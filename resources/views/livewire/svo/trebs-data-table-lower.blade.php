<div>
    @foreach( $data as $row )

        <div class="flex flex-row xw-[1200px]
         w-[{{ 1200-(( $row['uroven'] ?? 1 )-1)*20 }}px]

        @if( $row['uroven'] > 1 )
        border-l-2 border-l-red
        @endif

        border-b-2
        py-5
        pl-2

        ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]">


            {{--            название--}}
            <div class="flex w-[{{ 810-(( $row['uroven'] ?? 1 )-1)*20 }}px]">
                <div>

                    @if( !empty($row['trebs_photo']) )

                        @foreach($row['trebs_photo'] as $tp)
                            @if( $tp['photo_url'] != $row['curica'] )
                                @if( !empty($tp['photo_loaded']['image_loaded']) && !empty($tp['photo_loaded']['preview_loaded']) )
                                    <img
                                        {{--                                    src="{{ $tp['photo_loaded']['image_loaded'] }}"--}}
                                        src="{{ $tp['photo_loaded']['preview_loaded'] }}"
                                        class="w-[150px] float-left mr-3 inline cursor-pointer rounded shadow hover:opacity-75 transition"
                                        onclick="showModal('{{ $tp['photo_loaded']['image_loaded'] }}')"
                                    />
                                    @break
                                @endif
                            @endif
                        @endforeach

                    @endif

                    <b>
                        @if( $row['uroven'] == 1 )
                            {{ $row['firma'] }}

                            @if( !empty( $row['mol_link'] ) )
                                <a class="text-blue-700 underline" href="{{ $row['mol_link'] }}" target="_blank">
                                    @endif
                                    {{ $row['mol_name'] }}
                                    @if( !empty( $row['mol_link'] ) )
                                </a>
                            @endif
                            @if( !empty($row['mol_phone'] ) )
                                <a class="pl-2 text-blue-700 underline" href="tel:{{ $row['mol_phone'] }}"
                                   target="_blank">
                                    {{--                                {{ $row['mol_phone'] }}--}}
                                    <img src="/icon/phone2.png" class="inline w-[46px]"
                                         title="Позвонить {{ $row['mol_phone'] }}"/>
                                </a>
                            @endif

                        @elseif( $row['uroven'] == 2 )

                            {{ $row['zateya'] ?? ''}}

                            @if( !empty( $row['mol_link'] ) )
                                <a class="text-blue-700 underline" href="{{ $row['mol_link'] }}" target="_blank">
                                    @endif
                                    {{ $row['mol_name'] }}
                                    @if( !empty( $row['mol_link'] ) )
                                </a>
                            @endif
                            @if( !empty($row['mol_phone'] ) )
                                <a class="pl-2 text-blue-700 underline" href="tel:{{ $row['mol_phone'] }}"
                                   target="_blank">
                                    {{--                                {{ $row['mol_phone'] }}--}}
                                    <img src="/icon/phone2.png" class="inline w-[46px]"
                                         title="Позвонить {{ $row['mol_phone'] }}"/>
                                </a>
                            @endif

                        @elseif( $row['uroven'] == 3 )

                            {{$row['doc'] ?? ''}}

                            @if( !empty( $row['mol_link'] ) )
                                <a class="text-blue-700 underline" href="{{ $row['mol_link'] }}" target="_blank">
                                    @endif
                                    {{ $row['mol_name'] }}
                                    @if( !empty( $row['mol_link'] ) )
                                </a>
                            @endif
                            @if( !empty($row['mol_phone'] ) )
                                <a class="pl-2 text-blue-700 underline" href="tel:{{ $row['mol_phone'] }}"
                                   target="_blank">
                                    {{--                                {{ $row['mol_phone'] }}--}}
                                    <img src="/icon/phone2.png" class="inline w-[46px]"
                                         title="Позвонить {{ $row['mol_phone'] }}"/>
                                </a>
                            @endif

                        @elseif( $row['uroven'] == 4 )

                            {{$row['name'] ?? ''}} {{$row['dops'] ?? ''}}
                            <br/>
                            <span class="text-[12px]" style="font-weight: normal;">
                            {{$row['doc'] ?? ''}} ,
                            {{$row['nom_str'] ?? ''}}
                            </span>

                        @endif

                    </b>
                        @if( !empty($item->site_tab) )
                            <br/><a href="{{ $item->site_tab }}" class="underline text-blue-500" target="_blank">{{ parse_url($item->site_tab, PHP_URL_HOST) }}</a>
                        @endif
                    {{--                    @if( $row['comment'] )--}}
                    {{--                        <br/>--}}
                    {{--                        <span class="text-[14px]">--}}
                    {{--                            Комментарий: --}}
                    {{--                            {{ $row['comment'] ?? '' }}--}}
                    {{--    </span>--}}
                    {{--                    @endif--}}
                    {{--                    @if( !empty($row['name']) || !empty($row['dops']) )--}}
                    {{--                        <br/>--}}

                    {{--                    @endif--}}
                    {{--                    @if( !empty($row['zateya']) )--}}
                    {{--                        <br/>--}}
                    {{--                        {{ $row['zateya'] ?? ''}}--}}
                    {{--                    @endif--}}

                </div>
            </div>

            <div class="w-[120px]">
                {{ (isset($row['debet_kon']) && $row['debet_kon'] <> 0) ? number_format($row['debet_kon'],2,'.','`') : '-' }}
                <br/>
                Кол: {{ (isset($row['debet_kol_kon']) && $row['debet_kol_kon'] <> 0) ? number_format($row['debet_kol_kon'],2,'.','`') : '-' }}
            </div>
            <div class="w-[120px]">
                {{ (isset($row['kredit_kon']) && round( (float) $row['kredit_kon']) <> 0) ? number_format($row['kredit_kon'],2,'.','`') : '-' }}
                <br/>
                Кол: {{ (isset($row['kredit_kol_kon']) && round( (float) $row['kredit_kol_kon']) <> 0) ? number_format($row['kredit_kol_kon'],2,'.','`') : '-' }}
            </div>


            {{--            кнопки--}}
            <div class="w-[150px] px-2">


                @if( !empty( $row['curica'] ) && !empty($row['qr_loaded']['image_loaded']) )

                    <A href="#{{$row['curica']}}"
                       {{--                           wire:click.prevent="switchQr({{$row['id']}})"--}}
                       onclick="toggleBlock('qr{{ $row['id'] }}'); return false;"
                       class="px-2 py-1 text-black block text-center rounded bg-yellow-300">Помощь</A>

                    {{--                        @if( isset($show_qr[$row['id']]) && $show_qr[$row['id']] )--}}
                    {{--                            @if(!empty($row['qr_loaded']['image_loaded']) )--}}
                    <div id="qr{{ $row['id'] }}" style="display: none;"
                         class="mt-2 table-animate">
                        <img src="{{ $row['qr_loaded']['image_loaded'] }}" class="mx-auto w-[120px]"/>
                    </div>
                @endif

                @if( !empty( $row['b_i_k'] ) )
                    <a href="#"
                       onclick="toggleBlock('ul{{ $row['id'] }}'); return false;"
                       class="mt-1 px-2 py-1 text-black block text-center rounded bg-green-300"
                    >
                        От ЮЛ
                    </a>
                @endif


                {{--                    Аналог--}}
                @if( !empty($row['analog'] ) )
                    <a href="#"
                       onclick="toggleBlock('analog{{ $row['id'] }}'); return false;"
                       class="mt-1 px-2 py-1 text-black block text-center rounded bg-orange-300"
                    >Аналог</a>

                @endif


            </div>
        </div>








        @if(1==2)

            {{--        <pre style="max-height: 350px; overflow: auto;">--}}
            {{--                        {{ print_r($row,true) }}--}}
            {{--        </pre>--}}

            <div class="flex flex-row hover:bg-gray-100  ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]
@if($row['uroven'] > 1) border-l border-l-[10px] border-orange-200 @endif
">
                <div class="flex flex-col flex-grow">
                    <div class="p-1 text-left border border-gray-300">
                        {{ $row['firma'] }}
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

                        {{$row['site_tab'] ?? ''}} &nbsp;

                        @if( !empty($row['trebs_photo']) )
                            <br/>

                            {{--                        <div class="container mx-auto p-4">--}}
                            <!-- Галерея превью -->
                            {{--                            <div class="grid grid-cols-3 gap-4">--}}
                            {{--                                <img--}}
                            {{--                                    src="preview1.jpg"--}}
                            {{--                                    alt="Preview 1"--}}
                            {{--                                    class="cursor-pointer rounded shadow hover:opacity-75 transition"--}}
                            {{--                                    onclick="showModal('fullsize1.jpg')"--}}
                            {{--                                />--}}
                            {{--                                <img--}}
                            {{--                                    src="preview2.jpg"--}}
                            {{--                                    alt="Preview 2"--}}
                            {{--                                    class="cursor-pointer rounded shadow hover:opacity-75 transition"--}}
                            {{--                                    onclick="showModal('fullsize2.jpg')"--}}
                            {{--                                />--}}
                            {{--                                <img--}}
                            {{--                                    src="preview3.jpg"--}}
                            {{--                                    alt="Preview 3"--}}
                            {{--                                    class="cursor-pointer rounded shadow hover:opacity-75 transition"--}}
                            {{--                                    onclick="showModal('fullsize3.jpg')"--}}
                            {{--                                />--}}

                            {{--                        <pre class="text-left text-[10px]" style="overflow: auto; max-height: 150px;">--}}
                            {{--{{ print_r($row['trebs_photo']) }}--}}
                            {{--                            {{ print_r($row) }}--}}
                            {{--                        </pre>--}}

                            @foreach($row['trebs_photo'] as $tp)
                                @if( $tp['photo_url'] != $row['curica'] )
                                    @if( !empty($tp['photo_loaded']['image_loaded']) && !empty($tp['photo_loaded']['preview_loaded']) )
                                        <img
                                            {{--                                    src="{{ $tp['photo_loaded']['image_loaded'] }}"--}}
                                            src="{{ $tp['photo_loaded']['preview_loaded'] }}"
                                            class="w-[150px] inline cursor-pointer rounded shadow hover:opacity-75 transition"
                                            onclick="showModal('{{ $tp['photo_loaded']['image_loaded'] }}')"
                                        />
                                    @endif
                                @endif
                            @endforeach

                            {{--                        </div>--}}

                        @endif


                    </div>
                    {{--            <div class="flex-1 p-2 text-center">КодТ</div>--}}


                </div>

                <div class="w-[110px]">
                    <div class="flex flex-col w-[110px]">
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full h-[15px]">
                            {{ (isset($row['debet_kon']) && $row['debet_kon'] <> 0) ? number_format($row['debet_kon'],2,'.','`') : '-' }}
                        </div>
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                            {{ (isset($row['debet_kol_kon']) && $row['debet_kol_kon'] <> 0) ? number_format($row['debet_kol_kon'],2,'.','`') : '-' }}
                        </div>
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">&nbsp;</div>

                    </div>
                </div>
                <div class="w-[110px] ">
                    <div class="flex flex-col w-[110px] ">
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                            {{ (isset($row['kredit_kon']) && round( (float) $row['kredit_kon']) <> 0) ? number_format($row['kredit_kon'],2,'.','`') : '-' }}
                        </div>
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                            {{ (isset($row['kredit_kol_kon']) && round( (float) $row['kredit_kol_kon']) <> 0) ? number_format($row['kredit_kol_kon'],2,'.','`') : '-' }}
                        </div>
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">&nbsp;</div>
                    </div>
                </div>
                <div class="w-[110px] ">
                    <div class="flex flex-col w-[110px] ">
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">

                            {{--                    @if( !empty( $row['curica'] ) && empty($row['qr_loaded']['image_loaded']) )--}}
                            {{--                        файл qr кода {{ $row['curica'] }} не загружен--}}
                            {{--                    @endif--}}

                            {{--                    <nobr>--}}
                            {{--                        <input type="text" value="{{$row['curica']}}" class="w-full"/>--}}
                            {{--                    </nobr>--}}

                            @if( !empty( $row['curica'] ) && !empty($row['qr_loaded']['image_loaded']) )

                                <A href="#{{$row['curica']}}"
                                   {{--                           wire:click.prevent="switchQr({{$row['id']}})"--}}
                                   onclick="toggleBlock('qr{{ $row['id'] }}'); return false;"
                                   class="text-blue-700 underline" target="_blank">QR&nbsp;код для&nbsp;перевода</A>

                                {{--                        @if( isset($show_qr[$row['id']]) && $show_qr[$row['id']] )--}}
                                {{--                            @if(!empty($row['qr_loaded']['image_loaded']) )--}}
                                <div id="qr{{ $row['id'] }}" style="display: none;" class="mt-2 table-animate">
                                    <img src="{{ $row['qr_loaded']['image_loaded'] }}" class="mx-auto w-[120px]"/>
                                </div>
                                {{--                            @endif--}}
                                {{--                        @endif--}}

                            @else
                                -
                            @endif

                        </div>
                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">

                            @if( !empty( $row['b_i_k'] ) )
                                <a href="#"
                                   {{--                           wire:click.prevent="switchForUl({{ $row['id'] }})"--}}
                                   onclick="toggleBlock('ul{{ $row['id'] }}'); return false;"
                                   class="text-blue-500 underline hover:text-blue-700">
                                    Для ЮЛ
                                </a>
                            @else
                                -
                            @endif

                        </div>

                        <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                            {{--                    Аналог--}}
                            @if( !empty($row['analog'] ) )
                                <a href="#"
                                   {{--                           wire:click.prevent="switchAnalogi({{$row['id']}})"--}}
                                   onclick="toggleBlock('analog{{ $row['id'] }}'); return false;"
                                   class="text-blue-700 underline">Аналог</a>
                            @else
                                -
                            @endif

                        </div>
                    </div>
                </div>
                {{--            <div class="flex flex-col w-[110px] p-1 text-center border border-gray-300">--}}
                {{--                {{$row['uroven'] ?? '-'}}--}}
                {{--            </div>--}}

            </div>
            {{--        {{ print_r($row,true) }}--}}

        @endif










        {{--        @if( isset($show_analogi[$row['id']]) && $show_analogi[$row['id']] )--}}
        @if( !empty($row['analog'] ) )
            <div class="m-2" id="analog{{ $row['id'] }}" style="display: none;">

                <div class="flex flex-row-reverse">
                    <div class="bg-orange-100 p-6 rounded-lg shadow-lg w-[600px] table-animate ">

<span
    onclick="toggleBlock('analog{{ $row['id'] }}'); return false;"
    class="float-right cursor-pointer text-white py-1 px-2 rounded bg-red-200 hover:bg-red-600 text-[10px]">
X
</span>
                        Аналог:<br/>
                        {!! $row['analog'] !!}

                    </div>
                </div>
            </div>
        @endif

        {{--    для ЮЛ--}}
        @if( !empty( $row['b_i_k'] ) )
            @include('livewire.svo.trebs-data-table-lower-ul',['row'=>$row] )
        @endif






        @if(!empty($row['children_count']) && $row['children_count'] > 0)
            <div class="xp-2 ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]" style="margin-top: -15px;">

                <a href="#"
                   wire:click.prevent="switchPodrobnee({{ $row['id'] }})">
                    @if(isset($show_podrobnee[$row['id']]) && $show_podrobnee[$row['id']])
                        <img src="/icon/minus.png" class="h-[24px] inline"/>
                    @else
                        <img src="/icon/plus.svg" class="h-[24px] inline"/>
                    @endif
                </a>
                <span wire:loading wire:target="switchPodrobnee({{ $row['id'] }})"
                      class="hidden text-gray-500 ml-2">
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
                    {{--                    @if( !empty( $row['curica'] ) )--}}
                    {{--                        <A href="{{$row['curica']}}"--}}
                    {{--                           class="text-blue-700 underline" target="_blank">Оплатить по QR</A>--}}
                    {{--                    @endif--}}
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
