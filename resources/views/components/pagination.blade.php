@if( $collection->hasPages() )
<nav aria-label="Page navigation pagar">
    <ul class="pagination justify-content-center justify-content-md-end">
        <li class="page-item">
            <a class="page-link {{ is_null($collection->previousPageUrl()) ? 'disabled' : '' }}" href="{{ is_null($collection->previousPageUrl()) ? '#!' : $collection->previousPageUrl() }}">Anterior</a>
        </li>
        <li class="page-item">
            <span class="page-link bg-white disabled">Página {{ $collection->currentPage() }}</span>
        </li>
        <li class="page-item">
            <a class="page-link {{ is_null($collection->nextPageUrl()) ? 'disabled' : '' }}" href="{{ is_null($collection->nextPageUrl()) ? '#!' : $collection->nextPageUrl() }}">Siguiente</a>
        </li>
    </ul>
</nav>
@endif
