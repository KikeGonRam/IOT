<div class="pagination">
    <!-- Botón Anterior -->
    <span class="page-btn" @if ($paginator->onFirstPage()) aria-disabled="true" @endif>
        @if ($paginator->onFirstPage())
            <i class="fas fa-angle-left"></i>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn"><i class="fas fa-angle-left"></i></a>
        @endif
    </span>

    <!-- Páginas -->
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <span class="page-btn @if ($page == $paginator->currentPage()) active @endif">
                    @if ($page == $paginator->currentPage())
                        {{ $page }}
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                </span>
            @endforeach
        @endif
    @endforeach

    <!-- Botón Siguiente -->
    <span class="page-btn" @if (!$paginator->hasMorePages()) aria-disabled="true" @endif>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn"><i class="fas fa-angle-right"></i></a>
        @else
            <i class="fas fa-angle-right"></i>
        @endif
    </span>
</div>
