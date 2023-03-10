@extends('layouts.app')
@section('content')
<div class="container-fluid border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex rounded">
                <form action={{route('landing.index')}} style="margin: 0%; padding:0%;">
                    <div class="d-flex">
                        <button type="submit" class="btn">
                            <i class="fas fa-search"></i>
                          </button>
                        <div class="form-outline">
                          <input type="search" name="s" placeholder="Search Missions... " value='{{old("s")}}' class="form-control border-0" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-around">
                <div class="border-start input-group h-100 px-2">
                    <select class="custom-select w-100 border-0 text-muted" name="country_id" id="country-dropdown">
                        <option selected>Country</option>
                        @foreach ($countries as $country)
                            <option value={{ $country->country_id }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="border-start input-group px-2">
                    <select class="custom-select w-100 border-0 text-muted" name="city_id" id="city-dropdown">
                        <option selected> city </option>
                    </select>
                </div>
                <div class="border-start input-group px-2">
                    <select class="custom-select  w-100 border-0 text-muted" name="mission_theme_id">
                        <option selected>Theme</option>
                        @foreach ($themes as $theme)
                            <option value={{ $theme->mission_theme_id }}>{{ $theme->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="border-start border-end input-group px-2">
                    <select class="custom-select  w-100 border-0 text-muted">
                        <option selected>Skill</option>
                        @foreach ($skills as $skill)
                            <option value={{ $skill->skill_id }}>{{ $skill->skill_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <div class="container py-4">
        <div id="badges">
            <div class="d-inline-flex border px-2" style="border-radius: 23px">
                <span class="badge fs-5" style="color: black; font-weight: lighter;">india</span>
                <button type="button" class="close btn" style="padding: 0%;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <div class="d-inline-flex border px-2" style="border-radius: 23px">
                <span class="badge fs-5" style="color: black; font-weight: lighter;">india</span>
                <button type="button" class="close btn" style="padding: 0%;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <div class="d-inline-flex border px-2" style="border-radius: 23px">
                <span class="badge fs-5" style="color: black; font-weight: lighter;">india</span>
                <button type="button" class="close btn" style="padding: 0%;">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
            <button class="btn" type="button"> clear all</button>
            </div>
    </div>
    
    <div class=" container  py-3">
        <div class="d-flex py-4 justify-content-between">
            <div>
                <h4> <span class="light-theme-color">Explore</span> <span class="theme-color">{{$count}} Mission</span> </h4>
            </div>
            <div class="d-flex">
                <div class="input-group px-2" style="width: 200px ">
                    <select class="custom-select w-100 border-1 text-muted">
                        <option selected>Sort by</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class='d-flex px-3 justify-content-center align-items-center'>
                    <input type="radio" class="btn-check" name="view" value='0' id="grid-view">
                    <label class="btn p-1 rounded-circle " for="grid-view"><img src={{ asset('Images/grid.png') }}
                            alt=""></label>
                    <input type="radio" class="btn-check" name="view" id="list-view">
                    <label class="btn p-2 rounded-circle" value='1' for="list-view"><img
                            src={{ asset('Images/list.png') }} alt=""></label>
                </div>
            </div>
        </div>
        <div class="row py-3">
            @foreach ($data as $item)
                <div class="card col-lg-6 col-xl-4 col-md-6 border-0  pb-4 text-center">
                    <div class="py-1">
                        <img class="card-img-top"
                            src={{ asset('Images/Grow-Trees-On-the-path-to-environment-sustainability-3.png') }}
                            alt="">
                        <div class="position-relative">
                            {{-- <div class='position-absolute'>
                                <span class="from_untill">
                                    <small class="px-2 fs-5 theme-color">{{ $item->missionTheme->title }}
                                    </small>
                                </span>
                            </div> --}}
                            <form action="#" class="position-absolute parent_like_btn">
                                <button class="like_btn py-1"><i class="fa-regular fa-heart fs-4"></i></button>
                            </form>
                            <form action="#" class="position-absolute parent_add_btn">
                                <button class="add_btn py-1"><img src={{ asset('Images/user.png') }}
                                        alt=""></button>
                            </form>
                            <span class="position-absolute parent_mission_location">
                                <span class="mission_location px-2 py-1">
                                    <img src={{ asset('Images/pin.png') }} alt=""><span
                                        class="text-white px-2">{{ $item->country->name }}</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="text-center" style="margin-top: -25px">
                        <span class="fs-4 px-2 from_untill">
                            {{$item->missionTheme->title}}
                        </span>
                    </div>
                    <div class="card-body">
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
                                    @if (true)
                                        <div class="d-flex align-items-center ">
                                            <div class="px-1">
                                                <img src={{ asset('Images/seats-left.png') }} alt="">
                                            </div>
                                            <div class="px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-5 font-weight-bolder">10 <br></span>
                                                <span class="text-muted">Seats left</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center ">
                                            <div class="px-1">
                                                <img src={{ asset('Images/Already-volunteered.png') }} alt="">
                                            </div>
                                            <div class="px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-5 font-weight-bolder">250<br></span>
                                                <span class="text-muted"><small>Already volunteered</small></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if (true)
                                        <div class='d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/deadline.png') }} alt="">
                                            </div>
                                            <div class=" px-2 d-flex flex-column align-items-start">
                                                <span class="theme-color fs-5 font-weight-bolder">09/01/2019 <br></span>
                                                <span class="text-muted">Deadline</span>
                                            </div>
                                        </div>
                                    @elseif(false)
                                        <div class='d-flex align-items-center'>
                                            <div class="px-1">
                                                <img src={{ asset('Images/achieved.png') }} alt="">
                                            </div>
                                            <div class=" px-2 d-flex flex-column align-items-start">
                                                <input type="range" class="goal-range" name="goal" value="80"
                                                    disabled id="achievedgoal">
                                                <span class="text-muted"><small>8000 Achieved</small></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="border"></div>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-lg fs-5 apply-btn"> Apply <i
                                    class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div> {{-- row-end --}}
        @include('admin.layouts.pagination')
    </div>
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-city') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .city_id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        
    </script>
@endsection
