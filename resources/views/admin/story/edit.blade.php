@extends('admin.app')


@section('title')
    Story {{$story->story_id}}
@endsection


@section('body')

<div class="container-fluid px-4 mt-4">
    <ul class="nav border-bottom"><span class="nav-link active fs-1"> Show Story </span></ul>

    @include('admin.components.successAlert')

    <div class="row">
        <div class="col-md-6">
            <label for="missionSelect" class="form-label">Mission</label>
            <input type="text" class="form-control" disabled value="{{$story->mission->title}}">
        </div>
        <div class="col-md-6">
            <label for="title" class="form-label">My Story Title</label>
            <input type="text" disabled class="form-control" id="title" name='title' placeholder="Enter your title"
                value="{{$story->title}}" placeholder="Enter story title">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-5">
            <label for="summary-ckeditor" class="form-label">My Story</label>
            <textarea disabled name="description" class="story-textarea" id="editor1">{{ $story->description }}</textarea>
        </div>
    </div>

    <h4 class="mt-4">
        Story Media
    </h4>
        <div id="preview">
            @foreach ($story->storyMedia->whereIn('type',['png','jpge','jpg']) as $imagemedia)
            <div style="position:relative; display:inline-block; margin-right:10px;margin-left:10px;">
                <img src="{{ asset('storage/' . $imagemedia->path) }}" alt="" width="118px"
                    height="118px">
                {{-- <i class="fa fa-times" style="position:absolute; top:0px; right:0px; background-color:black; color:white; border-radius:10%; padding:4px; cursor:pointer;"
                       onclick="removeImage('{{ $imagemedia->path }}')"></i> --}}
                <button type="button" class="close_preview_img"
                    data-story_media_id="{{ $imagemedia->story_media_id }}"
                    style="position:absolute; top:0px; right:0px; background-color:black; color:white; border-radius:10%; padding:4px; cursor:pointer;"><i
                        class="fa fa-times"></i></button>
            </div>
            @endforeach
        </div>

</div>
    <div class="row py-4 ">
        <div class="col">
            <a id="publish_btn" data-story_id="{{$story->story_id}}" class="btn btn-outline-primary">Publish</a>
            <a href="{{route('admin-story.declined',$story->story_id)}}" id="decline_btn" data-story_id="{{$story->story_id}}" class="btn btn-outline-secondary">Decline</a>
            <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $story->story_id }}"
                class="btn btn-outline-danger">
                Delete
            </button>
            <!-- Modal -->
            @include('admin.components.deleteModal', [
                'id' => $story->story_id,
                'form_action' => 'admin-story.destroy',
            ])
        </div>
    </div>
    <script>
        CKEDITOR.replace('editor1');
        var deleteFiles = [];
        $(document).ready(function(){
            $('button[class="close_preview_img"]').on('click', function() {
                deleteFiles = [...deleteFiles, $(this).data('story_media_id')];
                $(this).parent().remove();
            })
            $(".remove_video_btn").on('click', function(){
                console.log($(this).data('story_media_id'));
                //deleteFiles = [...deleteFiles, $(this).data('story_media_id')];
                //$(this).parent().remove();
            })
            $('#publish_btn').on('click', function(){
                $.ajax({
                    url: "{{url('admin-story-published/:id')}}".replace(':id',$(this).data('story_id')),
                    type: "get",
                    data: {
                        media_declined_ids: deleteFiles,
                    },
                    success: function(response) {
                        alert(response);
                        var link = document.createElement('a');
                        link.href = "{{route('admin-story.index')}}"
                        link.click();
                    }
                })
            })
        })
    </script>
@endsection
