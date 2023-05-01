<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = $this->search();
        $pagination = $data->links()->render();
        if($data instanceof LengthAwarePaginator){
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }
        //$data = User::orderBy('user_id','desc')->paginate(10);
        return view('admin.user.index', compact('data','pagination')); // Create view by name missiontheme/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['countries'] = Country::get(['name', 'country_id']);
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //dd($request);
        $password = $request['password'];
        $request['password'] = bcrypt($password);
        User::create($request->post());
        return redirect()->route('user.index')->with('success', 'New User have been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user,$id)
    {
        $user->find('$id');
        return view('admin.user.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
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
     */
    public function update(UpdateUserRequest $request,$id) : RedirectResponse
    {
        $user = new User;
        $password = $request['password'];
        $request['password'] = bcrypt($password);
        $user->find($id)
             ->fill($request->post())
             ->save();
        return redirect()->route('user.index')
                         ->with('success','Field Have been successfully Submitted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $user = new User;
        $user->find($id)
             ->delete();
        return back()->with('success','Successfully Deleted');
    }

    public function search(){
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
