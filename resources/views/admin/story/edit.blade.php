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
            <a href="{{route('admin-story.published',$story->story_id)}}" id="publish_btn" data-story_id="{{$story->story_id}}" class="btn btn-outline-primary">Publish</a>
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
@endsection
