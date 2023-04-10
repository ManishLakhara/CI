<div class="row py-3" id="listViewContent" style="display: none;">
    @foreach ($data as $item)
        {{-- This is list view --}}
        <div class="row  py-3">
            <div class="col-lg-12 col-xl-4 py-2">
                <div class="position-relative">
                    <img class="img-fluid w-100"
                    @if($item->missionMedia->where('default','1')->first()!= Null)
                        src="{{asset('storage/'.$item->missionMedia->where('default','1')->first()->media_path)}}"
                    @endif alt="">
                    <div class="position-absolute current-status">
                    @if(count($item->missionApplication->where('user_id',$user_id))!==0)
                            @if($item->missionApplication->where('user_id',$user_id)->first()->approval_status=='PENDING'
                            || $item->missionApplication->where('user_id',$user_id)->first()->approval_status=='APPROVE'
                            )
                            <span class="badge bg-success fs-6">Applied</span>
                            @elseif ($item->missionApplication->where('user_id',$user_id)->first()->approval_status=='DECLINE')
                            <span class="badge bg-danger fs-6">Decline</span>
                            @endif
                    @endif
                    <span id="applied_l_badge_{{$item->mission_id}}" style="display: none;" class="badge bg-success fs-6">Applied</span>
                </div>
                    <span class="position-absolute parent_mission_location">
                        <span class="mission_location px-2 py-1">
                            <img src={{ asset('Images/pin.png') }} alt=""><span
                                class="text-white px-2">{{ $item->city->name }}</span>
                        </span>
                    </span>

                    <div class="position-absolute parent_like_btn">
                        <button id="mission_like_btn_{{$item->mission_id}}_{{$user_id}}" type="button" class="like_btn py-1">
                            <?php $set=false;
                                    $value='0';?>
                            @foreach ($favorite as $fav)
                                @if($fav->mission_id == $item->mission_id)
                                    <i class="fas fa-heart fs-4"></i>
                                    <?php $set=true;
                                    $value=$fav->favorite_mission_id;
                                    ?>
                                    @break
                                @endif
                            @endforeach


                            @if($set==false)
                            <i class="fa-regular fa-heart fs-4"></i>
                            @endif
                        </button>
                        <input type="radio" name="imgbackground" id="mission_like_input_{{$item->mission_id}}_{{$user_id}}" class="d-none imgbgchk py-1 hidden" style="display: none"
                        value={{$value}}
                        >
                        {{-- </label> --}}
                    </div>

                    <div class="position-absolute parent_add_btn">
                        <button class="add_btn py-1" id="misison_invite_btn_{{$item->mission_id}}_{{$user_id}}" data-toggle="modal" data-target="#invite_user_modal_{{$item->mission_id}}_{{$user_id}}"><img src={{ asset('Images/user.png') }}
                                alt=""></button>
                    </div>



                    <div class="text-center" style="z-index: 1; margin-top: -25px">
                        <span class="fs-4 px-2 from_untill" style="">
                            {{ $item->missionTheme->title }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 p-2">
                <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex">
                            <div>
                                <img src="{{asset('Images/pin1.png')}}" alt=""> {{$item->city->name}}
                            </div>
                            <div class="px-2">
                                <img src="{{asset('Images/web.png')}}" alt=""> {{$item->missionTheme->title}}
                            </div>
                            <div class="px-2">
                                <img src="{{asset('Images/organization.png')}}" alt=""> {{$item->organization_name}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end">
                            <div>
                                <?php
                                    $user_rating = $item->missionRating;
                                    $rating = $user_rating->pluck('rating')->toArray();
                                    $count = count($rating);
                                    if($count=='0'){
                                        $avg_rating = 0;
                                    }
                                    else{
                                        $avg_rating = ceil(array_sum($rating)/$count);
                                    }
                                ?>
                                <div class="small-ratings">
                                    @for ($i=0;$i<5;$i++,$avg_rating--)
                                        @if($avg_rating>0)
                                            <i class="fa fa-star rating-color"></i>
                                        @else
                                            <i class="fa fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="click-to-details_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}">
                    <div class="h4 theme-color pt-4 mission-title">
                        {{ $item->title }}
                    </div>
                    <p class='mission-short-description'>
                        {{ $item->short_description }}
                    </p>
                </div>
                <div class="row justify-content-end">
                    <div class="col-xxl-9">
                        <div class="row align-items-center">
                            <div class="col-lg-6 align-item-center">
                                <div class="row">
                                    @if ($item->timeMission!=null)
                                        <div class="col-6 d-flex align-items-center">
                                            <div class="px-1">
                                                <img src={{ asset('Images/seats-left.png') }} alt="">
                                            </div>
                                            <div class="px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-5 font-weight-bolder">{{$item->timeMission->total_seats}}<br></span>
                                                <span class="text-muted">Seats left</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($item->timeMission!=null)
                                        <div class='col-6 d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/deadline.png') }} alt="">
                                            </div>
                                            <div class=" px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-7 font-weight-bolder">{{ date('d-m-Y', strtotime($item->timeMission->registration_deadline)) }} <br></span>
                                                <span class="text-muted">Registration Deadline</span>
                                            </div>
                                        </div>
                                    @elseif($item->goalMission!=null)
                                        <div class='col-6 d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/achieved.png') }} alt="">
                                            </div>
                                            <div class="px-2 d-flex flex-column ">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="text-muted"><small>{{$item->goalMission->goal_value}} Achieved</small></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class='col-6 d-flex align-items-center'>
                                        <div class="px-1">
                                            <img src={{ asset('Images/calender.png') }} alt="">
                                        </div>
                                        <div class=" px-2 d-flex flex-column align-items-start">
                                            <small class="p-2 fs-8">
                                                {{ date('d-m-Y', strtotime($item->end_date)) }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class='col-6 d-flex align-items-center'>
                                        <div class="px-1">
                                            <img src={{ asset('Images/settings.png') }} alt="">
                                        </div>
                                        <div class=" px-2 d-flex flex-column align-items-start">
                                            <small class="p-2 fs-6 theme-color"> Skills <br>
                                                @foreach ($item->skill as $i_skill)
                                                    {{$i_skill->skill_name}}
                                                    @break
                                                @endforeach
                                                </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3">

                        <button type="button" id="mission_application_l_btn_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="btn btn-lg fs-6 apply-btn w-100"
                            @if(count($item->missionApplication->where('user_id',$user_id))!==0) style="display: none;" @endif
                            > Apply <i
                                class="fa-sharp fa-solid fa-arrow-right"></i> </button>

                        <a href="{{route('mission-page',$item->mission_id)}}"><button id="mission_detail_l_btn_{{$item->mission_id}}" class="w-100 mx-2 btn btn-outline apply-btn fs-6 px-2"
                            @if(count($item->missionApplication->where('user_id',$user_id))===0) style="display: none;" @endif
                            > View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                        </button></a>

                    </div>
                </div>
            </div></div>
        </div>
        {{-- Modal --}}
        <div class="modal fade w-100" id="invite_user_modal_{{$item->mission_id}}_{{$user_id}}" tabindex="-1" role="dialog" aria-labelledby="invite_user_modal_{{$item->mission_id}}_{{$user_id}}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="invite_user_modal_{{$item->mission_id}}_{{$user_id}}Label">Invite Your Friends</h5>
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
                                        <input type="checkbox" id="invite_{{$item->mission_id}}_{{$user->user_id}}_{{$user_id}}" value="{{$user->user_id}}">
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
    @endforeach
    </div>


