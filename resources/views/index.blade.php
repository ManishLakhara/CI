@extends('layouts.app')
@section('title')
Landing Mission Page
@endsection
@section('content')
<?php
    $user_id = Auth::user()->user_id;

?>
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
      {{ session('success') }}
  </div>
@endif
        @include('components.search-filter')
    </div>
    <div class="container py-4">
        <div class="d-flex">
            <div id="badges">
            </div>
            <div id="clear_all" style="display: none;">
                <button name="clear" class="btn close" id="filter-clear"> clear All</button>
            </div>
        </div>
    </div>
@if($count!=0)
<div class="container-fluid">
    <div class="container py-3 text-center" id="all-mission">
        <div class="row justify-content-between">
            <div class="col-md-6 col-12">
                <h4 class="fs-4 text-start"> <span class="light-theme-color text-center">Explore</span> <span class="theme-color" id="noOfMission">{{$count}}
                    </span> Mission </h4>
            </div>
            <div class=" col-md-6 d-flex justify-content-md-end justify-content-between ">
                <div class="input-group px-2" style="width: 200px ">
                    <select id="selectsort" class="custom-select w-100 border-1 text-muted">
                        <option disabled selected>Sort by</option>
                        <option value="1" @if(request()->input('sort')=='1') selected @endif>Newest</option>
                        <option value="2" @if(request()->input('sort')=='2') selected @endif>Oldest</option>
                        <option value="3" @if(request()->input('sort')=='3') selected @endif>Lowest available seats</option>
                        <option value="4" @if(request()->input('sort')=='4') selected @endif>Highest available seats</option>
                        <option value="5" @if(request()->input('sort')=='5') selected @endif>My favourites</option>
                        <option value="6" @if(request()->input('sort')=='6') selected @endif>Registration deadline</option>
                    </select>
                </div>
                <div class='d-flex px-3 justify-content-center align-items-center'>

                    <input type="radio" class="btn-check px-1" name="view" value='0' checked id="grid-view">
                    <label  id="grid-view-label" class="p-1 rounded-circle" for="grid-view"><img style="width: 30px;height: 30px" src={{ asset('Images/grid.png') }}
                        alt="gridview" ></label>
                    <input type="radio" class="btn-check px-1" name="view" id="list-view">
                    <label id="list-view-label" class="p-2 rounded-circle" value='1' for="list-view"><img
                        style="width:22px;width:22px" src={{ asset('Images/list.png') }} alt="list"></label>
                </div>
            </div>
        </div>
        <div  id="this_views" style="#0000000F">
            @include('components.gridListView')
        </div>
    </div>

</div>

@else
    @include('components.NoMissionFound')
