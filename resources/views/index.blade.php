@extends('layouts.app')
@section('content')
<?php
    $user_id = Auth::user()->user_id;

?>
    <div class="container-fluid border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex rounded">
                    <form action="{{route('landing.index')}}" method="POST" id="search-mission" style="margin: 0%; padding:0%;">
                        @csrf
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
                        <button class="btn border-start" type=submit id="filter-apply">
                            <img src="{{asset("Images/filter.png")}}" alt="">
                        </button>


                    <div class="border-start input-group h-100 px-2">
                        <div class="dropdown w-100">
                            <button class="btn btn-none text-secondary form-select" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="float-start ps-0 pe-5">
                                    Country
                                </span>
                            </button>
                            <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                              <div>
                                @foreach ($countries as $country)
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $country->country_id }}" id="country_option_{{ $country->country_id }}">
                                    <label class="form-check-label text-secondary" for="country_option_{{ $country->country_id }}" id="country_label_{{$country->country_id}}">
                                      {{ $country->name }}
                                    </label>
                                  </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-start input-group px-2" >
                        {{-- <select class="custom-select w-100 border-0 text-muted" name="city_id" id="city-dropdown">
                            <option disabled selected> City </option>
                        </select> --}}
                        <div class="dropdown w-100">
                            <button class="btn btn-none text-secondary form-select" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="float-start ps-0 pe-5">
                                    City
                                </span>
                            </button>
                            <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton" style="overflow: scroll; max-height: 500px; max-width: fit-content">
                              <div id="city_dropper">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-start input-group px-2">
                        <div class="dropdown w-100">
                            <button class="btn btn-none text-secondary form-select" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="float-start ps-0 pe-5">
                                    Theme
                                </span>
                            </button>
                            <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                              <div>
                                {{-- <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="selectAllskill">
                                  <label class="form-check-label text-secondary" for="selectAllCheckbox">
                                    Select All
                                  </label>
                                </div> --}}
                                @foreach ($themes as $theme)
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $theme->mission_theme_id }}" id="mission_theme_option_{{ $theme->mission_theme_id }}">
                                    <label class="form-check-label text-secondary" for="mission_theme_option_{{ $theme->mission_theme_id }}" id="theme_label_{{$theme->mission_theme_id}}">
                                      {{ $theme->title }}
                                    </label>
                                  </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-start border-end input-group px-2">
                        <div class="dropdown w-100">
                            <button class="btn btn-none text-secondary form-select" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="float-start ps-0 pe-5">
                                    Skill
                                </span>
                            </button>
                            <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                              <div>
                                {{-- <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="selectAllskill">
                                  <label class="form-check-label text-secondary" for="selectAllCheckbox">
                                    Select All
                                  </label>
                                </div> --}}
                                @foreach ($skills as $skill)
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $skill->skill_id }}" id="skill_option_{{ $skill->skill_id }}" name="options[]">
                                    <label class="form-check-label text-secondary" for="skill_option_{{ $skill->skill_id }}" id="skill_label_{{$skill->skill_id}}">{{ $skill->skill_name }}</label>
                                  </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <form id="form_f"  action="{{route('landing.index')}}" method="POST" style="display: none">
        @csrf
        <input  type="text" name="country_f" id="country_f_id" value="{{ request()->input('country_f') }}"/>
        <input  type="text" name="city_f" id="city_f_id" value="{{ request()->input('city_f') }}"/>
        <input type="text" name="s" id="search_f_id" value="{{ request()->input('s') }}"/>
        <input type="text" name="theme_f" id="theme_f_id" value="{{ request()->input('theme_f')}}" />
        <input type="text" multiple name="skill_f" id="skill_f_id" value="{{ request()->input('skill_f') }}"/>
        <input type="number" name="sort" id="sort" value="{{request()->input('sort')}}"/>
        <button class="btn" type="submit" id="submit_f_id"></button>
    </form>




    </div>
    <div class="container py-4">
        <div class="d-flex">
            <div id="badges">
            </div>
            <div id="clear_all" style="display: none;">
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
                    <select id="selectsort" class="custom-select w-100 border-1 text-muted">
                        <option disabled selected>Sort by</option>
                        <option value="1" @if(request()->input('sort')=='1') selected @endif>Newest</option>
                        <option value="2"@if(request()->input('sort')=='2') selected @endif>Oldest</option>
                        <option value="3"@if(request()->input('sort')=='3') selected @endif>Lowest available seats</option>
                        <option value="4"@if(request()->input('sort')=='4') selected @endif>Highest available seats</option>
                        <option value="5"@if(request()->input('sort')=='5') selected @endif>My favourites</option>
                        <option value="6" @if(request()->input('sort')=='6') selected @endif>Registration deadline</option>
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
         {{--gridViewContent--}}
            @include('components.gridView')
            {{--ListViewContent--}}
            @include('components.listView')
            @include('admin.layouts.pagination')
    </div>
