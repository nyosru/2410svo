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

    <div class="flex ">
        <div class="w-1/2 md:w-1/4 ">
            <form wire:submit.prevent="scanFile">
                <label>Сканировать файл</label>
                <br/>
                <select wire:model="type_file" required>
                    <option value="">-- выберите --</option>
                    <option value="shop">Магазин (добро)</option>
                    <option value="trebs">Требы</option>
                    <option value="fin">Фин отчёт</option>
                </select>
                <br/>
                <input type="file" wire:model="uploadedFile1"/>
                @error('uploadedFile1') <span class="text-red-500">{{ $message }}</span> @enderror
                <br/>
                <button type="submit" class="bg-blue-300 p-2 rounded">Сканировать</button>
            </form>
            <br/>
            {{--            @error('uploadedImages') <span class="text-red-500">{{ $message }}</span> @enderror--}}
            {{--            @error('uploadedImages.*') <span class="text-red-500">{{ $message }}</span> @enderror--}}


            {{--            {{ print_r($filesNoInDb ?? 'x') }}--}}

        </div>

        <!-- Секция для загрузки нескольких картинок -->
        <div class="w-1/2 md:w-1/4 pl-4">
            <form wire:submit.prevent="uploadImages">
                <label class="block bg-green-200 p-1"><b>Загрузить картинки</b></label>
                <br/>
                <input type="file" wire:model="uploadedImages" multiple class="mt-2"/>
                @error('uploadedImages')
                <div class="text-red-500">{{ $message }}</div> @enderror
                @error('uploadedImages.*')
                <div class="text-red-500">{{ $message }}</div> @enderror
                <br/>
                <button type="submit" class="bg-blue-300 p-2 rounded mt-4">Загрузить картинки</button>
            </form>
        </div>
        <div class="w-1/2 md:w-1/4 pl-4">
            <h3 class="bg-orange-400 p-2">картинки ещё&nbsp;не&nbsp;загружены:</h3>
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

            <br/>
            <br/>

            <div class="block bg-green-200 p-1"><b>картинки<br/>
                    которые загружены:</b>
            </div>

            {{--                        {{ print_r($listFiles) }}--}}
            @if( !empty( $listFiles ) )
                <div class="w-full border border-1" style="max-height: 200px; overflow: auto;">
                    @foreach( $listFiles as $f )
                        <a href="/storage/images/{{ $f }}" target="_blank" class="text-blue-400 underline">{{ $f }}</a><br/>
                    @endforeach
                </div>
            @else

                <br/>
                <button wire:click="checkFiles" class="bg-green-300 p-1 rounded">Показать</button>
                <br/>

            @endif
        </div>
    </div>

    <div class="flex flex-row">
        <div class="w-1/3">
            <h3 class="bg-orange-400 p-2">Файлы на сервере которые не используются на сайте</h3>
            <button class="p-1 bg-green-300 rounded">Удалить все ({{ $sizeNoFiles }}Mb)</button>
            <br/>
            <div class="w-full border border-1" style="max-height: 200px; overflow: auto;">
                @foreach( $filesNoInDb as $f )
                    <a href="/storage/images/{{ $f }}" target="_blank">{{ $f }}</a> <br/>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Результаты сканирования -->
    <div>
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
