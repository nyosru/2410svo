<!-- resources/views/svo/pagination.blade.php -->
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center">
        <ul class="inline-flex space-x-2">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li ><span class="bg-gray-200 text-gray-500 px-3 py-2 rounded">Назад</span></li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="bg-white text-gray-800 px-3 py-2 rounded border">Назад</a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li ><span class="bg-gray-200 text-gray-500 px-3 py-2 rounded" >{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li ><span class="bg-blue-500 text-white px-3 py-2 rounded " >{{ $page }}</span></li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="bg-white text-gray-800 px-3 py-2 rounded border">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="bg-white text-gray-800 px-3 py-2 rounded border">Вперед</a>
                </li>
            @else
                <li><span class="bg-gray-200 text-gray-500 px-3 py-2 rounded">Вперед</span></li>
            @endif
        </ul>
    </nav>
@endif
