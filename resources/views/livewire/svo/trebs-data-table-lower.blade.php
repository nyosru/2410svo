<div>
    @foreach( $data as $row )

        {{--        <pre style="max-height: 350px; overflow: auto;">--}}
        {{--                        {{ print_r($row,true) }}--}}
        {{--        </pre>--}}

        <div class="flex flex-row hover:bg-gray-100  ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]
         @if($row['uroven'] > 1) border-l border-l-[10px] border-orange-200 @endif
        ">
            <div class="flex flex-col flex-grow">
                <div class="p-1 text-center border border-gray-300">
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
                    <br/>

                    @if( !empty($row['trebs_photo']) )

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




                        @foreach($row['trebs_photo'] as $tp)
                            {{--                            @if( !empty($tp['photo_loaded']['image_loaded']) )--}}
                            @if( !empty($tp['photo_loaded']['image_loaded']) && !empty($tp['photo_loaded']['preview_loaded']) )

                                <img
                                    {{--                                    src="{{ $tp['photo_loaded']['image_loaded'] }}"--}}
                                    src="{{ $tp['photo_loaded']['preview_loaded'] }}"
                                    class="w-[150px] inline cursor-pointer rounded shadow hover:opacity-75 transition"
                                    onclick="showModal('{{ $tp['photo_loaded']['image_loaded'] }}')"
                                />
                                {{--                                        <img--}}
                                {{--                                            src="preview1.jpg"--}}
                                {{--                                            alt="Preview 1"--}}
                                {{--                                            class="cursor-pointer rounded shadow hover:opacity-75 transition"--}}
                                {{--                                            onclick="showModal('fullsize1.jpg')"--}}
                                {{--                                        />--}}

                            @endif
                        @endforeach


                        {{--                            </div>--}}

                        <!-- Модальное окно -->
                        <div
                            id="imageModal"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
                            onclick="hideModal()"
                        >
                            <div class="relative bg-white p-4 rounded shadow-lg max-w-4xl">
                                {{--                                    <button--}}
                                {{--                                        class="absolute top-2 right-2 text-gray-600 hover:text-gray-800"--}}
                                {{--                                        onclick="hideModal(event)"--}}
                                {{--                                    >--}}
                                {{--                                        ✕--}}
                                {{--                                    </button>--}}
                                <img id="modalImage" src="" alt="Full-size" class="rounded max-w-full max-h-screen"/>
                            </div>
                        </div>
                        {{--                        </div>--}}

                    @endif


                </div>
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

                    {{--                    @if( !empty( $row['curica'] ) && empty($row['qr_loaded']['image_loaded']) )--}}
                    {{--                        файл qr кода {{ $row['curica'] }} не загружен--}}
                    {{--                    @endif--}}

                    @if( !empty( $row['curica'] ) && !empty($row['qr_loaded']['image_loaded']) )

                        <A href="{{$row['curica']}}"
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
                    @endif

                </div>

                <div class="flex-1 p-1 text-center border border-gray-300 w-full">
                    {{--                    Аналог--}}
                    @if( !empty($row['analog'] ) )
                        <a href="#"
                           {{--                           wire:click.prevent="switchAnalogi({{$row['id']}})"--}}
                           onclick="toggleBlock('analog{{ $row['id'] }}'); return false;"
                           class="text-blue-700 underline">Аналог</a>
                    @endif

                </div>
            </div>
            <div class="flex flex-col w-[110px] p-1 text-center border border-gray-300">
                {{$row['uroven'] ?? '-'}}
            </div>

        </div>
        {{--        {{ print_r($row,true) }}--}}



        {{--        @if( isset($show_analogi[$row['id']]) && $show_analogi[$row['id']] )--}}
        @if( !empty($row['analog'] ) )
            <div class="m-2" id="analog{{ $row['id'] }}" style="display: none;">

                <div class="flex flex-row-reverse">
                    <div class="bg-orange-100 p-6 rounded-lg shadow-lg w-[600px] table-animate ">

                        Аналог:<br/>
                        {!! $row['analog'] !!}

                    </div>
                </div>
            </div>
        @endif



        {{--        @if( isset($show_for_ul[$row['id']]) && $show_for_ul[$row['id']] === true )--}}
        @if( !empty( $row['b_i_k'] ) )
            <div class="m-2" id="ul{{ $row['id'] }}" style="display: none;">
                <div class="flex flex-row-reverse">
                    <div class="bg-orange-100 p-6 rounded-lg shadow-lg w-[600px] table-animate ">
                        <h3 class="text-lg font-bold mb-4">Данные для ЮрЛиц</h3>
                        <table class="w-full border border-gray-200">
                            <tbody>
                            {{--                    @for ($i = 1; $i <= 5; $i++)--}}


                            {{--                        'poluchatel' => $this->poluchatel,--}}
                            {{--                        'i_n_n' => $this->i_n_n,--}}
                            {{--                        'k_p_p' => $this->k_p_p,--}}
                            {{--                        'rschet' => $this->rschet,--}}
                            {{--                        'bank' => $this->bank,--}}
                            {{--                        'b_i_k' => $this->b_i_k,--}}
                            {{--                        'kor_schet' => $this->kor_schet,--}}
                            {{--                        'adres_banka' => $this->adres_banka,--}}


                            <tr>
                                <td class="border border-gray-300 p-2">Получатель:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('poluchatel{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="poluchatel{{ $row['id'] }}">  {{ $row['poluchatel'] }}</span></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">Банк:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('bank{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="bank{{ $row['id'] }}">  {{ $row['bank'] }}</span></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">Адрес Банка:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('adres_banka{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="adres_banka{{ $row['id'] }}"> {{ $row['adres_banka'] }}</span></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">БИК:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('b_i_k{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="b_i_k{{ $row['id'] }}"> {{ $row['b_i_k'] }}</span></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">ИНН:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('inn{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="inn{{ $row['id'] }}"> {{ $row['i_n_n'] }}</span></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">КПП:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('kpp{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="kpp{{ $row['id'] }}">  {{ $row['k_p_p'] }}</span></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">Расчётный Счёт:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('rs{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="rs{{ $row['id'] }}">{{ $row['rschet'] }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">Кор Счёт:</td>
                                <td class="border border-gray-300 p-2">
                                    {{--                                <button--}}
                                    {{--                                    class="ml-4 bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600 copy-btn"--}}
                                    {{--                                    data-copy="{{ $row['b_i_k'] }}">--}}
                                    {{--                                    <img src="/icon/copy.svg" class="w-[16px]" />--}}
                                    {{--                                </button>--}}

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('ks{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="ks{{ $row['id'] }}">{{ $row['kor_schet'] }}</span>

                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2">Назначение платежа:</td>
                                <td class="border border-gray-300 p-2">

                                    <img src="/icon/copy.svg"
                                         title="копировать в буфер обмена"
                                         onclick="copyToClipboard('dobavka_bank{{ $row['id'] }}')"
                                         class="float-right inset-y-0 right-[5px] flex items-center mt-[4px] h-[25px] opacity-20 hover:opacity-50 cursor-pointer"
                                    />
                                    <span id="dobavka_bank{{ $row['id'] }}">{{ $row['dobavka_bank'] }}</span>

                                </td>
                            </tr>
                            {{--                    @endfor--}}
                            </tbody>
                        </table>

                        <button
                            wire:click.prevent="switchForUl({{ $row['id'] }})"
                            class="mt-4 bg-red-200 text-white px-4 py-2 rounded hover:bg-red-400">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>

        @endif






        @if(!empty($row['children_count']) && $row['children_count'] > 0)
            <div class="bg-orange-200 p-2 rounded ml-[{{ (( $row['uroven'] ?? 1 )-1)*20 }}px]">

                <a class="text-blue-700 underline" href="#"
                   wire:click.prevent="switchPodrobnee({{ $row['id'] }})">Подробнее @if(isset($show_podrobnee[$row['id']]) && $show_podrobnee[$row['id']])
                        ( скрыть )
                    @endif </a>

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
