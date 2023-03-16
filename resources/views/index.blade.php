@extends('layouts.app')
@section('content')
<?php 
    $user_id = 420;
?>
    <div class="container-fluid border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex rounded">
                    <form action="{{route('landing.index')}}" method="GET" id="search-mission" style="margin: 0%; padding:0%;">
                    <div class="d-flex">
                        <button type="submit" id="search-mission-id" class="btn">
                            <i class="fas fa-search"></i>
                        </button>
                        <div>
                            <input type="search" name="s" id="search_input" placeholder="Search Missions... "
                                value='{{ request()->input('s') }}' class="form-control border-0" />
                        </div>
                    </div>
                   </form> 
                </div>
                <div class="col-md-6 d-flex justify-content-around">
                    <button class="btn border-start" type=submit id="refresh-apply">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </button>

                        <button class="btn border-start" type=submit id="filter-apply">
                            <img src="{{asset("Images/filter.png")}}" alt="">
                        </button>
                    
                    
                    <div class="border-start input-group h-100 px-2">
                        <select class="custom-select w-100 border-0 text-muted" name="country_id" id="country-dropdown">
                            <option disabled selected>Country</option>
                            @foreach ($countries as $country)
                                <option value={{ $country->country_id }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="border-start input-group px-2">
                        <select class="custom-select w-100 border-0 text-muted" name="city_id" id="city-dropdown">
                            <option disabled selected> city </option>
                        </select>
                    </div>
                    <div class="border-start input-group px-2">
                        <select class="custom-select  w-100 border-0 text-muted" name="mission_theme_id"
                            id="theme-dropdown">
                            <option disabled selected>Theme</option>
                            @foreach ($themes as $theme)
                                <option value={{ $theme->mission_theme_id }}>{{ $theme->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="border-start border-end input-group px-2">
                        <select class="custom-select  w-100 border-0 text-muted" id="skill-dropdown">
                            <option disabled selected>Skill</option>
                            @foreach ($skills as $skill)
                                <option value={{ $skill->skill_id }}>{{ $skill->skill_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <form id="form_f"  action="{{route('landing.index')}}" method="GET" style="display: none">
        <input  type="number" name="country_f" id="country_f_id" value="{{ request()->input('country_f') }}"/>
        <input  type="number" name="city_f" id="city_f_id" value="{{ request()->input('city_f') }}"/>
        <input type="text" name="s" id="search_f_id" value="{{ request()->input('s') }}"/>
        <input type="number" name="theme_f" id="theme_f_id" value="{{ request()->input('theme_f')}}" />
        <input type="number" name="skill_f" id="skill_f_id" value="{{ request()->input('skill_f_id') }}"/>
        <button class="btn" type="submit" id="submit_f_id"></button>
    </form>




    </div>
    <div class="container py-4">
        <div class="d-flex">
            <div id="badges">
            </div>
            <div id="clear_all">
                <button class="btn close" id="filter-clear"> clear All</button>
            </div>
        </div>

    </div>
@if($count!=0)
    <div class=" container  py-3">
        <div class="d-flex py-4 justify-content-between">
            <div>
                <h4> <span class="light-theme-color">Explore</span> <span class="theme-color" id="noOfMission">{{$count}}
                        Mission</span> </h4>
            </div>
            <div class="d-flex">
                <div class="input-group px-2" style="width: 200px ">
                    <select class="custom-select w-100 border-1 text-muted">
                        <option selected>Sort by</option>
                        <option value="1">time</option>
                        <option value="2">rating</option>
                    </select>
                </div>
                <div class='d-flex px-3 justify-content-center align-items-center'>
                    <input type="radio" class="btn-check px-1" name="view" value='0' checked  id="grid-view">
                    <label  id="grid-view-label" class="btn p-1 rounded-circle" for="grid-view"><img src={{ asset('Images/grid.png') }}
                            alt=""></label>
                    <input type="radio" class="btn-check px-1" name="view" id="list-view">
                    <label id="list-view-label" class="btn p-2 rounded-circle" value='1' for="list-view"><img
                            src={{ asset('Images/list.png') }} alt=""></label>
                </div>
            </div>
        </div>
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
                            {{ $item->missionTheme->title }}
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
             
        </div> 
        
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
                            <form action="#" class="position-absolute parent_add_btn_l">
                                <button class="add_btn py-1"><img src={{ asset('Images/user.png') }}
                                        alt=""></button>
                            </form> 
                            <span class="position-absolute parent_mission_location_l">
                                <span class="mission_location px-2 py-1">
                                    <img src={{ asset('Images/pin.png') }} alt=""><span
                                        class="text-white px-2">{{ $item->country->name }}</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="d-flex">
                                    <div>
                                        <img src="{{asset('Images/pin1.png')}}" alt=""> {{$item->country->name}}
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
                                            @if (false)
                                                <div class='d-flex align-items-center'>
                                                    <div class="px-1">
                                                        <img src={{ asset('Images/deadline.png') }} alt="">
                                                    </div>
                                                    <div class=" px-2 d-flex flex-column align-items-start">
                                                        <span class="theme-color fs-5 font-weight-bolder">09/01/2019 <br></span>
                                                        <span class="text-muted">Registration Deadline</span>
                                                    </div>
                                                </div>
                                            @elseif(true)
                                                <div class='d-flex align-items-center'>
                                                    <div class="px-1">
                                                        <img src={{ asset('Images/achieved.png') }} alt="">
                                                    </div>
                                                    <div class=" px-2 d-flex flex-column align-items-start">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="80" aria-valuemax="100"></div>
                                                          </div>
                                                        <span class="text-muted"><small>8000 Achieved</small></span>
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
                                                    <small class="p-2 fs-6 theme-color"> Skills <br> botany</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>             
                            </div>
                            <div class="col-md-3">
                                <button class="mx-2 btn btn-outline apply-btn px-2"> View Details  <i class=" fa-sharp fa-solid fa-arrow-right"></i> 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @include('admin.layouts.pagination')
    </div>
@else
    <div class="d-flex justify-content-center">
        <span class="fs-3 font-weight-bold theme-color">
            No Mission Found
        </span>
    </div>
    <div class="d-flex pt-4 justify-content-center">
        <button class="btn btn-outline fs-4 apply-btn">
            Submit New Missions 
            <i class="fa-sharp fa-solid fa-arrow-right"></i>
        </button>
    </div>
@endif
    <script>
        $(document).ready(function() {
            $('#grid-view').on('click', function() {
                $('#grid-view-label').css({'background-color': '#D9D9D9'});
                $('#list-view-label').css({'background-color': 'white'});
            })
            $('#grid-view').click();
            $('#list-view').on('click', function() {
                $('#list-view-label').css({'background-color': '#D9D9D9'});
                $('#grid-view-label').css({'background-color': 'white'});
            })
            $('#country-dropdown').on('change', function() {
                console.log('yes');
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
        var countries = [];
        var cities = [];
        var themes = [];
        var skills = [];
        var search = "";
        $(document).ready(function(Event) {
            $("#clear_all").hide();
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
                }else{
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
            }),
            // getAjax();
            // $("input[id^='mission_like_input_']").on('change', function() {
            //     if($this.val()=='1'){
            //         $("button[id^='mission_like_btn_']").html('<i class="fas fa-heart fs-4"></i>');
            //     }
            // }),
            $('#refresh-apply').on('click', function() {
                $('#search_input').val('');
                $('#filter-clear').click();
                $('#filter-apply').click();
            }),
            $('#grid-view').on('click', function() {
                $('#gridViewContent').show();
                $('#listViewContent').hide();
            }),
            $('#list-view').on('click', function() {
                $('#gridViewContent').hide();
                $('#listViewContent').show();
            }),
            $("#filter-apply").on('click',function() {
                search = $("#search_input").val();
                $("#search_f_id").val(search);
                $('#submit_f_id').click();
            }),
            $("#country-dropdown").on('change', function(e) {
                    //e.preventDefault();
                    $("#clear_all").show();
                    let country_id = $('#country-dropdown').val();
                    let country = $('#country-dropdown option:selected').html();
                    htmlstr = ""
                    htmlstr += '<div class="d-inline-flex border px-2" style="border-radius: 23px">';
                    htmlstr += '<span class="badge fs-5" style="color: black; font-weight: lighter;">' +
                        country + '</span>';
                    htmlstr += '<button type="button" class="filter-item btn" style="padding: 0%;">'
                    htmlstr += '<span aria-hidden="true">&times;</span>'
                    htmlstr += '</button></div>'
                    $('#badges').append(
                        htmlstr
                    );
                    countries.push(country_id);
                    $("#country_f_id").val(countries);
                }),
                $("#city-dropdown").on('change', function() {
                    $("#clear_all").show();
                    let city_id = $('#city-dropdown').val();
                    let city = $('#city-dropdown option:selected').html();
                    htmlstr = ""
                    htmlstr += '<div class="d-inline-flex border px-2" style="border-radius: 23px">';
                    htmlstr += '<span class="badge fs-5" style="color: black; font-weight: lighter;">' +
                        city + '</span>';
                    htmlstr += '<button type="button" class="close btn " style="padding: 0%;">'
                    htmlstr += '<span aria-hidden="true">&times;</span>'
                    htmlstr += '</button></div>'
                    $('#badges').append(
                        htmlstr
                    );
                    cities.push(city_id);
                    $('#city_f_id').val(cities);
                }),
                $("#theme-dropdown").on('change', function() {
                    $("#clear_all").show();
                    let theme_id = $('#theme-dropdown').val();
                    let theme = $('#theme-dropdown option:selected').html();
                    htmlstr = ""
                    htmlstr += '<div class="d-inline-flex border px-2" style="border-radius: 23px">';
                    htmlstr += '<span class="badge fs-5" style="color: black; font-weight: lighter;">' +
                        theme + '</span>';
                    htmlstr += '<button type="button" class="close btn " style="padding: 0%;">'
                    htmlstr += '<span aria-hidden="true">&times;</span>'
                    htmlstr += '</button></div>'
                    $('#badges').append(
                        htmlstr
                    );
                    themes.push(theme_id);
                    $("#theme_f_id").val(themes);
                }),
                $("#skill-dropdown").on('change', function() {
                    $("#clear_all").show();
                    let skill_id = $('#skill-dropdown').val();
                    let skill = $('#skill-dropdown option:selected').html();
                    htmlstr = ""
                    htmlstr += '<div class="d-inline-flex border px-2" style="border-radius: 23px">';
                    htmlstr += '<span class="badge fs-5" style="color: black; font-weight: lighter;">' +
                        skill + '</span>';
                    htmlstr += '<button type="button" class="close btn" style="padding: 0%;">'
                    htmlstr += '<span aria-hidden="true">&times;</span>'
                    htmlstr += '</button></div>'
                    $('#badges').append(
                        htmlstr
                    );
                    skills.push(skill_id);
                    $("#skill_f_id").val(skills);
                }),
                $('#filter-clear').on('click', function() {
                    $("#clear_all").hide();
                    $('#badges').children().remove();
                    countries = [];
                    cities = [];
                    themes = [];
                    skills = [];
                    $('#country_f_id').val(countries);
                    $('#city_f_id').val(cities);
                    $('#themes_f_id').val(themes);
                    $('#skills_f_id').val(skills);

                })
        });
    </script>
@endsection
