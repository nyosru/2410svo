<div class="max-w-lg mx-auto mt-10 p-6 ">
    @if (session()->has('messageFile'))
        <div class="mb-4 text-green-600">
            {{ session('messageFile') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
                Выберите файл:
            </label>
            <input type="file" wire:model="file" class="shadow bg-white appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
            @error('file') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Загрузить
        </button>
    </form>
</div>
