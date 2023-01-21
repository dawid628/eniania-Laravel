@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link text-dark" href="#" 
               tabindex="-1"aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        @else
        <li class="page-item"><a class="page-link text-dark" 
            href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
            &lsaquo;</a>
          </li>
        @endif
  
        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled">{{ $element }}</li>
        @endif
  
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active">
            <a class="page-link bg-dark border-dark">{{ $page }}</a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link text-dark" 
               href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach
  
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link text-dark" 
               href="{{ $paginator->nextPageUrl() }}" 
               rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @endif
    </ul>
  </nav>
    @endif