@endif
    @push('script')

        <script>
            var countries = [];
        var cities = [];
        var themes = [];
        var skills = [];
        var sort = 0;
        var search = "";
        var view = 0;
        var page = 1;
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
        function getNextFilter(page){
            $.ajax({
                url: "{{url('index-filter')}}"+"?page="+page+"&s="+search+"&countries="+countries+"&cities="+cities+"&themes="+themes+"&skills="+skills+"&sort="+sort+"&view="+view,
                type: "get",
                success: function(result){
                    $('#this_views').html(result);
                    selectProperView();
                    runJquery();
                }
            })
        }
        function selectProperView(){
            $('#noOfMission').text($('#noOfMission2').val());
            if(view==1){
                        $('#list-view').click();
                    }else{
                        $('#grid-view').click();
                    }
        }
        function getCity(){
            $('#city_drop_down_menu').prop('disabled', false);
            $.ajax({
                url: "{{url('index/find-city')}}",
                type: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    countries: countries,
                    s: search,
                },
                success: function(result){
                    $('#city_dropper').html(result);
                    fillCityOptions();
                    filterReloadJQueryCity();
                }
            });
        }
        function fillCityOptions(){
            if(cities.length!=0){
                for(i=0;i<cities.length;i++){
                    $('#city_option_'+cities[i]).prop('checked', true);
                }
            }
        }
        function fillThemeOptions(){
            if(themes.length!=0){
                for(i=0;i<themes.length;i++){
                    $('#mission_theme_option_'+themes[i]).prop('checked', true);
                }
            }
        }
        function fillSkillOptions(){
            if(skills.length!=0){
                for(i=0;i<skills.length;i++){
                    $('#skill_option_'+skills[i]).prop('checked', true);
                }
            }
        }
        function getTheme(){
            $('#theme_drop_down_menu').prop('disabled', false);
            $.ajax({
                url: "{{url('index/find-theme')}}",
                type: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    countries: countries,
                    s: search,
                    cities: cities,
                },
                success: function(result){
                    $('#theme_dropper').html(result);
                    fillThemeOptions();
                    filterReloadJQueryTheme();
                }
            })
        }
        function getSkill(){
            $('#skill_drop_down_menu').prop('disabled', false);
            $.ajax({
                url: "{{url('index/find-skill')}}",
                type: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    countries: countries,
                    s: search,
                    cities: cities,
                    themes: themes,
                },
                success: function(result){
                    $('#skill_dropper').html(result);
                    fillSkillOptions();
                    filterReloadJQuerySkill();
                }
            })
        }
        function filterReloadJQueryCity(){
            $('input[id^=city_option_]').on('change',function(){
                let city_id = this.id.split('_')[2];
                let city_name = $('#city_label_'+city_id).text();
                if(this.checked){
                    getBadge(city_id,city_name,'city');
                    badgeRunJQueryCity(city_id);
                    cities = [...cities,city_id];
                }
                else{
                    removeBadge(city_id, 'city');
                    cities = cities.filter(item => item != city_id);
                }
                if(cities.length==0){
                    $('[id^="close_mission_button_"]').click();
                    $('#theme_drop_down_menu').prop('disabled', true);
                }
                $('#city_f_id').val(cities);
                getNextFilter(1);
                getTheme();
            });
        }
        function filterReloadJQueryTheme(){
            $('input[id^=mission_theme_option_]').on('change', function(){
                let mission_theme_id = this.id.split('_')[3];
                let title = $('#theme_label_'+mission_theme_id).text();
                if(this.checked){
                    getBadge(mission_theme_id,title,'mission');
                    badgeRunJQueryTheme(mission_theme_id);
                    themes = [...themes, mission_theme_id];
                }
                else{
                    removeBadge(mission_theme_id,'mission');
                    themes = themes.filter(item => item != mission_theme_id);
                }
                $('#theme_f_id').val(themes);
                if(themes.length==0){
                    $('[id^="close_skill_button_"]').click();
                    $('#skill_drop_down_menu').prop('disabled', true);
                }
                getNextFilter(1);
                getSkill();
            });
        }
        function filterReloadJQuerySkill(){
            $('input[id^=skill_option_]').on('change', function(){
                let skill_id = this.id.split('_')[2];
                let skill_name = $('#skill_label_'+skill_id).text();
                if(this.checked){
                    getBadge(skill_id, skill_name,'skill');
                    badgeRunJQuerySkill(skill_id);
                    skills = [...skills,skill_id];
                }
                else{
                    removeBadge(skill_id,'skill');
                    skills = skills.filter(item => item != skill_id);
                }
                $('#skill_f_id').val(skills);
                getNextFilter(1);
            })
        }
        function runJquery(){
            $("button[class^='mission_like_btn_']").on('click', function() {
                // var mission_id = this.id.split("_")[3];
                // var user_id = this.id.split("_")[4];
                var mission_id = $(this).data('mission_id');
                var user_id = $(this).data('user_id');
                if($('.mission_like_input_'+mission_id+'_'+user_id).val()=='0'){
                    $.ajax({
                        url: "{{url('api/add-favourite')}}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            mission_id: mission_id,
                            user_id: user_id,
                        },
                        success: function(data) {
                            $('.mission_like_input_'+mission_id+'_'+user_id).val(data);
                            $("button[class^='mission_like_btn_"+mission_id+"_"+user_id+"']").html('<i class="fas fa-heart fs-4"></i>');
                        }
                    });
                }else{
                    let fav = $('.mission_like_input_'+mission_id+'_'+user_id).val()
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
                            $('.mission_like_input_'+mission_id+'_'+user_id).val('0');
                            $("button[class^='mission_like_btn_"+mission_id+"_"+user_id+"']").html('<i class="fa-regular fa-heart fs-4"></i>');
                        }
                    });
                }
            });
            $('input[class="invite"]').on('click', function() {
                if (this.checked) {
                    var mission_id = $(this).data('mission_id');
                    var from_user_id = $(this).data('from_user_id');
                    var to_user_id = $(this).data('to_user_id');
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
            });
            //this is detail view page
            $('[id^="click-to-details_"]').click(function(){
                $(location).attr('href',"{{url('mission-page/')}}"+'/'+$(this).data('mission_id'));
            });
            $('button[id^="mission_application_btn_"]').on('click',function(){
                mission_id=$(this).data('mission_id');
                $.ajax({
                    url: "{{url('api/new-mission-application')}}",
                    type: "POST",
                    data: {
                        user_id: $(this).data('user_id'),
                        mission_id: $(this).data('mission_id'),
                        approval_status: 'PENDING',
                    },
                    success: function(result){
                        $('#applied_badge_'+mission_id).css('display','block');
                    }
                })
                $(this).hide();
                $('.mission_detail_btn_'+$(this).data('mission_id')).css('display','block');
            });
            $('button[id^="mission_application_l_btn_"]').on('click',function(){
                mission_id=$(this).data('mission_id');
                $.ajax({
                    url: "{{url('api/new-mission-application')}}",
                    type: "POST",
                    data: {
                        user_id: $(this).data('user_id'),
                        mission_id: $(this).data('mission_id'),
                        approval_status: 'PENDING',
                    },
                    success: function(result){
                        $('#applied_badge_'+mission_id).css('display','block');
                    }
                })
                $(this).hide();
                $('#mission_detail_l_btn_'+$(this).data('mission_id')).show();
                $('#applied_l_badge_'+$(this).data('mission_id')).show()
            });
            $(document).one('click','.pagination a', function(event){
                event.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                getNextFilter(page);
            });
        }
        function badgeRunJQueryCountry(id){
            $('[id="close_country_button_:id"]'.replace(':id',id)).click(function(){
                let id = this.id.split('_')[3];
                $('#country_option_'+id).prop('checked', false);
                countries = countries.filter(item => item != id);
                removeBadge(id,'country');
                if(countries.length==0){
                    $('#clear_all').hide();
                    $('[id^="close_city_button_"]').click();
                    $('#city_drop_down_menu').prop('disabled', true);
                    $('#clear-filter').hide();
                }
                getNextFilter(1);
            })
        }
        function badgeRunJQueryCity(id){
            $('[id="close_city_button_:id"]'.replace(':id',id)).click(function(){
                $('#city_option_'+id).prop('checked', false);
                removeBadge(id,'city');
                cities = cities.filter(item => item != id);
                if(cities.length==0){
                    $('[id^="close_mission_button_"]').click();
                    $('#theme_drop_down_menu').prop('disabled', true);
                }
                getNextFilter(1);
            })
        }
        function badgeRunJQueryTheme(id){
            $('[id="close_mission_button_:id"]'.replace(':id',id)).click(function(){
                $('#mission_theme_option_'+id).prop('checked', false);
                removeBadge(id,'mission');
                themes = themes.filter(item => item != id);
                if(themes.length==0){
                    $('[id^="close_skill_button_"]').click();
                    $('#skill_drop_down_menu').prop('disabled', true);
                }
                getNextFilter(1);
            })
        }
        function badgeRunJQuerySkill(id){
            $('[id="close_skill_button_:id"]'.replace(':id',id)).click(function(){
                $('#skill_option_'+id).prop('checked', false);
                removeBadge(id,'skill');
                skills = skills.filter(item => item != id);
                getNextFilter(1);
            });
        }
        $(document).ready(function(Event) {
            $('#home_page').hide();
            runJquery();
            $('#search_input').on('change',function(){
                search=$(this).val();
                getNextFilter(1);
            })
            $('.my-filter-btn').on('click',function(){
                $('#See_filters').toggle('hidden');
            })
            $(window).on('resize', function() {
                var windowWidth = $(window).width();
                if(windowWidth <= 767){
                    $('#See_filters').css('display','none');
                    $('#all-mission').addClass('container-fluid');
                    $('#all-mission').removeClass('container');
                }
                if(windowWidth >= 768){
                    $('#See_filters').show();
                    $('#all-mission').addClass('container');
                    $('#all-mission').removeClass('container-fluid');
                }
            })
            $('#search-mission').on('submit', function(event){
                event.preventDefault();
                search = $('#search_input').val();
                $.ajax({
                    url: "{{route('landing.filterApply')}}",
                    type: "get",
                    data: {
                        s: $('#search_input').val(),
                    },
                    success: function(result){
                        $('#this_views').html(result);
                        runJquery();
                        selectProperView();
                    }
                })
            })
            $('#selectsort').on('change', function() {
                sort=$('#selectsort').val();
                $('#sort').val(sort);
                getNextFilter(1);

            }),
            $('#grid-view').on('click', function() {
                view=0;
                $('#gridViewContent').show();
                $('#listViewContent').hide();
            }),
            $('#list-view').on('click', function() {
                view=1;
                $('#gridViewContent').hide();
                $('#listViewContent').show();
            }),
            $("#filter-apply").on('click',function() {
                search = $("#search_input").val();
                $("#search_f_id").val(search);
                $('#submit_f_id').click();
            }),
            // this is country dropdown
            $('input[id^=country_option_]').on('change', function(){
                let country_id = this.id.split('_')[2];
                let country_name = $('#country_label_'+country_id).text();
                if(this.checked){
                    getBadge(country_id,country_name,'country');
                    countries = [...countries,country_id];
                }
                else{
                    removeBadge(country_id, 'country');
                    countries = countries.filter(item => item != country_id);
                    if(countries.length==0){
                        $('#clear_all').hide();
                        $('[id^="close_city_button_"]').click();
                        $('#city_drop_down_menu').prop('disabled', true);


                        $('#clear-filter').hide();
                    }
                }
                $('#country_f_id').val(countries);
                getNextFilter(1);
                badgeRunJQueryCountry(country_id);
                getCity();
            }),
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
                $("#clear_all").hide();
                $('#city_drop_down_menu').prop('disabled', true);
                $('#theme_drop_down_menu').prop('disabled', true);
                $('#skill_drop_down_menu').prop('disabled', true);
                $('[id^=country_option_]').prop('checked', false);
                $('[id^=city_option_]').prop('checked', false);
                $('[id^=mission_theme_option_]').prop('checked', false);
                $('[id^=skill_option_]').prop('checked', false);
                getNextFilter(1);
            })
        });

        </script>
    @endpush
@endsection
