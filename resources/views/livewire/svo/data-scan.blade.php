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

    <div class="flex">
        <div class="w-1/2">
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

        </div>

        <!-- Секция для загрузки нескольких картинок -->
        <div class="w-1/4 pl-4">
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
        <div class="w-1/4 pl-4">
            <div class="block bg-yellow-200 p-1"><b>картинки<br/>
                    ещё&nbsp;не&nbsp;загружены:</b>
            </div>
            @if( !empty($shopPhotosWithoutPhotos) )
                @foreach( $shopPhotosWithoutPhotos as $image )
                    {{ $image }}
                    <br/>
                @endforeach
            @else
                Отлично, все фотки загружены
            @endif

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
