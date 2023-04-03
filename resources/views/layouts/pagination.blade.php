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
    <a aria-label="Next"
        @if ($to!=$paginator->total())
        href="{{ $paginator->url($paginator->currentPage() + 1) }}"
        @endif
        >
        <span aria-hidden="true"><button rel="next" aria-label="Next >>"
                class="btn theme-color h-100 border-start px-4"><i class="fas fa-chevron-right"></i></button></span>
    </a>
</div>
