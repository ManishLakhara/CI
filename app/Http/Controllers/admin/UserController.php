<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $data = User::where([
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('first_name', 'LIKE', '%' . $s . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $s . '%')
                        ->get()
                        ->orderBy('user_id','DESC');
                }
            }]
        ])->paginate(10)
            ->appends(['s' => $request->s]);


        //$data = User::orderBy('user_id','desc')->paginate(10);
        return view('admin.user.index', compact('data')); // Create view by name missiontheme/index.blade.php

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
        User::create($request->post());
        return redirect()->route('user.index')->with('success', 'New User have been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) : Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) : RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        //
    }
}