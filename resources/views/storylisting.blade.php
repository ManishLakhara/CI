@extends('layouts.app')
@section('title')
    Story Listing
@endsection

@section('content')
    <?php
    $user_id = Auth::user()->user_id;
    ?>
   
    <div class="row">
        <div class="container-fluid">

            <div class="image">
                <img class="d-block w-100 h-100" src="images/growsharestory.png" class="img-fluid" alt="First slide">
                <div class="image__overlay">
                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore
                        et dolore magna
                        aliqua.<br> Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip.</p>
                    <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary" href="{{ url('share-your-story') }}">Share
                        Your
                        Story <i class="fa fa-arrow-right"></i></a>
                    {{-- <p class="image_description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi officiis similique animi quibusdam, ratione quia aliquam quae provident vero ullam incidunt exercitationem nulla labore tempora sapiente dolorum asperiores amet vel.</p> --}}
                </div>
            </div>
            {{-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 h-100" src="images/growsharestory.png" class="img-fluid"
                            alt="First slide">

                        <div class="carousel-caption d-none d-md-block">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip.</p>
                            <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary"
                                href="{{ url('sharestory') }}">Share Your Story <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-100" src="images/growsharestory.png" class="img-fluid"
                            alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip.</p>
                            <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary"
                                href="{{ url('sharestory') }}">Share Your Story <i class="fa fa-arrow-right"></i></a>
                        </div>

                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-100" src="images/growsharestory.png" class="img-fluid"
                            alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip.</p>
                            <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary"
                                href="{{ url('sharestory') }}">Share Your Story <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> --}}
        </div>
    </div>
    <div>
    </div>

    <div class="container mt-5" id="my-story">
        <div class="row">
            @foreach ($published_stories as $story)
                <div class="card col-lg-6 col-xl-4 col-md-6 border-0  pb-4 text-center mb-5"
                    style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    {{-- <div class="py-1"> --}}

                    <img class="img-fluid w-100 h-100 card-img-top"
                    src="{{ asset("storage/".$story->storyMedia->whereIn('type',['jpeg','jpg','png'])->first()->path) }}" alt="">

                    {{-- <img class="d-block w-100 h-100"
                            src="images/Grow-Trees-On-the-path-to-environment-sustainability-3.png" class="img-fluid"
                            alt="First slide"> --}}
                    <div class="image__overlay">
                        <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary" href="{{ url('sharestory') }}">View
                            Details&nbsp;<i class="fa fa-arrow-right"></i></a>
                    </div>
                    {{-- </div> --}}

                    <div class="text-center" style="margin-top:-25px;">
                        <span class="fs-15 px-2 from_untill">
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

        </div>
        <div class="d-flex p-3 justify-content-end">
            {!! $published_stories->links('pagination::bootstrap-4') !!}
        </div>
    </div>
    </div>
    </div>
    {{--
    <div class="d-flex p-3 justify-content-end">
        {!! $published_stories->links('pagination::bootstrap-4') !!}
    </div> --}}

<script>
    function getAjax(page){
            $.ajax({
                url: "{{ url('story-listing') }}"+'?page='+page,
                type: "get",
                success: function(result){
                    $('#my-story').html(result);
                    runQuery();
                }
            })
        }
    function runQuery(){
        $(".pagination a").on('click',function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            console.log(page);
            getAjax(page);
        })
    }
    $(document).ready(function(){
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
            transform: translateY(50px);
            / transform: translateX(200px);/ / transform: matrix(100%);/
        }

        .image__overlay:hover {
            opacity: 1;


        }

        .cardimage {
            position: relative;
            width: 100%;

        }

        .cardimg-fluid {
            display: block;
            width: 100%;

        }

        .cardtheme {

            margin-top: -25px;

        }

        .cardform_untill {
            border-radius: 23px;
            max-width: fit-content;
            padding-bottom: 0.5rem;
            background-color: white;
        }

        .cardimage__overlay {
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

        .cardimage__overlay>* {
            transform: translateY(20px);
            / transform: translateX(200px);/ / transform: matrix(100%);/
        }

        .cardimage__overlay:hover {
            opacity: 1;


        }
    </style>
@endsection
