@if(count($volunteers)!=0)
    @foreach ($volunteers as $volunteer)
        <div class="col-lg-4 col-md-6 col-sm-4 col-6 pb-2 text-center">
            <img class="img-fluid rounded-circle" src="{{asset($volunteer->avatar)}}" alt="" style="height: 72px; width: 72px">
            <div class="py-2 fs-7 theme-color">{{$volunteer->first_name}} {{$volunteer->last_name}}</div>
        </div>
    @endforeach
    <div class="container">

            {{-- <div><button class="btn theme-color h-100 border-end"><i class="fas fa-chevron-left"></i></button></div> --}}
            @include('layouts.pagination', ['paginator' => $volunteers])
            {{-- {!! $volunteers->links('pagination::bootstrap-4') !!} --}}
            {{-- <div><button rel="next" aria-label="Next >>" class="btn theme-color h-100 border-start"><i class="fas fa-chevron-right"></i></button></div> --}}

    </div> 
@else
    <span class="text-center fs-4 py-4" style="color: #f88634 ">Become the first person to Volunteer this Mission</span>
@endif



