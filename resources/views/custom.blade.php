<div class="pagination">
<<<<<<< HEAD
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
=======
    @if ($paginator->onFirstPage())
        <span class="page-btn" disabled><i class="fas fa-angle-left"></i></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn"><i class="fas fa-angle-left"></i></a>
    @endif

    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
>>>>>>> 468d358 (semafos2)
            @endforeach
        @endif
    @endforeach

<<<<<<< HEAD
    <!-- Botón Siguiente -->
    <span class="page-btn" @if (!$paginator->hasMorePages()) aria-disabled="true" @endif>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn"><i class="fas fa-angle-right"></i></a>
        @else
            <i class="fas fa-angle-right"></i>
        @endif
    </span>
</div>
=======
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-btn"><i class="fas fa-angle-right"></i></a>
    @else
        <span class="page-btn" disabled><i class="fas fa-angle-right"></i></span>
    @endif
</div>
>>>>>>> 468d358 (semafos2)
