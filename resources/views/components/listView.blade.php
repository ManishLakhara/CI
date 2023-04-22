<div class="row pt-4 py-3" id="listViewContent" style="display: none;">
    @foreach ($data as $item)
        {{-- This is list view --}}
        <div class="row py-3">
            <div class="col-lg-12 col-xl-4 py-2">
                <div class="position-relative">
                    <img class="img-fluid w-100"
                    @if($item->missionMedia->where('default','1')->first()!= Null)
                        src="{{asset('storage/'.$item->missionMedia->where('default','1')->first()->media_path)}}"
                    @endif alt="default mission image" style="width:408px;max-height:249px">
                    <div class="position-absolute current-status">
                    @if($item->missionApplication->where('user_id',$user_id)->first()!=Null)
                            @if($item->missionApplication->where('user_id',$user_id)->first()->approval_status=='PENDING'
                            || $item->missionApplication->where('user_id',$user_id)->first()->approval_status=='APPROVE'
                            )
                            <span class="badge bg-success fs-6">Applied</span>
                            @elseif ($item->missionApplication->where('user_id',$user_id)->first()->approval_status=='DECLINE')
                            <span class="badge bg-danger fs-6">Decline</span>
                            @endif
                    @endif
                    @if($item->end_date < now())
                    <div class="position-absolute current-status" style="top: 0">
                        <span class="badge bg-warning fs-6">&nbsp;&nbsp; Closed&nbsp;&nbsp;  </span>
                    </div>
                    @endif
                    @if($item->TimeMission!=Null && $item->TimeMission->registration_deadline < now()|| ($item->TimeMission!=Null && $item->TimeMission->total_seats <= 0))
                        <div class="position-absolute current-status" style="top: 0">
                            <span class="badge bg-warning fs-6">&nbsp;&nbsp; Closed&nbsp;&nbsp;  </span>
                        </div>
                    @endif
                    <span id="applied_l_badge_{{$item->mission_id}}" style="display: none;" class="badge bg-success fs-6 applied_badge_{{$item->mission_id}}">Applied</span>
                </div>
                    <span class="position-absolute parent_mission_location">
                        <span class="mission_location px-2 py-1">
                            <img src={{ asset('Images/pin.png') }} alt="pin" style="width:15px;height:20px"><span
                                class="text-white px-2">{{ $item->city->name }}</span>
                        </span>
                    </span>
                    <div class="position-absolute parent_like_btn">
                        <button type="button" aria-label="like_mission" name="like" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="mission_like_btn_{{$item->mission_id}}_{{$user_id}} like_btn py-1">
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
                        <input type="radio" name="imgbackground" class="mission_like_input_{{$item->mission_id}}_{{$user_id}} d-none py-1 hidden" style="display: none"
                        value={{$value}}
                        >
                        {{-- </label> --}}
                    </div>
                    <div class="position-absolute parent_add_btn">
                        <button name="invite" aria-label="mission_invite" class="invite add_btn py-1"  data-toggle="modal" data-target="#invite_user_modal_l_{{$item->mission_id}}_{{$user_id}}"><img src={{ asset('Images/user.png') }}
                                alt="user" style="width:22px;height:22px;"></button>
                    </div>
                    <div class="text-center" style="z-index: 1; margin-top: -25px">
                        <span class="fs-5 px-2 from_untill">
                            {{ $item->missionTheme->title }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-8">
            <div class="container px-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-start justify-content-sm-between">
                            <div class="d-flex d-flex-inline align-items-center">
                                <img src="{{asset('Images/pin1.png')}}" alt="pin" style="width:18px;height:24px"> <span >{{$item->city->name}}</span>
                            </div>
                            <div class="d-flex d-flex-inline align-items-center">
                                <img src="{{asset('Images/web.png')}}" alt="web" style="width:21px;height:21px"> <span >{{$item->missionTheme->title}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-start justify-content-sm-between">
                            <div class="d-flex d-flex-inline align-items-center">
                                <img src="{{asset('Images/organization.png')}}" alt="organization" style="width:27px;height:17px"><span >{{$item->organization_name}}</span>
                            </div>
                            <div class="d-flex d-flex-inline">
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
                </div>
                <div class="click-to-details_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}">
                    <div class="h4 text-start theme-color pt-4 mission-title">
                        {{ $item->title }}
                    </div>
                    <p class='text-start mission-short-description'>
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
                                                <img src={{ asset('Images/seats-left.png') }} alt="seat_left" style="width:25px;height:25px">
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
                                                <img src={{ asset('Images/deadline.png') }} alt="deadline" style="width:33px;height:33px">
                                            </div>
                                            <div class=" px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-7 font-weight-bolder">{{ date('d-m-Y', strtotime($item->timeMission->registration_deadline)) }} <br></span>
                                                <span class="text-muted">Registration Deadline</span>
                                            </div>
                                        </div>
                                    @elseif($item->goalMission!=null)
                                    @php
                                        $achieved=0;
                                        foreach($item->timeSheet->where('status','APPROVED') as $sheet){
                                            $achieved += $sheet->action;
                                        }
                                    @endphp
                                        <div class='col w-100 d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/achieved.png') }} alt="achieved" style="width:24px;height:24px">
                                            </div>
                                            <div class="px-2 w-100 d-flex flex-column ">
                                                <div class="progress ">
                                                    <div class="progress-bar" aria-label="goal_reached" name="goal_status" role="progressbar" style="width: {{($achieved/$item->goalMission->goal_value)*100}}%" aria-valuenow="{{$achieved}}" aria-valuemin="0" aria-valuemax="{{$item->goalMission->goal_value}}"></div>
                                                </div>
                                                <span class="text-muted text-start"><small>{{$achieved}} Achieved</small></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class='col-6 d-flex align-items-center'>
                                        <div class="px-1">
                                            <img src={{ asset('Images/calender.png') }} alt="calender" style="width:21px;height:20px">
                                        </div>
                                        <div class=" px-2 d-flex flex-column align-items-start">
                                            <small class="p-2 fs-8">
                                                {{ date('d-m-Y', strtotime($item->end_date)) }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class='col-6 d-flex align-items-center'>
                                        <div class="px-1">
                                            <img src={{ asset('Images/settings.png') }} alt="settings" style="width:18px;height:18px">
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
                        @if ($item->end_date>=now() &&
                        !($item->timeMission!=Null &&
                        $item->timeMission->registration_deadline < now()) &&
                        ($item->end_date >now()) &&
                        (collect($item->missionApplication->where('user_id',$user_id))->isEmpty()))
                        <button name="applymission" type="button" id="mission_application_l_btn_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="btn btn-lg fs-6 apply-btn w-100"
                            > Apply <i class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                        @else
                        <a name="viewDetails" href="{{route('mission-page',$item->mission_id)}}"><button name="viewDetails" id="mission_detail_l_btn_{{$item->mission_id}}" class="w-100 mx-2 btn btn-outline apply-btn fs-6 px-2"
                            > View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                        </button></a>
                        @endif
                        <a name="viewDetails" href="{{route("mission-page",$item->mission_id)}}">
                            <button name="viewDetail" style="display: none; text-decoration: none;" id="mission_detail_l_btn_{{$item->mission_id}}" class="mx-2 fs-6 btn btn-outline apply-btn px-2" style="width: fit-content"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                            </button></a>
                    </div>
                </div>
            </div></div>
        </div>
        {{-- Modal --}}
        <div class="modal fade w-100" id="invite_user_modal_l_{{$item->mission_id}}_{{$user_id}}" tabindex="-1" role="dialog" aria-labelledby=".invite_user_modal_{{$item->mission_id}}_{{$user_id}}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title invite_user_modal_{{$item->mission_id}}_{{$user_id}}Label">Invite Your Friends</h5>
                    <button name="close" type="button" class="close btn" data-dismiss="modal" aria-label="Close">
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
                                        <input type="checkbox" class="invite" data-mission_id="{{$item->mission_id}}" data-to_user_id="{{$user->user_id}}" data-from_user_id="{{$user_id}}" value="{{$user->user_id}}" value="{{$user->user_id}}">
                                    </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            </table>
                    </div>
                    <div class="modal-footer">
                    <button name="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>


