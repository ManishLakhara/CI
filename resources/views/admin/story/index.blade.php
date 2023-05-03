@extends('admin.app')


@section('title')
    Story
@endsection

@section('body')
<div class="container-fluid mt-4 px-4">
    <ul class="nav border-bottom"><span class="nav-link active fs-1"> Story </span></ul>
    @include('admin.components.successAlert')

    <div class="col-sm-4 relative w-100 py-4">
        <form id="search-form" action="{{ route('story.index') }}" method="GET">
            @csrf
            <label for="search" class="sr-only">
                Search
            </label>
            <div class="d-flex border rounded w-100">
                <button type="submit" class="btn">
                    <i class="fas fa-search"></i>
                  </button>
                <div class="form-outline py-2 w-100">
                  <input type="search" id="search-input" name="s" placeholder="Search" value='{{request()->input('s')}}' class="form-control border-0 py-2" />
                </div>
            </div>
        </form>
    </div>

    <table class="table table-responsive border-start border-end">
        <thead style="background-color: #F8F9FC">
            <tr>
                <th class="fs-5 py-4 px-3 font-weight-light" width="500px">Story Title</th>
                <th class="fs-5 py-4 font-weight-light" width="500px">Mission Title</th>
                <th class="fs-5 py-4 font-weight-light" width="500px">User Full Name</th>
                <th class="fs-5 py-4 font-weight-light text-center" width="300px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $mt)
                <tr>
                    <td class="px-3">
                        {{$mt->title}}
                    </td>
                    <td>
                        {{$mt->mission->title}}
                    </td>
                    <td>
                        {{$mt->user->first_name}} {{$mt->user->last_name}}
                    </td>
                    <td>
                        <a aria-label="view-story" href="{{route('story.show', $mt->story_id)}}"><button class="btn btn-outline border px-2 py-1" style="border-radius: 23px;color:#F88634;border-style: solid;border-color: #F88634!important;">View</button></a>
                        @if($mt->status=='PUBLISHED')
                            <span class="border px-2 py-1 text-success border-success" style="border-radius: 23px;">
                                PUBLISHED
                            </span>
                        @else
                            <a style="text-decoration: none;" aria-label="correct" id="application_a_{{$mt->story_id}}" href="{{route('story.published', $mt->story_id)}}">
                                <img alt="correct" src="{{asset('Images/correct-icon.svg')}}" width="25px" height="25px" alt="">
                            </a>
                        @endif
                        @if($mt->status=="DECLINED")
                            <span class="border px-2 py-1 text-danger border-danger" style="border-radius: 23px;">
                                DECLINED
                            </span>
                        @else
                            <a style="text-decoration: none;"  id="application_r_{{$mt->story_id}}" href="{{route('story.declined', $mt->story_id)}}">
                                <img src="{{asset('Images/cancle-icon.svg')}}" width="25px" height="25px" alt="">
                            </a>
                        @endif

                        <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $mt->story_id }}"
                            class="btn btn-white">
                            <img src="Images/bin.png"  style="width: 16px;height:20px" alt="delete">
                        </button>
                        <!-- Modal -->
                        @include('admin.components.deleteModal', [
                            'id' => $mt->story_id,
                            'form_action' => 'story.destroy',
                        ])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!!$pagination!!}
</div>
<script>
    $(document).ready(function() {

    var searchInput = $('#search-input');
    var searchForm = $('#search-form');


    var typingTimer;


    searchInput.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(performSearch, 500);
    });


    searchInput.on('keydown', function() {
        clearTimeout(typingTimer);
    });


    function performSearch() {

        var query = searchInput.val();


        if (query.trim() !== '') {
            searchForm.submit();
        }else {

            searchForm.attr('action', "{{ route('story.index') }}").submit();
        }
    }
    });
</script>
@endsection
