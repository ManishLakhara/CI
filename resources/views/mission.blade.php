@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row p-5">
            <div class="col-md-6">
                {{-- <div class="mission-image">
                    <div class="images">
                        <img src={{asset('Images/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-4.png')}} alt="">
                    </div>
                    <div class="images"><img src={{asset('Images/Grow-Trees-On-the-path-to-environment-sustainability-4.png')}} alt=""></div>
                    <div class="images"><img src={{asset('Images/img1.png')}} alt=""></div>
                    <div class="images"><img src={{asset('Images/Nourish-the-Children-in--African-country-1.png')}} alt=""></div>
                </div> --}}
            </div>
            <div class="col-md-6">
                <div class="fs-2" style="color: #414141">
                    {{$mission->title}}
                </div>
                <div class="fs-4 py-3 text-secondary">
                    {{$mission->short_description}}
                </div>
                <div class="Border-top py-4"></div>

                @if($mission->goalMission!=null)
                <div class="text-center" style="margin-top: -60px;">
                    <small class="p-2 fs-6 border from_untill text-secondary">
                        {{$mission->goalMission->goal_objective_text}}
                    </small>
                </div>
                @endif
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
                    </div>
                    <div class="col-lg-6 col-12 py-2">
                        @if(true)
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
                        <button class="btn btn-outline-secondary w-100 border-2" style="border-radius: 23px">
                            <span class="text-center">
                                <i class="fa-regular fa-heart fs-4 text-secondary px-1"></i>
                                Add to favorite
                            </span>
                            {{-- <span class="text-center">
                                <i class="fas fa-heart fs-4 text-secondary px-1"></i>
                                Added to favorites
                            </span> --}}
                        </button>
                    </div>
                    <div class="col-xxl-6 col-12 py-3">
                        <button class="btn btn-outline-secondary w-100 border-2" style="border-radius: 23px">
                            <span class="text-center">
                                <img class="px-1" src={{ asset('Images/add1.png') }} alt="">
                                Recommend to a Co-worker
                            </span>
                        </button>
                    </div>
                    </div>
                <div class="Border-top"></div>
                <div class="text-center position-relative" style="margin-top: -14px">
                    <small class="p-2 fs-6 text-center text-secondary" style="background-color: white">
                        <span class="fa fa-star fs-5 checked"></span>
                        <span class="fa fa-star fs-5 checked"></span>
                        <span class="fa fa-star fs-5 checked"></span>
                        <span class="fa fa-star fs-5 checked"></span>
                        <span class="far fa-star fs-5"></span>
                    </small>
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
                                OnGoing Opportunity
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
                          <a class="nav-link active" id="mission-detail-tab" data-toggle="tab" href="#mission-detail" role="tab" aria-controls="mission-detail" aria-selected="true">Mission</a>
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
                            <p class="text-muted">{{$mission->description}}</p>

                            <h1 class="fs-4 py-1 theme-color">Challenges</h1>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, quasi? Dicta fugiat, saepe exercitationem laudantium dignissimos odio veniam expedita culpa sequi quia. Eveniet consequatur quas ratione ut exercitationem consequuntur accusamus.</p>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, quasi? Dicta fugiat, saepe exercitationem laudantium dignissimos odio veniam expedita culpa sequi quia. Eveniet consequatur quas ratione ut exercitationem consequuntur accusamus.</p>

                            <h1 class="fs-4 py-1 theme-color">Documents</h1>
                            <div class="row">
                                <div class="p-1 col-4">
                                    <button class="btn py-2 btn-outline border text-center" style="border-radius: 23px">
                                        <img src={{asset('Images/pdf.png')}} alt=""> random-pdf-type-doc
                                    </button>
                                </div>
                                <div class="p-1 col-4">
                                    <button class="btn py-2 btn-outline border text-center" style="border-radius: 23px">
                                        <img src={{asset('Images/doc.png')}} alt=""> random-doc-type-doc
                                    </button>
                                </div>
                                <div class="p-1 col-4">
                                    <button class="btn py-2 btn-outline border text-center" style="border-radius: 23px">
                                        <img src={{asset('Images/xlsx.png')}} alt=""> random-xlsx-type-doc
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="organization-detail" role="tabpanel" aria-labelledby="organization-detail-tab">...</div>
                        <div class="tab-pane fade" id="Comment-detail" role="tabpanel" aria-labelledby="Comment-detail-tab">...</div>
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
                                    <div class="col-md-9 fs-6 theme-color">{{$mission->missionSkill->skill->skill_name}}</div>
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
                    <div class="card px-4">
                        <div class="card-body">
                            <div class="card-title fs-4">
                                <ul class="nav border-bottom"><span class="nav-link active"> Recent Volunteers </span></ul>
                            </div>
                            <div class="card-text py-4">
                                {{-- Users foreach --}}
                            </div>
                            <div class="card-footer text-muted">
                                {{-- User Pagination comes here --}}
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
            {{-- Here comes grid view cards of all related missions --}}
        </div>

    </div>
    <script>
        $(document).ready(function(){
            $('.mission-image').slick();
        });


    </script>
@endsection
