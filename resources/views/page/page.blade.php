@if ($paginator->total())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><span>«</span></li>
            <li><span>‹</span></li>
        @else
            <li><a href="javascript:;" data-page="1">«</a></li>
            <li><a href="javascript:;" data-page="{{ $paginator->currentPage() - 1}}">‹</a></li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span>{{ $element }}</span></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><span>{{ $page }}</span></li>
                    @else
                        <li><a href="javascript:;" data-page="{{ $page }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="javascript:;" data-page="{{ $paginator->currentPage() + 1}}">›</a></li>
            <li><a href="javascript:;" data-page="{{ $paginator->lastPage() }}">»</a></li>
        @else
            <li><span>›</span></li>
            <li><span>»</span></li>
        @endif
    </ul>
@endif