@foreach ($volunteers as $volunteer)
    <div class="col-md-4 pb-2 text-center">
        <img class="img-fluid rounded-circle" src="{{asset($volunteer->avatar)}}" alt="" style="height: 72px; width: 72px">
        <div class="py-2 fs-7 theme-color">{{$volunteer->first_name}} {{$volunteer->last_name}}</div>
    </div>
@endforeach
</div>
<div class="row">
    {{-- User Pagination comes here --}}
    {!! $volunteers->links('pagination::bootstrap-5') !!}
</div>
