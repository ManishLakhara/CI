
@extends('layouts.app')
@section('content')
<?php
    // use Carbon\Carbon;
    // $currentDateTime = Carbon::now();
    // $formattedDateTime = $currentDateTime->format('l, F j, Y, g:iA');
    $user_id = Auth::user()->user_id;

    dd($avg_rating);
?>
    <div class="container">
        <div class="row p-5">
            <div class="col-lg-6">{{--This is carousel Code--}}
                <div class="carousel-thumbnail">
                    <div class="top-image">
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Animal-welfare-&-save-birds-campaign-1.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-5.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Education-Supplies-for-Every--Pair-of-Shoes-Sold-2.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Grow-Trees-On-the-path-to-environment-sustainability-2.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Nourish-the-Children-in--African-country.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Plantation-and-Afforestation-programme.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="slidebar-nav">
                    <div class="multiple-items">
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Animal-welfare-&-save-birds-campaign-1.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-5.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Education-Supplies-for-Every--Pair-of-Shoes-Sold-2.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Grow-Trees-On-the-path-to-environment-sustainability-2.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Nourish-the-Children-in--African-country.png')}}" alt="">
                        </div>
                        <div class="image p-1">
                            <img class="img-fluid w-100 h-100" src="{{asset('Images/Plantation-and-Afforestation-programme.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fs-2" style="color: #414141">
                    {{$mission->title}}
                </div>
                <div class="fs-4 py-3 text-secondary">
                    {{$mission->short_description}}
                </div>
                <div class="Border-top py-4"></div>


                <div class="text-center" style="margin-top: -60px;">
                    <small class="p-2 fs-6 border from_untill text-secondary">
                        @if($mission->timeMission!=null) From {{ date('d-m-Y', strtotime($mission->start_date)) }} untill {{ date('d-m-Y', strtotime($mission->end_date)) }}
                        @elseif($mission->goalMission!=null) {{$mission->goalMission->goal_objective_text}}
                        @endif
                    </small>
                </div>

                <div class="row py-2">
                    <div class="col-lg-6 col-12 py-2 py-sm-4 ">
                        @if (true)
                            <div class="d-flex justify-content-start ">
                                <div class="px-1">
                                    <img src={{ asset('Images/seats-left.png') }} alt="">
                                </div>
                                <div class="px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder"> 10 <br></span>
                                    <span class="text-muted">Seats left</span>
                                </div>
                            </div>
                        @endif
                        @if(false)
                            <div class="d-flex align-items-center ">
                                <div class="px-1">
                                    <img src={{ asset('Images/Already-volunteered.png') }} alt="">
                                </div>
                                <div class="px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{$item->timeMission->total_seats}}<br></span>
                                    <span class="text-muted"><small>Already volunteered</small></span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-12 py-2">
                        @if($mission->timeMission)
                            <div class='d-flex align-items-center'>
                                <div class="px-1">
                                    <img src={{ asset('Images/deadline.png') }} alt="">
                                </div>
                                <div class=" px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{ date('d-m-Y', strtotime($mission->timeMission->registration_deadline)) }}<br></span>
                                    <span class="text-muted">Deadline</span>
                                </div>
                            </div>
                        @elseif($mission->goalMission)
                            <div class='d-flex justify-content-start py-2 py-sm-4 w-lg-75 w-100'>
                                <div class="px-1">
                                    <img src={{ asset('Images/achieved.png') }} alt="">
                                </div>
                                <div class="d-flex flex-column ps-2 w-100">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="text-muted fs-6">{{$mission->goalMission->goal_value}} achieved</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="Border-top"></div>
                <div class="row py-4">
                    <div class="col-xxl-6 col-12 py-3">
                        <button id="this_mission_like_btn_{{$mission->mission_id}}_{{$user_id}}" class="btn btn-outline-secondary w-100 border-2" style="border-radius: 23px">
                            @if($mission->favoriteMission==null)
                                <?php $value=0?>
                                <span class="text-center">
                                    <i class="fa-regular fa-heart fs-4 text-secondary px-1"></i>
                                    Add to favorite
                                </span>
                            @else
                                <?php $value=$mission->favoriteMission->favorite_mission_id?>
                                <span class="text-center">
                                    <i class="fas fa-heart fs-4 text-secondary px-1"></i>
                                    Added to favorites
                                </span>
                            @endif
                        </button>
                        <input type="radio" name="imgbackground" id="this_mission_like_input_{{$mission->mission_id}}_{{$user_id}}" class="d-none imgbgchk py-1 hidden" style="display: none" value={{$value}}>
                    </div>
                    <div class="col-xxl-6 col-12 py-3">
                        <button class="btn btn-outline-secondary w-100 border-2" id="misison_invite_btn_{{$mission->mission_id}}_{{$user_id}}" data-toggle="modal" data-target="#invite_user_modal_{{$mission->mission_id}}_{{$user_id}}" style="border-radius: 23px">
                            <span class="text-center">
                                <img class="px-1" src={{ asset('Images/add1.png') }} alt="">
                                Recommend to a Co-worker
                            </span>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade w-100" id="invite_user_modal_{{$mission->mission_id}}_{{$user_id}}" tabindex="-1" role="dialog" aria-labelledby="invite_user_modal_{{$mission->mission_id}}_{{$user_id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="invite_user_modal_{{$mission->mission_id}}_{{$user_id}}Label">Invite Your Friends</h5>
                                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
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
                                                @foreach ($users as $user)
                                                    <tr>
                                                    <th>{{$user->first_name}}</th>
                                                    <td>{{$user->last_name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        <input type="checkbox" id="invite_{{$mission->mission_id}}_{{$user->user_id}}_{{$user_id}}" value="{{$user->user_id}}">
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="Border-top"></div>
                <div class="d-flex justify-content-center position-relative" style="margin-top: -35px">
                        <div class='rating bg-white' data-mission_id="{{$mission->mission_id}}" data-user_id="{{$user_id}}">
                            <input type="radio" name="rating_5"
                            @if ($my_rating!=null)
                                @if($my_rating->rating=='5')
                                    checked
                                @endif
                            @endif
                            value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating_4"
                            @if ($my_rating!=null)
                                @if($my_rating->rating=='4')
                                    checked
                                @endif
                            @endif
                            value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating_3"
                            @if ($my_rating!=null)
                                @if($my_rating->rating=='3')
                                    checked
                                @endif
                            @endif
                            value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating_2"
                            @if ($my_rating!=null)
                                @if($my_rating->rating=='2')
                                    checked
                                @endif
                            @endif
                            value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating_1"
                            @if ($my_rating!=null)
                                @if($my_rating->rating=='1')
                                    checked
                                @endif
                            @endif
                            value="1" id="1"><label for="1">☆</label>
                        </div>
                    {{-- <small class="p-2 fs-6 text-center text-secondary" style="background-color: white">
                        <span class="far fa-star fs-5 "></span>
                        <span class="far fa-star fs-5 "></span>
                        <span class="far fa-star fs-5 "></span>
                        <span class="far fa-star fs-5 "></span>
                        <span class="far fa-star fs-5"></span>
                    </small> --}}
                </div>
                <div class="row pt-3"> {{--This is cards --}}
                    <div class="col-xxl-3 col-md-6 col-6 col-xs-12 p-2">
                        <div class="card" style="height: 9em">
                            <div class="card-body">
                              <h5 class="card-title pb-4"><img src={{ asset('Images/pin1.png') }} alt=""></h5>
                                <h6 class="card-subtitle text-muted">City</h6>
                                <p class="card-text">{{$mission->city->name}}</p>
                              </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-6 col-xs-12 p-2">
                        <div class="card" style="height: 9em">
                            <div class="card-body">
                              <h5 class="card-title pb-4"><img src={{asset('Images/web.png')}} alt=""></h5>
                              <h6 class="card-subtitle text-muted">Theme</h6>
                              <p class="card-text">{{$mission->missionTheme->title}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-6 col-xs-12 p-2">
                        <div class="card" style="height: 9em">
                            <div class="card-body">
                              <h5 class="card-title pb-3"><img src={{ asset('Images/pin1.png') }} alt=""></h5>
                              <h6 class="card-subtitle text-muted">Date</h6>
                              <p class="card-text">
                                {{date('d-m-Y', strtotime($mission->start_date))}}
                              </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-6 col-xs-12 p-2">
                        <div class="card" style="height: 9em">
                            <div class="card-body">
                              <h5 class="card-title pb-3"><img src={{asset('Images/organization.png')}} alt=""></h5>
                              <h6 class="card-subtitle text-muted">Organization</h6>
                              <p class="card-text">{{$mission->organization_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-4 justify-content-center align-item-center" >{{--Apply Button--}}
                    <div class="col-6 align-self-center">
                        <form action="#">
                            <button type="submit text-center" class="btn btn-lg fs-5 apply-btn w-100"> Apply <i
                                    class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="row">
                <div class="col-md-7">
                    <ul class="nav border-bottom" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="mission-detail-tab" data-toggle="tab" href="#mission-detail" role="tab" aria-controls="mission-detail" aria-selected="false">Mission</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="organization-detail-tab" data-toggle="tab" href="#organization-detail" role="tab" aria-controls="organization-detail" aria-selected="false">Organization</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Comment-detail-tab" data-toggle="tab" href="#Comment-detail" role="tab" aria-controls="Comment-detail" aria-selected="false">Comments</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="mission-detail" role="tabpanel" aria-labelledby="mission-detail-tab">
                            <h1 class="fs-4 py-1 theme-color">Introduction</h1>
                            <p class="text-muted">{{$mission->short_description}}</p>
                            <p class="text-muted">{!!$mission->description!!}</p>

                            <h1 class="fs-4 py-1 theme-color">Challenges</h1>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, quasi? Dicta fugiat, saepe exercitationem laudantium dignissimos odio veniam expedita culpa sequi quia. Eveniet consequatur quas ratione ut exercitationem consequuntur accusamus.</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, quasi? Dicta fugiat, saepe exercitationem laudantium dignissimos odio veniam expedita culpa sequi quia. Eveniet consequatur quas ratione ut exercitationem consequuntur accusamus.</p>

                            <h1 class="fs-4 py-1 theme-color">Documents</h1>
                            <div class="row">
                                <div class="p-1 col-lg-4 col-md-6 col-12">
                                    <button class="btn py-2 btn-outline border text-center" style="border-radius: 23px">
                                        <img src={{asset('Images/pdf.png')}} alt=""> random-pdf-type-doc
                                    </button>
                                </div>
                                <div class="p-1 col-lg-4 col-md-6 col-12">
                                    <button class="btn py-2 btn-outline border text-center" style="border-radius: 23px">
                                        <img src={{asset('Images/doc.png')}} alt=""> random-doc-type-doc
                                    </button>
                                </div>
                                <div class="p-1 col-lg-4 col-md-6 col-12">
                                    <button class="btn py-2 btn-outline border text-center" style="border-radius: 23px">
                                        <img src={{asset('Images/xlsx.png')}} alt=""> random-xlsx-type-doc
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="organization-detail" role="tabpanel" aria-labelledby="organization-detail-tab">
                            {{$mission->organization_detail}}
                        </div>
                        <div class="tab-pane fade " id="Comment-detail" role="tabpanel" aria-labelledby="Comment-detail-tab">
                            <form id="comment_form">
                                <div class="form-outline">
                                    <textarea class="form-control" id="your_comment" data-mission_id={{$mission->mission_id}} data-user_id={{$user_id}} rows="3" placeholder="Enter your comments"></textarea>
                                </div>
                                <div id="your_comment_error" class="text-danger"></div>
                                <div class="py-3">
                                    <button type="submit" class="form-outline btn btn-outline apply-btn" id="your_comment_btn">Post comment</button>
                                </div>
                            </form>
                            <div class="container comment" id='comment' data-mission_id={{$mission->mission_id}} data-user_id={{$user_id}}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card px-4">
                        <div class="card-body">
                            <div class="card-title fs-4">
                                <ul class="nav border-bottom"><span class="nav-link active"> Information </span></ul>
                            </div>
                            <div class="card-text py-3">
                                <div class="row">
                                    <div class="col-md-3 fs-6 theme-color"> Skills</div>
                                    <div class="col-md-9 fs-6 theme-color">
                                        @foreach ($skills as $skill)
                                            {{$skill}},
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="card-text py-3 ">
                                <div class="row">
                                    <div class="col-md-3 pe-2 fs-6 theme-color"> Days</div>
                                    <div class="col-md-9 fs-6 theme-color">{{$mission->availability}}</div>
                                </div>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="card-text py-3 ">
                                <div class="row">
                                    <div class="col-md-3 pe-2 fs-6 theme-color"> Rating</div>
                                    <div class="col-md-9 fs-6 theme-color">
                                        <div class="small-ratings">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <span class="text-muted">(by 125 Volunteers)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fs-4">
                                <ul class="nav border-bottom"><span class="nav-link active"> Recent Volunteers </span></ul>
                            </div>
                            <div class="card-text">
                                <div class="row" id="volunteer" data-mission_id="{{$mission->mission_id}}">
                                {{-- @include('components.recentvolunteers') --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid border-bottom py-4"></div>
        <div class="py-4"></div>
        <div class="d-flex justify-content-center py-4">
            <h1 class="fs-2 theme-color">Related Mission</h1>
        </div>
        <div class="container">
            @include('components.gridView')
            {{-- @include('admin.layouts.pagination') --}}
        </div>

    </div>
    <script>
        function getComment(){
            const options = {
            weekday: 'long',
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true,
            timeZoneName: 'short'
            };
            $('#comment').html('');
            $.ajax({
                url: "{{url('api/fetch-comment')}}",
                type: "POST",
                data: {
                    mission_id: $('#comment').data('mission_id'),
                },
                dataType: 'json',
                success: function(result){
                    result.forEach(comment => {
                        html = '<div class="row">';
                        html += '<div class="col-2 text-center">';
                        html += '<img class="img-fluid rounded-circle" src="http://127.0.0.1:8000/'+comment['avatar']+'" width="60px" height="60px" alt="">';
                        html += '</div>';
                        html += '<div class="col-10">';
                        html += '<span class="fs-6">'+comment['first_name']+' '+comment['last_name']+'<br></span>';
                        html += '<small>'+new Date(Date.parse(comment['created_at'])).toLocaleString('en-US', options)+'<br></small>';
                        html += '<p class="pt-1">'+comment['text']+'</p>';
                        html += '</div>';
                        html += '</div>';
                        $('#comment').append(html);
                    });
                },
            });
        }
        function getVolunteers(page){
            $.ajax({
                url: "{{url('api/recent-volunteer')}}"+"?page=" + page,
                type: "GET",
                data: {
                    mission_id: $('#volunteer').data('mission_id'),
                },
                success: function(data) {
                    $('#volunteer').html(data);
                }
            })
        }
        $(document).ready(function(){
            getComment();
            getVolunteers(1);
            $('input[name^="rating_"]').on('click', function(){
                let rating = $(this).val();
                $.ajax({
                    url: "{{url('api/add-rating')}}",
                    type: "POST",
                    data: {
                        user_id: $('.rating').data('user_id'),
                        mission_id: $('.rating').data('mission_id'),
                        rating: rating,
                    },
                    success: function(response){
                        console.log(response);
                    }
                })
            })
            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getVolunteers(page);
            })
            $('#comment_form').submit(function(event){
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{url('api/add-comment')}}",
                    data: {
                        mission_id: $('#your_comment').data('mission_id'),
                        user_id: $('#your_comment').data('user_id'),
                        text: $('#your_comment').val(),
                        approval_status: 'PUBLISHED',
                    },
                    success: function(result) {
                        console.log(result);
                        getComment();
                    },
                    error: function(result) {
                        var errors = result.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });
                        $('#your_comment_error').html(errorHtml).show();
                        }
                })
            })
            $("button[id^='mission_like_btn_']").on('click', function() {
                var mission_id = this.id.split("_")[3];
                var user_id = this.id.split("_")[4];
                if($('#mission_like_input_'+mission_id+'_'+user_id).val()=='0'){
                    $.ajax({
                        url: "{{url('api/add-favourite')}}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mission_id: mission_id,
                            user_id: user_id,
                        },
                        success: function(data) {
                            $('#mission_like_input_'+mission_id+'_'+user_id).val(data);
                            $("button[id^='mission_like_btn_"+mission_id+"_"+user_id+"']").html('<i class="fas fa-heart fs-4"></i>');
                        }
                    });
                }
                else{
                    let fav = $('#mission_like_input_'+mission_id+'_'+user_id).val()
                    $.ajax({
                        url: "{{url('api/remove-favourite')}}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mission_id: mission_id,
                            user_id: user_id,
                            favorite_mission_id: fav,
                        },
                        success: function() {
                            $('#mission_like_input_'+mission_id+'_'+user_id).val('0');
                            $("button[id^='mission_like_btn_"+mission_id+"_"+user_id+"']").html('<i class="fa-regular fa-heart fs-4"></i>');
                        }
                    });
                }
            })
            $("button[id^='this_mission_like_btn_']").on('click', function() {
                var mission_id = this.id.split("_")[4];
                var user_id = this.id.split("_")[5];
                if($('#this_mission_like_input_'+mission_id+'_'+user_id).val()=='0'){
                    $.ajax({
                        url: "{{url('api/add-favourite')}}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mission_id: mission_id,
                            user_id: user_id,
                        },
                        success: function(data) {
                            $('#this_mission_like_input_'+mission_id+'_'+user_id).val(data);
                            $("button[id^='this_mission_like_btn_"+mission_id+"_"+user_id+"']")
                            .html('<span class="text-center"><i class="fas fa-heart fs-4 text-secondary px-1"></i>Added to favorites</span>');
                        }
                    });
                }
                else{
                    let fav = $('#this_mission_like_input_'+mission_id+'_'+user_id).val()
                    $.ajax({
                        url: "{{url('api/remove-favourite')}}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mission_id: mission_id,
                            user_id: user_id,
                            favorite_mission_id: fav,
                        },
                        success: function() {
                            $('#this_mission_like_input_'+mission_id+'_'+user_id).val('0');
                            $("button[id^='this_mission_like_btn_"+mission_id+"_"+user_id+"']").html('<span class="text-center"><i class="fa-regular fa-heart fs-4 text-secondary px-1"></i>Add to favorite</span>');
                        }
                    });
                }
            })
            $('input[id^="invite_"]').on('click', function() {
                if (this.checked) {
                    var mission_id = this.id.split("_")[1];
                    var to_user_id = this.id.split('_')[2];
                    var from_user_id = this.id.split("_")[3];
                    console.log(mission_id);
                    $.ajax({
                        url: "{{url('api/invite-user')}}",
                        type: "POST",
                        data: {
                            _token: '{{csrf_token() }}',
                            from_user_id: from_user_id,
                            to_user_id: to_user_id,
                            mission_id: mission_id,
                        },
                        success: function(data) {
                            console.log("Invite Send");
                        },
                    })
                }
            })
            $('.top-image').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.multiple-items'
            })
            $('.multiple-items').slick({
                infinite: true,
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.top-image',
                centerMode: false,
                focusOnSelect: true,
                responsive: [
                    {
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
    </script>
@endsection
