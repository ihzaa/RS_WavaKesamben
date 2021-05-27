@if ($paginator->lastPage() > 1)
    <nav class="blog-pagination justify-content-center d-flex">
        <ul class="pagination">
            <li class="page-item {{ $paginator->currentPage() == 1 ? 'disabled' : '' }}">
                <a href="{{ $paginator->url(1) }}" class="page-link" aria-label="Previous">
                    <strong style="font-size: 1.5rem"><</strong>
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item {{ $paginator->currentPage() == $i ? ' active disabled' : '' }}">
                    <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="page-link " aria-label="Next">
                    <strong style="font-size: 1.5rem">></strong>
                </a>
            </li>
        </ul>
    </nav>
@endif
