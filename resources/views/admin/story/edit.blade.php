@extends('admin.app')


@section('title')
    Story {{$story->story_id}}
@endsection


@section('body')

<div class="container-fluid px-4">
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
            <textarea disabled name="description" class="story-textarea" id="summary-ckeditor">{{ $story->description }}</textarea>
        </div>
    </div>

    <h4 class="mt-4">
        Videos
    </h4>
    <div class="row justify-content-center">
    <div class='col-lg-6'>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            @for($i=1;$i<=4;$i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
            @endfor
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <iframe allow="fullscreen" width="100%" height="600px" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
            </div>
            @for ($i=1;$i<=4;$i++)
                <div class="carousel-item">
                    <iframe allow="fullscreen" width="100%" height="600px" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                </div>
            @endfor
            </div>
        </div>
    </div>
    </div>
    <h4 class="mt-4">
        Photos
    </h4>
    <div class="row justify-content-center">
    <div class='col-lg-6'>
        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
            @for($i=1;$i<=4;$i++)
                <li data-target="#carouselExampleIndicators2" data-slide-to="{{$i}}"></li>
            @endfor
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('Images/Animal-welfare-&-save-birds-campaign-1.png')}}" width="900px" height="600px" alt="">
            </div>
            @for ($i=1;$i<=4;$i++)
                <div class="carousel-item">
                    <img src="{{asset('Images/Animal-welfare-&-save-birds-campaign-1.png')}}" width="900px" height="600px" alt="">
                </div>
            @endfor
            </div>
        </div>
    </div>
    </div>
    <div class="row py-4 ">
        <div class="col">
            <button id="publish" data-story_id="{{$story->story_id}}"
            @if($story->status=="PUBLISHED") disabled
            @endif
            class="btn mx-2 btn-success">
            @if($story->status=='PUBLISHED')
                PUBLISHED
            @else
                Publish
            @endif
            </button>
            <button id="decline" data-story_id="{{$story->story_id}}"
            @if($story->status=="DECLINED") disabled
            @endif
            class="btn mx-2 btn-secondary">
            @if($story->status=='DECLINED')
                DECLINED
            @else
                Decline
            @endif
            </button>
            {{-- <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $story->story_id }}" class="btn mx-2 btn-danger">Delete</button> --}}
        </div>
    </div>
    <script>
        $(document).ready( function(event){
            event.preventDefault();
            $('#publish').on('click', function(){
                $(this).prop('disabled', true);
                $('#decline').prop('disabled', false);
                $('#decline').text('Decline');
                $('#publish').text('published');
                // $.ajax({
                //     url: "{{url('admin-story-published/"+$(this).data("story_id")+"')}}",
                //     type: 'get',
                //     success: function(result){
                //         alert(result);
                //     }
                // })
            })
            $('#decline').on('click', function(event){
                event.preventDefault();
                $(this).prop('disabled', true);
                $('#publish').prop('disabled', false);
                $('#publish').text('Publish');
                $('#decline').text('declined');
                // $.ajax({
                //     url: "{{url('admin-story-declined/"+$(this).data("story_id")+"')}}",
                //     type: 'get',
                //     success: function(result){
                //         alert(result);
                //     }
                // })
            })
        })
    </script>
@endsection
