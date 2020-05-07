@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">PRIMEIRA</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" rel="prev" aria-label="@lang('pagination.previous')">PRIMEIRA</a>
            </li>
        @endif

        @for ($i = $paginator->currentPage() - 2; $i <= $paginator->currentPage() -1; $i++)
            @if($i >= 1)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        <li class="page-item active" aria-current="page"><span class="page-link">{{ $paginator->currentPage() }}</span></li>

        @for ($i = $paginator->currentPage() + 1; $i <= $paginator->currentPage() + 2; $i++)
            @if($i <= ceil($paginator->total() / $paginator->perPage()))
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next" aria-label="@lang('pagination.next')">ÚLTIMA</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">ÚLTIMA</span>
            </li>
        @endif
    </ul>
@endif