@else
    <div class="d-flex justify-content-center">
        <span class="fs-3 font-weight-bold theme-color">
            No Mission Found
        </span>
    </div>
    <div class="d-flex pt-4 justify-content-center">
        <button class="btn btn-outline fs-4 apply-btn w-50">
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
        var sort = 0;
        var search = "";
        function getBadge(id,name,type){
            $("#clear_all").show()
                    htmlstr = ""
                    htmlstr += '<div id="close_'+type+'_parent_'+id+'" class="d-inline-flex border px-2" style="border-radius: 23px">';
                    htmlstr += '<span class="badge fs-5" style="color: black; font-weight: lighter;">' +
                        name + '</span>';
                    htmlstr += '<button type="button" class="close btn" style="padding: 0%;" id=close_'+type+'_button_'+id+'>'
                    htmlstr += '<span aria-hidden="true">&times;</span>'
                    htmlstr += '</button></div>'
                    $('#badges').append(
                        htmlstr
                    );
        }
        function removeBadge(id,type){
            $('#close_'+type+'_parent_'+id).remove();
        }
        function updateCityDropdown(country_id){
            $('#city_dropper').html('');
            $.ajax({
                url: "{{ url('api/fetch-city')}}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $.each(result.cities, function(key, value){
                        html = "";
                        // html += "<div class='form-check'>";
                        // html += "<input class='form-check-input' type='checkbox' value="+value.city_id+" id='city_option_"+value.city_id+"'>";
                        // html += "<label class='form-check-label text-secondary' for='city_option_"+value.city_id+"' id='city_label_"value.city_id"'>"+value.name+"</label>";
                        // html += "</div>";
                        $('#city_dropper').append("<div class='form-check'>"+
                            "<input class='form-check-input' type='checkbox' value="+value.city_id+" id='city_option_"+value.city_id+"'>"+
                            "<label class='form-check-label text-secondary' for='city_option_"+value.city_id+"' id='city_label_"+value.city_id+"'>"+value.name+"</label>"+
                            "</div>" );
                    });
                }
            });
            return;
        }
        function getPreviousValue(){
            skills = $('#skill_f_id').val().split(',');
            skills.forEach(skill => {
                if(skill!=""){
                    $('#skill_option_'+skill).prop('checked', true);
                    getBadge(skill,$('#skill_label_'+skill).text(),'skill');
                }
            });
            themes = $('#theme_f_id').val().split(',');
            themes.forEach(theme => {
                if(theme!=""){
                    $('#mission_theme_option_'+theme).prop('checked', true);
                    getBadge(theme,$('#theme_label_'+theme).text(),'mission');
                }
            });
            countries = $('#country_f_id').val().split(',');
            countries.forEach(country => {
                if(country!=""){
                    $('#country_option_'+country).prop('checked', true);
                    getBadge(country,$('#country_label_'+country).text(),'country');
                }
            });
            // cities = $('#city_f_id').val().split(',');
            // cities.forEach(city => {
            //     if(cities!=""){
            //         $('#city_option_'+city).prop('checked', true);
            //         getBadge(city,$('#city_label_'+city).text(),'city');
            //     }
            // });
        }
        $(document).ready(function(Event) {
            getPreviousValue();
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
                            alert("Invite Send",1000);
                        },
                    })
                }
            }),
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
            $('#selectsort').on('change', function() {
                sort=$('#selectsort').val();
                $('#sort').val(sort);
                $('#submit_f_id').click();
            }),
            // $('#refresh-apply').on('click', function() {
            //     $('#search_input').val('');
            //     $('#filter-clear').click();
            //     search = $("#search_input").val();
            // }),
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
            $('input[id^=country_option_]').on('change', function(){
                let country_id = this.id.split('_')[2];
                let country_name = $('#country_label_'+country_id).text();
                if(this.checked){
                    getBadge(country_id,country_name,'country');
                    countries.push(country_id);
                }
                else{
                    removeBadge(country_id, 'country');
                    countries.pop(country_id);
                }
                $('#country_f_id').val(countries);
                updateCityDropdown(country_id);
                $("#filter-apply").click();
            })
            $('input[id^=city_option_]').on('change',function(){
                let city_id = this.id.split('_')[2];
                let city_name = $('#city_label_'+city_id).text();
                if(this.checked){
                    getBadge(city_id,city_name,'city');
                    cities.push(city_id);
                }
                else{
                    removeBadge(city_id, 'city');
                    cities.pop(city_id);
                }
                $('#city_f_id').val(cities);
                $("#filter-apply").click();
            })
                $('input[id^=mission_theme_option_]').on('change', function(){
                    let mission_theme_id = this.id.split('_')[3];
                    let title = $('#theme_label_'+mission_theme_id).text();
                    if(this.checked){
                        getBadge(mission_theme_id,title,'mission');
                        themes.push(mission_theme_id);
                    }
                    else{
                        removeBadge(mission_theme_id,'mission');
                        themes.pop(mission_theme_id);
                    }
                    $('#theme_f_id').val(themes);
                    $("#filter-apply").click();
                })
                $('input[id^=skill_option_]').on('change', function(){
                    let skill_id = this.id.split('_')[2];
                    let skill_name = $('#skill_label_'+skill_id).text();
                    if(this.checked){
                        getBadge(skill_id, skill_name,'skill');
                        skills.push(skill_id);
                    }
                    else{
                        removeBadge(skill_id,'skill');
                        skills.pop(skill_id);
                    }
                    $('#skill_f_id').val(skills);
                    $("#filter-apply").click();
                })
                $('#clear_all').on('click', function() {

                    $('#badges').children().remove();
                    countries = [];
                    cities = [];
                    themes = [];
                    skills = [];
                    search = '';
                    $('#country_f_id').val(countries);
                    $('#city_f_id').val(cities);
                    $('#themes_f_id').val(themes);
                    $('#skills_f_id').val(skills);
                    $('#search_f_id').val(search);
                    $('#filter-apply').click();
                    $("#clear_all").hide();
                    // $('#refresh-apply').click();
                })
        });
        $(document).on('click', '#country-dropdown', function (e) {
            e.stopPropagation();
        });

    </script>
@endsection
