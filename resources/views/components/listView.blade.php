<div class="row py-3" id="listViewContent" style="display: none;">
    @foreach ($data as $item)
        {{-- This is list view --}}
        <div class="row">
            <div class="col-md-4 py-2 text-center">
                <img class="img-fluid" src="{{asset("Images/Grow-Trees-On-the-path-to-environment-sustainability-3.png")}}" alt="">
                <div class="text-center" style="margin-top: -20px">
                    <span class="fs-4 px-2 from_untill">
                        {{ $item->missionTheme->title }}
                    </span>
                </div>
                <div class="position-relative">
                    <div class="position-absolute parent_like_btn_l">


                        <button  id="mission_like_btn_{{$item->mission_id}}_{{$user_id}}" type="button" class="like_btn py-1">
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
                        value={{$value}}>

                    </div>
                    <div class="position-absolute parent_add_btn_l">
                        <button class="add_btn py-1"id="misison_invite_btn_{{$item->mission_id}}_{{$user_id}}" data-toggle="modal" data-target="#invite_user_modal_{{$item->mission_id}}_{{$user_id}}"><img src={{ asset('Images/user.png') }}
                                alt=""></button>
                        {{-- <!-- Modal -->
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
                        </div> --}}
                    </div>
                    <span class="position-absolute parent_mission_location_l">
                        <span class="mission_location px-2 py-1">
                            <img src={{ asset('Images/pin.png') }} alt=""><span
                                class="text-white px-2">{{ $item->city->name }}</span>
                        </span>
                    </span>
                </div>
            </div>
            <div class="col p-2">
                <div class="row align-items-start">
                    <div class="col">
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
                    <div class="col-sm-2">
                        <div class="small-ratings">
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                            <i class="fa fa-star rating-color"></i>
                        </div>
                    </div>
                </div>
                <div class="h4 theme-color pt-4">
                    {{ $item->title }}
                </div>
                <p class='mission-short-description'>
                    {{ $item->short_description }}
                </p>
                <div class="row justify-content-between">
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center ">
                                        <div class="px-1">
                                            <img src={{ asset('Images/seats-left.png') }} alt="">
                                        </div>
                                        <div class="px-2 d-flex flex-column align-items-start">
                                            <span class="theme-color fs-5 font-weight-bolder">10 <br></span>
                                            <span class="text-muted">Seats left</span>
                                        </div>
                                    </div>
                                    @if ($item->timeMission!=null)
                                        <div class='d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/deadline.png') }} alt="">
                                            </div>
                                            <div class=" px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-5 font-weight-bolder">{{ date('d-m-Y', strtotime($item->timeMission->registration_deadline)) }} <br></span>
                                                <span class="text-muted">Registration Deadline</span>
                                            </div>
                                        </div>
                                    @elseif($item->goalMission!=null)
                                        <div class='d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/achieved.png') }} alt="">
                                            </div>
                                            <div class=" px-2 d-flex flex-column align-items-start">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="80" aria-valuemax="100"></div>
                                                </div>
                                                <span class="text-muted"><small>{{$item->goalMission->goal_value}} Achieved</small></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex">
                                    <div class='d-flex align-items-center'>
                                        <div class="px-1">
                                            <img src={{ asset('Images/calender.png') }} alt="">
                                        </div>
                                        <div class=" px-2 d-flex flex-column align-items-start">
                                            <small class="p-2 fs-7">From
                                                {{ date('d-m-Y', strtotime($item->start_date)) }} <br> untill
                                                {{ date('d-m-Y', strtotime($item->end_date)) }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class='d-flex align-items-center'>
                                        <div class="px-1">
                                            <img src={{ asset('Images/settings.png') }} alt="">
                                        </div>
                                        <div class=" px-2 d-flex flex-column align-items-start">
                                            <small class="p-2 fs-6 theme-color"> Skills <br> {{$item->missionSkill->skill->skill_name}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @if(false)
                            <button type="button" id="mission_application_btn" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="btn btn-lg fs-5 apply-btn"> Apply <i
                                class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                        @else
                        <button class="mx-2 btn btn-outline apply-btn px-2"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>


