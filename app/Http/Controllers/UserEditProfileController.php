<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\CmsPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserEditProfileController extends Controller
{

/**
 * @param Request $request
 * @param User $user
 *
 * @return View
 */
public function editProfile(Request $request, User  $user): View
    {
        $countries = Country::get(['name', 'country_id']);
        $cities = City::where("country_id", $user->country_id)->get();

        $skills = Skill::get(['skill_id', 'skill_name']);
        $selected_skills = UserSkill::join('skills', 'user_skills.skill_id', '=', 'skills.skill_id')
            ->where('user_skills.user_id', $user->user_id)
            ->select('skills.skill_id', 'skills.skill_name')
            ->get();

        $policies = CmsPage::orderBy('cms_page_id', 'asc')->get();
        return view('usereditprofile', compact('user', 'countries', 'cities', 'skills', 'selected_skills','policies'));
    }



    /**
     * @param UpdateUserProfileRequest $request
     *
     * @return RedirectResponse
     */
    public function updateProfile(UpdateUserProfileRequest $request):RedirectResponse
    {
        $user = Auth::user();
        $user_id = $user->user_id;

        $u1 = User::find($user_id);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $avatar->getClientOriginalName(); // get original file name
            $avatar->storeAs('public/avatars', $filename); // store the file with original name
            $u1->avatar = 'storage/avatars/' . $filename;
        }

        $u1->fill($request->post());
        $u1->save();


        return redirect()->route('landing.index')->with('success', 'Profile updated successfully!');
    }


    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::find($request->user_id);
                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('The old password is incorrect.');
                    }
                }
            ],
            'password' => 'required|string|min:8|different:old_password',
            'confirm_password' => 'required|same:password'
        ]);
        $user_id = $request->user_id;
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateSkills(Request $request): JsonResponse
    {
        $user_id = $request->input('user_id');
        $existing_skills = UserSkill::where('user_id', $user_id)->pluck('skill_id')->toArray();
        if(isset($request->selected_skills)){
            $selected_skills = $request->input('selected_skills');
            $skills_to_delete = array_diff($existing_skills, $selected_skills);
            $skills_to_add = array_diff($selected_skills, $existing_skills);

            foreach ($skills_to_add as $skill_id) {
                $user_skill = new UserSkill;
                $user_skill->user_id = $user_id;
                $user_skill->skill_id = $skill_id;
                $user_skill->save();
            }
        } else {
            $skills_to_delete = $existing_skills;
        }
        UserSkill::where('user_id', $user_id)->whereIn('skill_id', $skills_to_delete)->delete();
        return response()->json(['success' => true]);
    }


    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('login');
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function contactus(Request $request): void
    {
        $request->validate([
            'user_id' => 'required',
            'subject' => 'required|max:255',
            'message' => 'required|max:40000',
        ]);

        $contactUs = new ContactUs;
        $contactUs->user_id = $request->user_id;
        $contactUs->subject = $request->subject;
        $contactUs->message = $request->message;
        $contactUs->save();
    }
}
