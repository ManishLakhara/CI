@extends('layouts.app')
@section('title')
    Story Details
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mt-5">

                {{-- <img class="d-block w-100 h-100" src="{{ asset('images/growsharestory.png') }}" class="img-fluid"
                    alt="First slide"> --}}
                <div class="col-lg-6 w-100 h-100">{{-- This is carousel Code --}}
                    <div class="carousel-thumbnail">
                        <div class="top-image">
                            @foreach ($story->storyMedia as $media)
                                <div class="image p-1">
                                    <img class="img-fluid w-100 h-100" src={{ asset('storage/' . $media->path) }}
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="slidebar-nav">
                        <div class="multiple-items">
                            @foreach ($story->storyMedia as $media)
                                <div class="image p-1">
                                    <img class="img-fluid w-100 h-100" src={{ asset('storage/' . $media->path) }}
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 mt-5">
                <div class="row">
                    <div class="d-flex justify-content-start">
                        <img class="rounded-circle px-2 ms-3 mb-2 " id="header-avatar"
                            src="{{ asset($story->user->avatar) }}" alt="Profile">

                    </div>
                    <div class="col-xl-12">
                        <span class="ms-4 px-2" id="userAvatar">{{ $story->user->first_name }}
                            {{ $story->user->last_name }}</span>

                        <button type="button" class="btn px-2   btn-outline-secondary float-end rounded-pill "><i
                                class="fa fa-eye"></i>&nbsp;12,000 Views</button>
                    </div>

                    <div class="row ms-3 mt-3">{!! $story->user->why_i_volunteer !!}</div>
                    <div class="row">
                        <div class=" mt-4">
                            <button type="button" class="btn px-4  ms-5 btn-outline-secondary  rounded-pill"
                                id="story_invite_btn_{{ $story->story_id }}_{{ $user->user_id }}" data-toggle="modal"
                                data-target="#invite_user_modal_{{ $story->story_id }}_{{ $user->user_id }}"><i
                                    class="fa fa-square"></i>&nbsp;Recommend to a Co-Worker</button>



                            <div class="position-absolute parent_add_btn">

                                <div class="modal fade w-100"
                                    id="invite_user_modal_{{ $story->story_id }}_{{ $user->user_id }}" tabindex="-1"
                                    role="dialog"
                                    aria-labelledby="invite_user_modal_{{ $story->story_id }}_{{ $user->user_id }}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="invite_user_modal_{{ $story->story_id }}_{{ $user->user_id }}Label">
                                                    Invite Your Friends</h5>
                                                <button type="button" class="close btn" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">First</th>
                                                            <th scope="col">last</th>
                                                            <th scope="col">email</th>
                                                            <th scope="col">Invite</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userdetails as $userdetail)
                                                            <tr>
                                                                <th>{{ $userdetail->first_name }}</th>
                                                                <td>{{ $userdetail->last_name }}</td>
                                                                <td>{{ $userdetail->email }}</td>
                                                                <td>
                                                                    <input type="checkbox"
                                                                        id="invite_{{ $story->story_id }}_{{ $userdetail->user_id }}_{{ $user->user_id }}"
                                                                        value="{{ $userdetail->user_id }}">
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <a href="{{ route('mission-page', $story->mission_id) }}"
                                class="btn px-4 btn-outline-warning rounded-pill ms-3">Open Mission&nbsp;<i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-12">
            <ul class="nav nav-tabs mt-3 px-2" id="myTab" role="tablist">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-1" type="button" role="tab"
                    aria-controls="home" aria-selected="flase"
                    style="border:none; border-bottom: 2px solid #5c5c5c;
                    color: #474747;
                    font-weight: 500; font-family: Roboto; font-size:large">{{ $story->title }}</a>
            </ul>
            <div class="row mt-3 justify-content-center">
                {!! $story->description !!}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.top-image').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.multiple-items'
            });
            $('.multiple-items').slick({
                infinite: true,
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.top-image',
                centerMode: false,
                focusOnSelect: true,
                responsive: [{
                        breakpoint: 1399,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 433,
                        settings: {
                            slidesToScroll: 1,
                            slidesToShow: 1
                        }
                    },
                ]
            })
        });
        $('input[id^="invite_"]').on('click', function() {
            if (this.checked) {
                var story_id = this.id.split("_")[1];
                var to_user_id = this.id.split('_')[2];
                var from_user_id = this.id.split("_")[3];
                console.log(story_id);
                $.ajax({
                    url: "{{ url('api/invite-users') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        from_user_id: from_user_id,
                        to_user_id: to_user_id,
                        story_id: story_id,
                    },
                    success: function(data) {
                        alert("Invite Send", 1000);
                    },
                })
            }
        });
    </script>
@endsection
