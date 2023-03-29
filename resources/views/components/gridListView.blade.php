<input type="number" hidden id="noOfMission2" value="{{$count}}">
@if ($count)
    @include('components.gridView')
    @include('components.listView')
    <div class="d-flex p-3 justify-content-end">
        {!! $data->links('pagination::bootstrap-4') !!}
    </div>
@else
    @include("components.NoMissionFound")
@endif


