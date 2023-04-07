@extends('layouts.app')
@section('content')
<?php
    $user_id = Auth::user()->user_id;

?>
        @include('components.search-filter');

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
                    </span> Mission </h4>
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
        <div  id="this_views">
            @include('components.gridListView')
        </div>
    </div>
@else
    @include('components.NoMissionFound')
@endif
    <script>
        var countries = [];
        var cities = [];
        var themes = [];
        var skills = [];
        var sort = 0;
        var search = "";
        var view = 0;
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
                    badgeRunJQuery();
        }
        function removeBadge(id,type){
            $('#close_'+type+'_parent_'+id).remove();
            badgeRunJQuery();
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
        function getNextFilter(page){
            $.ajax({
                url: "{{url('index-filter')}}"+"?page="+page+"&s="+search+"&countries="+countries+"&cities="+cities+"&themes="+themes+"&skills="+skills+"&sort="+sort,
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
                    filterReloadJQueryCity();
                }
            });

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
                    cities.push(city_id);
                }
                else{
                    removeBadge(city_id, 'city');
                    cities.pop(city_id);
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
                    themes.push(mission_theme_id);
                }
                else{
                    removeBadge(mission_theme_id,'mission');
                    themes.pop(mission_theme_id);
                }
                $('#theme_f_id').val(themes);
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
                    skills.push(skill_id);
                }
                else{
                    removeBadge(skill_id,'skill');
                    skills.pop(skill_id);
                }
                $('#skill_f_id').val(skills);
                getNextFilter(1);
            })
        }
        function runJquery(){
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
            });
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
                $('#mission_detail_btn_'+$(this).data('mission_id')).css('display','block');
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
            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getNextFilter(page);
            });
        }
        function badgeRunJQuery(){
            $('[id^="close_skill_button_"]').click(function(){
                let id = this.id.split('_')[3];
                $('#skill_option_'+id).prop('checked', false);
                skills.pop(id);
                removeBadge(id,'skill');
                getNextFilter(1);
                badgeRunJQuery();
            });
            $('[id^="close_theme_button_"]').click(function(){
                let id = this.id.split('_')[3];
                $('#theme_option_'+id).prop('checked', false);
                themes.pop(id);
                removeBadge(id,'theme');
                if(themes.length==0){
                    $('[id^="close_skill_button_"]').click();
                    $('#skill_drop_down_menu').prop('disabled', true);
                }
                getNextFilter(1);
                badgeRunJQuery();
            })
            $('[id^="close_city_button_"]').click(function(){
                let id = this.id.split('_')[3];
                $('#city_option_'+id).prop('checked', false);
                cities.pop(id);
                removeBadge(id,'city');
                if(cities.length==0){
                    $('[id^="close_theme_button_"]').click();
                    $('[id^="close_skill_button_"]').click();
                    $('#skill_drop_down_menu').prop('disabled', true);
                    $('#theme_drop_down_menu').prop('disabled', true);
                }
                getNextFilter(1);
                badgeRunJQuery();
            })
            $('[id^="close_country_button_"]').click(function(){
                let id = this.id.split('_')[3];
                $('#country_option_'+id).prop('checked', false);
                countries.pop(id);
                removeBadge(id,'country');
                if(countries.length==0){
                    $('[id^="close_city_button_"]').click();
                    $('[id^="close_theme_button_"]').click();
                    $('[id^="close_skill_button_"]').click();
                    $('#skill_drop_down_menu').prop('disabled', true);
                    $('#theme_drop_down_menu').prop('disabled', true);
                    $('#city_drop_down_menu').prop('disabled', true);
                }
                getNextFilter(1);
                badgeRunJQuery();
            })
        }
        $(document).ready(function(Event) {
            console.log('started');
            getPreviousValue();
            runJquery();
            $('#grid-view').on('click', function() {
                $('#grid-view-label').css({'background-color': '#D9D9D9'});
                $('#list-view-label').css({'background-color': 'white'});
            })
            $('#grid-view').click();
            $('#list-view').on('click', function() {
                $('#list-view-label').css({'background-color': '#D9D9D9'});
                $('#grid-view-label').css({'background-color': 'white'});
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
            // $('#refresh-apply').on('click', function() {
            //     $('#search_input').val('');
            //     $('#filter-clear').click();
            //     search = $("#search_input").val();
            // }),
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
                    countries.push(country_id);
                }
                else{
                    removeBadge(country_id, 'country');
                    countries.pop(country_id);
                }
                $('#country_f_id').val(countries);
                getNextFilter(1);
                getCity();
            }),
            // this is city dropdown
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
                getNextFilter(1);
                getTheme();
            }),
            // this is theme dropdown
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
                getNextFilter(1);
                getSkill();
            })
            // this is skill dropdown
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
                getNextFilter(1);
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
        $(document).on('click', '#country-dropdown', function (e) {
            e.stopPropagation();
        });

    </script>
@endsection
