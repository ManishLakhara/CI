<div id="gridViewContent" class="row pt-4 gx-2" id="missions">
    @foreach ($data as $item)
        {{-- This is grid view --}}
    <div class="card col-lg-6 col-md-12 col-xxl-4 col-xl-6 border-0 pb-4 text-center">
        <div class="d-flex justify-content-center py-1 h-100 w-100">
            <div>
                <div class="position-relative" style="max-width: 416px; height: 247px;">
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
                            <span class="badge bg-Warning fs-6">&nbsp;&nbsp; Closed&nbsp;&nbsp;  </span>
                        </div>
                    @endif
                    @if(($item->TimeMission!=Null && $item->TimeMission->registration_deadline < now()) || ($item->TimeMission!=Null && $item->TimeMission->total_seats <= 0))
                        <div class="position-absolute current-status" style="top: 0">
                            <span class="badge bg-Warning fs-6">&nbsp;&nbsp; Closed&nbsp;&nbsp;  </span>
                        </div>
                    @endif


                    <span id="applied_badge_{{$item->mission_id}}" style="display: none;" class="badge bg-success fs-6">Applied</span>

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

                    <img class="img-fluid w-100 h-100 card-img-top"
                    @if($item->missionMedia->where('default','1')->first())
                    src={{ asset('storage/'.$item->missionMedia->where('default','1')->first()->media_path) }}
                    @endif alt="">

                    <div style="z-index: 1; margin-top: -1em">
                        <span class="position-relative fs-5 px-5 from_untill" >
                            {{ $item->missionTheme->title }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body py-2 text-start">
            <div id="click-to-details_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}">
            <h4 class='theme-color mission-title'>{{ $item->title }}
            </h4>
            <p class='card-text mission-short-description'>
                {{ $item->short_description }}
            </p>
            <div class="d-flex py-2 justify-content-between">
                <div>
                    <span class="theme-color" style="display: inline-block; max-width: 150px; line-height: 1em; white-space: normal; overflow: hidden; text-overflow: ellipsis;">
                        {{ $item->organization_name }}
                    </span>
                </div>
                {{-- Mission Rating Code --}}
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
            <div class="py-3">
                <div class="border"></div>
                <div class="text-center" style="margin-top: -14px">
                    <small class="p-2 fs-6 border from_untill">
                        @if($item->timeMission!=null)
                        From
                        {{ date('d-m-Y', strtotime($item->start_date)) }} untill
                        {{ date('d-m-Y', strtotime($item->end_date)) }}
                        @elseif($item->goalMission!=null)
                            {{$item->goalMission->goal_objective_text}}
                        @endif
                    </small>
                </div>
                <div class="py-2">
                    <div class="row py-3 justify-content-between">
                        @if ($item->timeMission!=null)
                            @php
                                $seat_left = $item->timeMission->total_seats-$item->missionApplication->where('approval_status','APPROVE')->count();
                            @endphp
                            <div class="col-md-6 d-flex align-items-center ">
                                <div class="px-1">
                                    <img src={{ asset('Images/seats-left.png') }} alt="">
                                </div>
                                <div class="px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{$seat_left}}<br></span>
                                    <span class="text-muted">Seats left</span>
                                </div>
                            </div>
                        @elseif(collect($item->goalMission)->isNotEmpty())
                            <div class="col-md-6 d-flex align-items-center ">
                                <div class="px-1">
                                    <img src={{ asset('Images/Already-volunteered.png') }} alt="">
                                </div>
                                <div class="px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{$item->missionApplication->where('approval_status','APPROVE')->count()}}<br></span>
                                    <span class="text-muted"><small>Already volunteered</small></span>
                                </div>
                            </div>
                        @endif
                        @if ($item->timeMission!=null)
                            <div class='col-md-6 d-flex align-items-center'>
                                <div class="px-1">
                                    <img src={{ asset('Images/deadline.png') }} alt="">
                                </div>
                                <div class=" px-2 d-flex flex-column align-items-start">
                                    <span class="theme-color fs-5 font-weight-bolder">{{ date('d-m-Y', strtotime($item->timeMission->registration_deadline)) }}<br></span>
                                    <span class="text-muted">Deadline</span>
                                </div>
                            </div>
                        @elseif($item->goalMission!=null)
                        @php
                            $achieved=0;
                            foreach($item->timeSheet->where('status','APPROVED') as $sheet){
                                $achieved += $sheet->action;
                            }
                        @endphp
                            <div class='col-md-6 d-flex align-items-center justify-content-start'>
                                <div class="px-1">
                                    <img src={{ asset('Images/achieved.png') }} alt="">
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{($achieved/$item->goalMission->goal_value)*100}}%" role="progressbar" aria-valuenow="{{$achieved}}" aria-valuemin="0" aria-valuemax="{{$item->goalMission->goal_value}}"></div>
                                    </div>
                                    <small class="fw-light text-secondary ps-1">{{$achieved}} achieved</small>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
                <div class="border"></div>
            </div>
            <div class="d-flex justify-content-center">
               {{-- @if($item->end_date >= now() && !($item->TimeMission!=Null && $item->TimeMission->registration_deadline < now())) --}}
                    {{-- @if((count($item->missionApplication->where('user_id',$user_id))===0))
                        <button type="button" id="mission_application_btn_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="btn btn-lg fs-6 apply-btn"> Apply <i
                            class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                     @else
                        <a href="{{route('mission-page',$item->mission_id)}}"><button id="mission_detail_btn_{{$item->mission_id}}" class="mx-2 btn btn-outline apply-btn fs-6 px-2"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                            </button></a>
                    @endif --}}
               {{-- @endif --}}
               @if($item->end_date>=now() &&
                    !($item->timeMission!=Null &&
                    $item->timeMission->registration_deadline < now()) &&
                    ($item->end_date >now()) &&
                    (collect($item->missionApplication->where('user_id',$user_id))->isEmpty()))
                    <button type="button" id="mission_application_btn_{{$item->mission_id}}" data-mission_id="{{$item->mission_id}}" data-user_id="{{$user_id}}" class="btn btn-lg fs-6 apply-btn"> Apply <i
                        class="fa-sharp fa-solid fa-arrow-right"></i> </button>
               @else
                    <a href="{{route('mission-page',$item->mission_id)}}"><button id="mission_detail_btn_{{$item->mission_id}}" class="mx-2 btn btn-outline apply-btn fs-6 px-2"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                    </button></a>
               @endif
                <a href="{{route("mission-page",$item->mission_id)}}">
                <button style="display: none;" class="mission_detail_btn_{{$item->mission_id}}" class="mx-2 fs-6 btn btn-outline apply-btn px-2" style="width: fit-content"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i>
                </button></a>

            </div>
        </div>
    </div>
    @endforeach
</div>
