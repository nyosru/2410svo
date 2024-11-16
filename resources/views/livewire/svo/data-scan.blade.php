<div>

    <div class="flex">
        <div>

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
                <input type="file" wire:model="uploadedFile"/>
                <br/>
                <button type="submit" class="bg-blue-300 p-2 rounded">Сканировать</button>
            </form>
        </div>
        <div>
            @if($scanResult)
                <div class="mt-4 p-4 border border-gray-300 bg-gray-100">
                    <h3>Результат сканирования:</h3>
                    Всё удалили
                    <Br/>
                    Добавлено товаров: {{ $scanResult['line_to_db'] ?? 'x' }}
                    <Br/>
                    <pre>{{ json_encode($scanResult, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            @endif
        </div>
    </div>
</div>
