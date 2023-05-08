<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class UserController extends AdminBaseController
{
    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        $data['countries'] = Country::get(['name', 'country_id']);
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $password = $request['password'];
        $request['password'] = bcrypt($password);
        User::create($request->post());
        return redirect()->route('user.index')->with('success', 'New User have been created');
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     *
     * @return View
     */
    public function edit(User $user): View
    {
        if($user->city_id!=null){
            $cities = $user->country->city;
            $countries = Country::get(['name', 'country_id']);
            return view('admin.user.edit',compact('user','countries','cities'));
        }
        else{
            $countries = Country::get(['name', 'country_id']);
            return view('admin.user.edit',compact('user','countries'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request,User $user) : RedirectResponse
    {
        $password = $request['password'];
        $request['password'] = bcrypt($password);
        $user->fill($request->post())
             ->save();
        return redirect()->route('user.index')
                         ->with('success','Field Have been successfully Submitted');
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return back()->with('success','Successfully Deleted');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator{
        $request = request();
        return  User::where([
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('first_name', 'LIKE', '%' . $s . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $s . '%')
                    ->orWhere('email', 'LIKE', '%' . $s . '%')
                    ->orWhere('employee_id', 'LIKE', '%' . $s . '%')
                    ->orWhere('department', 'LIKE', '%' . $s . '%')
                    ->get();
                }
            }]
        ])->paginate(10);
    }
}
