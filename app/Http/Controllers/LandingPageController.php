<?php

namespace App\Http\Controllers;

    use App\Models\City;
    use App\Models\Country;
    use App\Models\Mission;
    use App\Models\MissionTheme;
    use App\Models\Skill;
    use App\Models\FavoriteMission;
    use App\Models\MissionSkill;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Support\Facades\Auth;
    use App\Models\CmsPage;
    use App\Query\CityFilter;
    use App\Query\CountryFilter;
    use App\Query\ThemeFilter;
    use Illuminate\Pipeline\Pipeline;

class LandingPageController extends Controller
{
    public function index(){
        $data = Mission::where('mission_id','!=',null);

        $count = $data->count();
        $countrys = $data->pluck('country_id')->toArray();
        $country_ids = array_unique($countrys);
        $countries = Country::whereIn('country_id',$country_ids)
                            ->get(['country_id','name']);
        $themes = $data->pluck('theme_id')->toArray();
        $theme_ids = array_unique($themes);
        $themes = MissionTheme::whereIn('mission_theme_id',$theme_ids)
                                ->get(['mission_theme_id','title']);
        $skills = MissionSkill::all(['skill_id'])->pluck('skill_id')->toArray();
        $skill_ids = array_unique($skills);
        $skills = Skill::whereIn('skill_id',$skill_ids)->get(['skill_id','skill_name']);

        $citys = $data->pluck('city_id')->toArray();
        $city_ids = array_unique($citys);
        $cities = City::whereIn('city_id',$city_ids)->get(['city_id','name']);

        $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);

        $users = User::where('user_id','!=',Auth::user()->user_id)
                       ->orderBy('user_id','asc')
                       ->get();
        $data = $data->orderBy('created_at','desc')->paginate(9);

        $pagination = $data->links()->render();
        if ($data instanceof LengthAwarePaginator) {
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }
        $policies = CmsPage::orderBy('cms_page_id', 'asc')->get();
        return view('index', compact('data','count','countries','cities','themes','skills','favorite','users','pagination','policies')); // Create view by name missiontheme/index.blade.php
    }

    public function filterApply(Request $request){
        if($request->ajax()){

            $user_id = Auth::user()->user_id;
            $datas = $this->search();

            $datas = app(Pipeline::class)
                        ->send($datas)
                        ->through([
                            CountryFilter::class,
                            CityFilter::class,
                            ThemeFilter::class,
                        ])
                        ->thenReturn();
            $datas = $this->sort($datas);
            $count = $datas->count();
            $data = $datas->paginate(9);
            $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);

            $users = User::where('user_id','!=',Auth::user()->user_id)
                        ->orderBy('user_id','asc')
                        ->get();
            $pagination = $data->links()->render();
            if ($data instanceof LengthAwarePaginator) {
                $pagination = $data->appends(request()->all())->links('pagination.default');
            }
            return view('components.gridListView', compact('count','data','favorite','users','user_id','pagination'));
        }
    }

    // public function findCountry(Request $request){
    //     if($request->ajax()){
    //         $datas = $this->search();

    //         $datas = app(Pipeline::class)
    //                     ->send($datas)
    //                     ->through([
    //                         CountryFilter::class,
    //                         CityFilter::class,
    //                         ThemeFilter::class,
    //                         SkillFilter::class,
    //                     ])
    //                     ->thenReturn();
    //         $countrys = $datas->pluck('country_id')->toArray();
    //         $country_ids = array_unique($countrys);
    //         $countries = Country::whereIn('country_id',$country_ids)->get(['country_id','name']);
    //         return view('components.country-dropper', compact('countries'));
    //     }
    // }

    public function findCity(Request $request){
        if($request->ajax()){
            $datas = $this->search();
            if($request->countries!=null){
                $datas = $datas->whereIn('country_id',$request->countries);
            }
            $citys = $datas->pluck('city_id')->toArray();
            $city_ids = array_unique($citys);
            $cities = City::whereIn('city_id',$city_ids)->get(['city_id','name']);
            return view('components.city-dropper', compact('cities'));
        }
    }

    public function findTheme(Request $request){
        if($request->ajax()){
            $datas = $this->search();
            if($request->countries!=null){
                $datas = $datas->whereIn('country_id',$request->countries);
            }
            if($request->cities!=null){
                $datas = $datas->whereIn('city_id', $request->cities);
            }
            $theme_ids = $datas->pluck('theme_id')->toArray();
            $theme_ids = array_unique($theme_ids);
            $themes = MissionTheme::whereIn('mission_theme_id',$theme_ids)->get(['mission_theme_id','title']);
            return view('components.theme-dropper', compact('themes'));
        }
    }

    public function findSkill(Request $request){
        if($request->ajax()){
            $datas = $this->search();
            if($request->countries!=null){
                $datas = $datas->whereIn('country_id',$request->countries);
            }
            if($request->cities!=null){
                $datas = $datas->whereIn('city_id', $request->cities);
            }
            if($request->themes){
                $datas = $datas->whereIn('theme_id', $request->themes)
                ->with('skill');
            }
            $skill_ids = [];
            $mission_ids = $datas->pluck('mission_id');
            $skill_ids = MissionSkill::whereIn('mission_id',$mission_ids)->pluck('skill_id')->toArray();
            $skill_ids = array_unique($skill_ids);
            $skills = Skill::whereIn('skill_id',$skill_ids)->get(['skill_name','skill_id']);
            return view('components.skill-dropper', compact('skills'));
        }
    }

    public function search(){
        $request = request();
        return Mission::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)){
                    $query->orWhere('title','LIKE','%'.$s.'%')
                        ->orWhere('mission_type', 'LIKE', '%'.$s.'%')
                        ->get();
                }
            }]
        ]);
    }

    public function sort($datas){

        if(isset(request()->sort)){
            switch(request()->sort){
                case '1': // Newest
                    $datas = $datas->orderBy('start_date','desc');
                    break;
                case '2': // Oldest
                    $datas = $datas->orderBy('start_date','asc');
                    break;
                case '3': // Lowest Availabel Seat
                    $datas = $datas->select('missions.*')
                                 ->join('time_missions','time_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('time_missions.total_seats', 'asc');

                    break;
                case '4': // Highest Availabel Seat
                    $datas = $datas->select('missions.*')
                                 ->Join('time_missions','time_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('time_missions.total_seats', 'desc');
                    break;
                case '5': // My Facovorites
                    $datas = $datas->select('missions.*')
                                 ->leftJoin('favorite_missions','favorite_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('favorite_missions.created_at', 'desc');
                    break;
                case '6': // Registration DeadLine
                    $datas = $datas->select('missions.*')
                                 ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('time_missions.registration_deadline', 'desc');
                    break;
            }
            return $datas;
        }
    }
}
