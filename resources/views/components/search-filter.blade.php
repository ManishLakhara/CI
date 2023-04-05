<div class="container-fluid border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex rounded">
                <form id="search-mission" style="margin: 0%; padding:0%;">
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
                    {{-- <button class="btn border-start" type=submit id="filter-apply">
                        <img src="{{asset("Images/filter.png")}}" alt="">
                    </button> --}}
                <div class="border input-group h-100 px-2">
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
                <div class="border input-group px-2" >
                    {{-- <select class="custom-select w-100 border-0 text-muted" name="city_id" id="city-dropdown">
                        <option disabled selected> City </option>
                    </select> --}}
                    <div class="dropdown w-100">
                        <button disabled class="btn btn-none text-secondary form-select" type="button" id="city_drop_down_menu" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="float-start ps-0 pe-5">
                                City
                            </span>
                        </button>
                        <div class="dropdown-menu px-2" aria-labelledby="city_drop_down_menu" style="overflow: scroll; max-height: 500px; max-width: fit-content">
                          <div id="city_dropper">
                            @foreach ($cities as $city)
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $city->city_id }}" id="city_option_{{ $city->city_id }}">
                                <label class="form-check-label text-secondary" for="city_option_{{ $city->city_id }}" id="city_label_{{$city->city_id}}">
                                  {{ $city->name }}
                                </label>
                              </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border input-group px-2">
                    <div class="dropdown w-100">
                        <button class="btn btn-none text-secondary form-select" disabled type="button" id="theme_drop_down_menu" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="float-start ps-0 pe-5">
                                Theme
                            </span>
                        </button>
                        <div class="dropdown-menu px-2" aria-labelledby="theme_drop_down_menu">
                          <div id="theme_dropper">
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
                <div class="border border-end input-group px-2">
                    <div class="dropdown w-100">
                        <button class="btn btn-none text-secondary form-select" type="button" disabled id="skill_drop_down_menu" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="float-start ps-0 pe-5">
                                Skill
                            </span>
                        </button>
                        <div class="dropdown-menu px-2" aria-labelledby="skill_drop_down_menu">
                          <div id="skill_dropper">
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
