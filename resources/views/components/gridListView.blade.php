@php
    $user_id = auth()->user()->user_id;
    $count = $data->total();
@endphp
<input type="number" hidden id="noOfMission2" value="{{$count}}">

@if ($count)
    @include('components.gridView')
    @include('components.listView')
    <div class="d-flex p-3 justify-content-center">
        {!!$pagination!!}
    </div>
@else
    @include("components.NoMissionFound")
@endif


