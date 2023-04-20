<div class="pagination-container mt-4 text-center">
    @if ($paginator->hasPages())
        <ul class="pagination">
            {{-- First Page Link --}}
            @if ($paginator->currentPage() > 1)
                <li class="page-item"><a name="start" href="{{ $paginator->url(1) }}" class="page-link">&laquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
            @else
                <li class="page-item"><a name="goleft" href="{{ $paginator->previousPageUrl() }}" class="page-link">&lsaquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a name="navto{{$page}}" href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a name="navtoRight"href="{{ $paginator->nextPageUrl() }}" class="page-link">&rsaquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->currentPage() < $paginator->lastPage())
                <li class="page-item"><a name="navtorightend" href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    @endif
</div>

