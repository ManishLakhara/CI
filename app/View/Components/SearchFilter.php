<?php

namespace App\View\Components;

use App\Models\City;
use App\Models\Country;
use App\Models\MissionSkill;
use App\Models\MissionTheme;
use App\Models\Skill;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchFilter extends Component
{
    public $data;
    public $countries;
    public $cities;
    public $themes;
    public $skills;

    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = $this->data;
        $countrys = $data->pluck('country_id')->toArray();
        $country_ids = array_unique($countrys);
        $this->countries = Country::whereIn('country_id',$country_ids)
                            ->get(['country_id','name']);
        $themes = $data->pluck('theme_id')->toArray();
        $theme_ids = array_unique($themes);
        $this->themes = MissionTheme::whereIn('mission_theme_id',$theme_ids)
                                ->get(['mission_theme_id','title']);
        $skills = MissionSkill::all(['skill_id'])->pluck('skill_id')->toArray();
        $skill_ids = array_unique($skills);
        $this->skills = Skill::whereIn('skill_id',$skill_ids)->get(['skill_id','skill_name']);

        $citys = $data->pluck('city_id')->toArray();
        $city_ids = array_unique($citys);
        $this->cities = City::whereIn('city_id',$city_ids)->get(['city_id','name']);

        return view('components.search-filter');
    }
}
