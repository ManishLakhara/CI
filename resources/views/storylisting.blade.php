@extends('layouts.app')
@section('title')
    Story Listing
@endsection

@section('content')
    <?php
    $user_id = Auth::user()->user_id;
    ?>
    <div class="container-fluid position-sticky" style="top:0%;background-color: white;z-index:999;">
        <button class="btn" name="header-toggle" id="main_header_btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="fa-solid fa-bars"></i>
          </button>
    </div>

    @include('admin.components.successAlert')

    <div class="row">
        <div class="container-fluid">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="image">
                <img class="w-100 h-100" src="images/growsharestory.png"  style="min-height: 430px;object-fit:cover; overflow:hidden;" alt="First slide">
                <div class="image__overlay">
                    <p class="text-center  infomationOnShareStory">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore
                        et dolore magna
                        aliqua.<br> Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip.</p>
                    <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary" href="{{ url('share-your-story') }}">Share
                        Your
                        Story <i class="fa fa-arrow-right"></i></a>

                </div>
            </div>

        </div>
    </div>
    <div>
    </div>

    <div class="container mt-5" id="my-story">
        <div class="row">

            @foreach ($draft_stories as $mystory)
                <div class="card col-lg-6 col-xl-4 col-md-6 border-0  pb-4 text-center mb-5"
                    style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                    <div class="image">
                        <img class="img-fluid w-100 h-100 card-img-top"
                            src="{{ asset('storage/' . $mystory->storyMedia->whereIn('type', ['jpeg', 'jpg', 'png'])->first()->path) }}"
                            alt="">


                        @if ($mystory->status == 'PUBLISHED')
                            <div class="image__overlay">
                                <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary"
                                    href="{{ route('story-details-page', $mystory->story_id) }}">View
                                    Details&nbsp;<i class="fa fa-arrow-right"></i></a>
                            </div>
                        @endif

                        @if ($mystory->status == 'DRAFT')
                            <div class="image__overlay">
                                <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary"
                                    href="{{ route('mystories.edit', $mystory->story_id) }}">Edit Story
                                    Details&nbsp;<i class="fa fa-arrow-right"></i></a>
                            </div>
                        @endif
                    </div>

                    <div class="text-center" style="margin-top:-15px;">
                        <span class="fs-15 px-2 fromuntill">
                            {{ $mystory->mission->missiontheme->title }}</span>
                    </div>
                    <div class="card-body">
                        <h4 class='mission-title theme-color'>{{ $mystory->title }}</h4>
                        <p class='card-text mission-short-description'>
                            {{ strip_tags($mystory->description) }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-start">
                        {{-- <img class="rounded-circle px-3 " id="header-avatar" src="{{ asset($mystory->user->avatar) }}"
                            alt="Profile" style="height:54px"> --}}
                            <img class="rounded-circle px-3" id="header-avatar" src="{{ $mystory->user->avatar ? asset($mystory->user->avatar) : asset('images/user1.png') }}" alt="Profile" style="height:54px">

                        <span class="mt-3" id="userAvatar">{{ $mystory->user->first_name }}
                            {{ $mystory->user->last_name }}</span>
                    </div>

                </div>
            @endforeach
            @foreach ($published_stories as $story)
                <div class="card col-lg-6 col-xl-4 col-md-6 border-0 mx-auto pb-4 text-center mb-5"
                    style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    {{-- <div class="py-1"> --}}
                    <div class="image">
                        <img class="img-fluid w-100 h-100 card-img-top"
                            src="{{ asset('storage/' . $story->storyMedia->whereIn('type', ['jpeg', 'jpg', 'png'])->first()->path) }}"
                            alt="">

                        {{-- <img class="d-block w-100 h-100"
                            src="images/Grow-Trees-On-the-path-to-environment-sustainability-3.png" class="img-fluid"
                            alt="First slide"> --}}
                        <div class="image__overlay">
                            <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary"
                                href="{{ route('story-details-page', $story->story_id) }}">View
                                Details&nbsp;<i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top:-15px;">
                        <span class="fs-15 px-2 fromuntill">
                            {{ $story->mission->missiontheme->title }}</span>
                    </div>
                    <div class="card-body">
                        <h4 class='mission-title theme-color'>{{ $story->title }}</h4>
                        <p class='card-text mission-short-description'>
                            {{ strip_tags($story->description) }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-start">
                        <img class="rounded-circle px-3 " id="header-avatar" src="{{ asset($story->user->avatar) }}"
                            alt="Profile" style="height:54px">
                        <span class="mt-3" id="userAvatar">{{ $story->user->first_name }}
                            {{ $story->user->last_name }}</span>
                    </div>

                </div>
            @endforeach
            <hr>
        </div>
        <div class="d-flex p-3 justify-content-end">
            {!! $pagination !!}
        </div>
    </div>
    </div>
    </div>
    {{--
    <div class="d-flex p-3 justify-content-end">
        {!! $published_stories->links('pagination::bootstrap-4') !!}
    </div> --}}

    <script>
        $('#story_page').hide();
        function getAjax(page) {
            $.ajax({
                url: "{{ url('story-listing') }}" + '?page=' + page,
                type: "get",
                success: function(result) {
                    $('#my-story').html(result);
                    runQuery();
                }
            })
        }

        function runQuery() {
            $(".pagination a").on('click', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                console.log(page);
                getAjax(page);
            })
        }
        $(document).ready(function() {
            runQuery();

        })
    </script>
    <style>
        .image {
            position: relative;
            width: 100%;
            z-index: 1;
        }

        .img-fluid {
            display: block;
            width: 100%;

        }

        .image__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.25s;
        }

        .image__overlay>* {
            transform: translateY(50%);
        }

        .image__overlay:hover {
            opacity: 0.5;


        }

        .px-2 {
            position: relative;
            border-radius: 23px;
            max-width: fit-content;
            padding-bottom: 0.5rem;
            background-color: white;
            z-index: 10;
        }
    </style>
@endsection
