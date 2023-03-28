<?php
    $from=($paginator->currentPage()-1)*9 + 1;
    if($paginator->currentPage()==$paginator->lastPage()){
        $to=$paginator->total();
    }else{
        $to=$from+8;
    }


?>

<div class="d-flex justify-content-between pagination align-items-center" style="height: 3em">
    <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" @if ($paginator->currentPage() == 1) disabled @endif
        aria-label="Previous">
        <span aria-hidden="true"><button class="btn theme-color h-100 border-end px-4"><i
                    class="fas fa-chevron-left"></i></button></span>
    </a>
    <span class="theme-color fs-7">{{$from}} to {{$to}} of {{ $paginator->total() }} Recent Volunteers</span>
    <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
        <span aria-hidden="true"><button rel="next" aria-label="Next >>"
                class="btn theme-color h-100 border-start px-4"><i class="fas fa-chevron-right"></i></button></span>
    </a>
</div>




{{-- @if (isset($paginator) && $paginator->lastPage() > 1)
  <ul class="pagination">
    @php
      $interval = isset($interval) ? abs(intval($interval)) : 3 ;
      $from = $paginator->currentPage() - $interval;
      if($from < 1){
        $from = 1;
      }

      $to = $paginator->currentPage() + $interval;
      if($to > $paginator->lastPage()){
        $to = $paginator->lastPage();
      }
    @endphp
    <!-- first/previous -->
    @if ($paginator->currentPage() > 1)
    <li>
      <a href="{{ $paginator->url(1) }}" aria-label="First">
      <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li>
      <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous">
      <span aria-hidden="true">&lsaquo;</span>
      </a>
    </li>
    @endif
    <!-- links -->
    @for ($i = $from; $i <= $to; $i++)
    @php
      $isCurrentPage = $paginator->currentPage() == $i;
    @endphp
    <li class="{{ $isCurrentPage ? 'active' : '' }}">
      <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">
      {{ $i }}
      </a>
    </li>
    @endfor
    <!-- next/last -->
    @if ($paginator->currentPage() < $paginator->lastPage())
    <li>
      <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
      <span aria-hidden="true">&rsaquo;</span>
      </a>
    </li>
    <li>
      <a href="{{ $paginator->url($paginator->lastpage()) }}" aria-label="Last">
      <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    @endif
  </ul>
@endif --}}
