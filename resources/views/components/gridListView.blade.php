<input type="number" hidden id="noOfMission2" value="{{$count}}">
@php
    $user_id = auth()->user()->user_id;
@endphp
@if ($count)
    @include('components.gridView')
    @include('components.listView')
    <div class="d-flex p-3 justify-content-center">
        {!!$pagination!!}
    </div>
@else
    @include("components.NoMissionFound")
@endif


