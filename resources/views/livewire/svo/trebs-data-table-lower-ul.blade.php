<div class="m-2" id="ul{{ $row['id'] }}" style="display: none;">
    <div class="flex flex-row-reverse">
        <div class="bg-orange-100 p-6 rounded-lg shadow-lg w-[600px] table-animate ">
    <span
        onclick="toggleBlock('ul{{ $row['id'] }}'); return false;"
        class="float-right cursor-pointer text-white py-1 px-2 rounded bg-red-200 hover:bg-red-600 text-[10px]">
X
</span>

            <h3 class="text-lg font-bold mb-4">Данные для Юр.Лиц</h3>
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

            {{--                        <button--}}
            {{--                            wire:click.prevent="switchForUl({{ $row['id'] }})"--}}
            {{--                            class="mt-4 bg-red-200 text-white px-4 py-2 rounded hover:bg-red-400">--}}
            {{--                            Закрыть--}}
            {{--                        </button>--}}
        </div>
    </div>
</div>
