<div id="gridViewContent" class="row py-3" id="missions">
    @foreach ($data as $item)
        {{-- This is grid view --}}
    <div class="card col-lg-6 col-xl-4 col-md-6 border-0  pb-4 text-center">
        <div class="py-1">
            <img class="card-img-top"
                src={{ asset('Images/Grow-Trees-On-the-path-to-environment-sustainability-3.png') }}
                alt="">
            <div class="position-relative">
                <div class="position-absolute parent_like_btn">

                    {{-- <label for="img1">
                        <input type="radio" name="imgbackground" id="img1" class="d-none imgbgchk py-1" value="">
                        <i class="fa-regular fa-heart fs-4"></i> --}}
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
                    <!-- Modal -->
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
                </div>
                <span class="position-absolute parent_mission_location">
                    <span class="mission_location px-2 py-1">
                        <img src={{ asset('Images/pin.png') }} alt=""><span
                            class="text-white px-2">{{ $item->city->name }}</span>
                    </span>
                </span>
            </div>
        </div>
        <div class="text-center" style="margin-top: -25px">
            <span class="fs-4 px-2 from_untill">
                {{ $item->missionTheme->title }}
            </span>
        </div>
        <div class="card-body">
            <div id="click-to-details_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}">
            <h4 class='mission-title theme-color'>{{ $item->title }}
            </h4>
            <p class='card-text mission-short-description'>
                {{ $item->short_description }}
            </p>
            <div class="d-flex py-2 justify-content-between">
                <div>
                    <span class="theme-color">
                        {{ $item->organization_name }}
                    </span>
                </div>
                <div class="small-ratings">
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star rating-color"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
            </div>
            </div>
            <div class="py-3">
                <div class="border"></div>
                <div class="text-center" style="margin-top: -14px">
                    <small class="p-2 fs-6 border from_untill">From
                        {{ date('d-m-Y', strtotime($item->start_date)) }} untill
                        {{ date('d-m-Y', strtotime($item->end_date)) }}
                    </small>
                </div>
                <div class="py-2">
                    <div class="d-flex py-3 justify-content-between">
                        @if ($item->timeMission!=null)
                            <div class="d-flex align-items-center ">
                                <div class="px-1">
                                    <img src={{ asset('Images/seats-left.png') }} alt="">
                                </div>
                                <div class="px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{$item->timeMission->total_seats}}<br></span>
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
                        @if ($item->timeMission!=null)
                            <div class='d-flex align-items-center'>
                                <div class="px-1">
                                    <img src={{ asset('Images/deadline.png') }} alt="">
                                </div>
                                <div class=" px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{ date('d-m-Y', strtotime($item->timeMission->registration_deadline)) }}<br></span>
                                    <span class="text-muted">Deadline</span>
                                </div>
                            </div>
                        @elseif($item->goalMission!=null)
                            <div class='d-flex align-items-center justify-content-start w-50'>
                                <div class="px-1">
                                    <img src={{ asset('Images/achieved.png') }} alt="">
                                </div>

                                <div class="d-flex flex-column ps-2 w-100">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="fw-light text-secondary ps-1">{{$item->goalMission->goal_value}} achieved</small>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                <div class="border"></div>
            </div>
            <div class="d-flex justify-content-center">
                {{-- <form action="{{route('mission-page',$item->mission_id)}}"> --}}
                @if(true)
                <button type="button" id="mission_application_btn_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="btn btn-lg fs-5 apply-btn"> Apply <i
                    class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                @else
                <button id="mission_detail_btn_{{$item->mission_id}}" class="mx-2 btn btn-outline apply-btn fs-5 px-2"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                </button>
                @endif
                <button style="display: none;" id="mission_detail_btn_{{$item->mission_id}}" class="mx-2 fs-5 btn btn-outline apply-btn px-2" style="width: fit-content"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                </button>
                {{-- </form> --}}
            </div>
        </div>
    </div>
    @endforeach
</div>
