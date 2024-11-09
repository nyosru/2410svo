<div>
    <div class="py-3 text-center">
        Быстрый поиск: <input wire:model.live="search" type="text" class="border border-2 p-1"/>
    </div>
    {{--    {{ $search }}--}}
    {{--    {{ count($data1)  }}--}}
    @if(count($data1) > 0 )

        {{--        <div class="container mx-auto my-4">--}}
        {{--            <div class="mt-6">--}}
        {{--                {{ $data1->links() }}--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <table class="shop-table table-auto w-full border-collapse border border-gray-300">

            {{--            {{ dd($data) }}--}}
            <tbody>
            {{--                        {{dd($data->items())}}--}}
            {{--            @foreach ($data as $index => $data1)--}}
            {{--            @foreach ($data_all as $index => $data1)--}}
            {{--            @foreach ($data as $index => $data1)--}}
            {{--            {{ dd($data->items() ) }}--}}
            {{--            {{ dd($data_all ) }}--}}
            {{--                        @foreach ($data_all as $index => $data1)--}}
            {{--            @foreach ($data as $index => $data1)--}}
            {{--            @foreach ($data->items() as $index => $data1)--}}
            @foreach ($data1 as $index=>$data12)
                {{--                {{ print_r($data1) }}--}}
                {{--{{ $data12->name }}--}}
                {{--<br/>--}}
                {{--            @foreach ($data as $data1)--}}
                {{--                                {{ dd($data1) }}--}}
                <livewire:svo.shop-tr :item=$data12
                                      :key="$data12->id"
                                      :nn="$index"
                />
            @endforeach
            </tbody>
        </table>

        <div class="container mx-auto my-4">
            <div class="mt-6">
                {{ $data1->links() }}
            </div>
        </div>

    @else
        <p class="text-center bg-yellow-300 p-5 rounded">Товаров не найдено ({{ $search }})</p>
    @endif
</div>
