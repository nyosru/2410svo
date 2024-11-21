<div>

    <div class="w-[600px] mx-auto my-5">
        Поиск: <input wire:model.live="search" type="text" class="w-[400px] border border-2 p-1"/>
    </div>

    @if( count($data) == 0 )
        <div class="bg-yellow-300 p-2 w-[600px] mx-auto">Нет контактов для показа ( Поиск: {{ $search ?? '' }} )</div>
    @else
        @foreach ($data as $с )
            <livewire:svo.contact-item :item="$с" :key="$с->id"/>
        @endforeach
    @endif

    {{--    <div class="my-6">--}}
    {{--        {{ $data1->links($paginationView) }}--}}
    {{--    </div>--}}

</div>
