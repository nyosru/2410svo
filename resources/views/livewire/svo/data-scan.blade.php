<div>

    <!-- Сообщения об успехе или ошибках -->
    @if (session()->has('message'))
        <div class="mt-4 mb-4 p-4 bg-green-200 text-green-800 rounded">
            <strong>Успех!</strong> {!! session('message') !!}
        </div>

    @endif
    @if (session()->has('error'))
        <div class="mt-4 mb-4 p-4 bg-red-200 text-red-800 rounded">
            <strong>Ошибка!</strong> {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-wrap">

        <div class="w-1/2 md:w-1/4 mb-[2vh]
         bg-gradient-to-br from-yellow-200 to-white
         ">
            <form wire:submit.prevent="scanFile">
                <div class="bg-yellow-400 p-2">Сканировать файл</div>
                <div class="p-3">
                    <select wire:model="type_file" required class="w-full p-1">
                        <option value="">-- выберите --</option>
                        <option value="shop">Магазин (добро)</option>
                        <option value="trebs">Требы</option>
                        <option value="fin">Фин отчёт</option>
                    </select>
                    <br/>
                    <br/>
                    <input type="file" wire:model="uploadedFile1"/>
                    <br/>
                    @error('uploadedFile1') <span class="text-red-500">{{ $message }}</span> @enderror
                    <br/>
                    <div class="text-center" >
                    <button type="submit" class="bg-blue-300 p-2 rounded">Сканировать</button>
                    </div>
                </div>
            </form>
            <br/>
            {{--            @error('uploadedImages') <span class="text-red-500">{{ $message }}</span> @enderror--}}
            {{--            @error('uploadedImages.*') <span class="text-red-500">{{ $message }}</span> @enderror--}}


            {{--            {{ print_r($filesNoInDb ?? 'x') }}--}}


            <!-- Результаты сканирования -->
            <div class="w-full overflow-auto">
                @if($scanResult)
                    <div class="mt-4 p-4 border border-gray-300 bg-gray-100">
                        <h3>Результат сканирования:</h3>
                        Всё удалили
                        <br/>
                        Добавлено товаров: {{ $scanResult['line_to_db'] ?? 'x' }}
                        <br/>
                        <pre>{{ json_encode($scanResult, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                @endif
            </div>


        </div>

        <!-- Секция для загрузки нескольких картинок -->
        <div class="w-1/2 md:w-1/4 mb-[2vh]
        bg-gradient-to-br from-green-200 to-white
        ">
            <form wire:submit.prevent="uploadImages">
                <div class=" p-2 bg-green-400"><b>Загрузить картинки</b></div>
                <div class="p-2">
                    <input type="file" wire:model="uploadedImages" multiple class="mt-2"/>
                    @error('uploadedImages')
                    <div class="text-red-500">{{ $message }}</div> @enderror
                    @error('uploadedImages.*')
                    <div class="text-red-500">{{ $message }}</div> @enderror
                    <br/>
                    <button type="submit" class="bg-blue-300 p-2 rounded mt-4">Загрузить картинки</button>
                </div>
            </form>
        </div>

        <div class="w-1/2 md:w-1/4 mb-[2vh]
         bg-gradient-to-br from-red-200 to-white
        ">
            <h3 class="bg-red-300 p-2"><b>картинки ещё&nbsp;не&nbsp;загружены:</b></h3>
            <div class="p-2">
            @if( !empty($shopPhotosWithoutPhotos) )
                <div class="w-full border border-1" style="max-height: 200px; overflow: auto;">
                    @foreach( $shopPhotosWithoutPhotos as $image )
                        {{ $image }}
                        <br/>
                    @endforeach
                </div>
            @else
                Отлично, все фотки загружены
            @endif
            </div>
        </div>
        <div class="w-1/2 md:w-1/4 mb-[2vh]
        bg-gradient-to-br from-blue-200 to-white
        ">
            <div class="block bg-blue-300 p-2"><b>картинки загруженые:</b>
            </div>
            <div class="p-2">
            {{--                        {{ print_r($listFiles) }}--}}
            @if( !empty( $listFiles ) )
                <div class="w-full border border-1" style="max-height: 200px; overflow: auto;">
                    @foreach( $listFiles as $f )
                        <a href="/storage/images/{{ $f }}" target="_blank" class="text-blue-400 underline">{{ $f }}</a>
                        <br/>
                    @endforeach
                </div>
            @else

                <br/>
                <button wire:click="checkFiles" class="bg-green-300 p-1 rounded">Показать</button>
                <br/>

            @endif
            </div>
        </div>

        <div class="w-1/2 md:w-1/4 pl-4 mb-[2vh]
        bg-gradient-to-br from-orange-200 to-white
        ">
            <h3 class="bg-orange-400 p-2">Файлы на сервере которые не используются на сайте</h3>
{{--            <button class="p-1 bg-green-300 rounded">Удалить все ({{ $sizeNoFiles }}Mb)</button>--}}
            <br/>
            <div class="w-full border border-1" style="max-height: 200px; overflow: auto;">
                @foreach( $filesNoInDb as $f )
                    <a href="/storage/images/{{ $f }}" target="_blank">{{ $f }}</a> <br/>
                @endforeach
            </div>

        </div>
    </div>



</div>
