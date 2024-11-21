<div>

    @foreach ($data as $с )
        <livewire:svo.contact-item :item="$с" :key="$с->id"/>
    @endforeach

{{--    <div class="my-6">--}}
{{--        {{ $data1->links($paginationView) }}--}}
{{--    </div>--}}

</div>
