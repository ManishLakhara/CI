@extends('admin.app')

@section('title')
    User
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-pen-to-square text-black"></i>
            </div>
            {{-- {{dd(asset('../'))}} --}}
            <div class="card-body">
                <div class="container">
                    <form action="{{route('user.update',$user->user_id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row py-4"> 
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer1.png" type="radio" name="avatar" id="avatar1" @if($user->avatar=="Images/volunteer1.png") checked @endif>
                                <label class="form-check-label" for="avatar1">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset('Images/volunteer1.png')}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer2.png" type="radio" name="avatar" id="avatar2" @if($user->avatar=="Images/volunteer2.png") checked @endif>
                                <label class="form-check-label" for="avatar2">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer2.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer3.png" type="radio" name="avatar" id="avatar3" @if($user->avatar=="Images/volunteer3.png") checked @endif>
                                <label class="form-check-label" for="avatar3">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer3.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer4.png" type="radio" name="avatar" id="avatar4" @if($user->avatar=="Images/volunteer4.png") checked @endif>
                                <label class="form-check-label" for="avatar4">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer4.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer5.png" type="radio" name="avatar" id="avatar5" @if($user->avatar=="Images/volunteer5.png") checked @endif>
                                <label class="form-check-label" for="avatar5">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer5.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer6.png" type="radio" name="avatar" id="avatar6" @if($user->avatar=="Images/volunteer6.png") checked @endif>
                                <label class="form-check-label" for="avatar6">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer6.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer7.png" type="radio" name="avatar" id="avatar7" @if($user->avatar=="Images/volunteer7.png") checked @endif>
                                <label class="form-check-label" for="avatar7">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer7.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer8.png" type="radio" name="avatar" id="avatar8" @if($user->avatar=="Images/volunteer8.png") checked @endif>
                                <label class="form-check-label" for="avatar8">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer8.png")}} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Images/volunteer9.png" type="radio" name="avatar" id="avatar9" @if($user->avatar=="Images/volunteer9.png") checked @endif>
                                <label class="form-check-label" for="avatar9">
                                    <img class="rounded-circle" height="100px" width="100px" src={{asset("Images/volunteer9.png")}} alt="Alt Images">
                                </label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value={{$user->first_name}} id="">
                               
                                @error('first_name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value={{$user->last_name}} id="">
                                @error('last_name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value={{$user->email}} id="">
                                @error('email')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="tel" name="phone_number" class="form-control" value={{$user->phone_number}} id="">
                                @error('phone_number')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control"  id="">
                                @error('password')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password">Confirm password</label>
                                <input type="password" name="confirm_password" class="form-control" id="">
                                @error('confirm_password')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="employee_id">Employee ID</label>
                                <input type="text" name="employee_id" class="form-control" value="{{$user->employee_id}}" id="">
                                @error('employee_id')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="department">Department</label>
                                <select id="inputState" name="department" class="form-control">
                                    <option value="{{NULL}}" selected>Choose...</option>
                                    <option value="HR" {{ $user->department =="HR"? 'selected' : '' }}>HR</option>
                                    <option value="Development" {{ $user->department =="DEVELOPER"? 'selected' : '' }}>Development</option>
                                    <option value="Sales" {{ $user->department =="SALES"? 'selected' : '' }}>Sales</option>
                                    <option value="Deployment" {{ $user->department =="DEPLOYER"? 'selected' : '' }}>Deployment</option>
                                    <option value="Manager" {{ $user->department =="MANAGER"? 'selected' : '' }}>Manager</option>
                                </select>
                                @error('department')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="profile_text">About You</label>
                                <textarea class="form-control" id="profile_text" name="profile_text">{{$user->profile_text}}</textarea>
                            </div>
                            @error('profile_text')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="col-md-5">
                                <label for="country">Country</label>
                                <select name="country_id" class="form-control" id="country-dropdown">
                                    <option value={{null}} selected>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_id }}" {{$user->country_id==$country->country_id? 'selected':''}}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="city">city</label>
                                <select class="form-control" name="city_id" id="city-dropdown">
                                    @isset($cities)
                                        @foreach($cities as $city)
                                            <option value="{{$city->city_id }}" {{$user->city_id==$city->city_id? 'selected':''}}>{{$city->name}}</option>
                                        @endforeach 
                                    @endisset
                                    </select>
                                @error('city_id')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-row justify-content-left">
                            <div class="col-md-4 py-4">
                                <label for="status">Status</label>
                                <input type="radio" class="btn-check form-control" name="status" @if ($user->status==1) checked @endif value='1' id="success-outlined">
                                {{-- @if($skill->status==1) checked @endif> --}}
                                <label class="btn btn-outline-success px-3"  for="success-outlined">Active</label>

                                <input type="radio" class="btn-check form-control" value='0'  name="status" @if ($user->status==0) checked @endif  id="danger-outlined">
                                {{-- @if($skill->status==0) checked @endif> --}}
                                <label class="btn btn-outline-danger px-3" for="danger-outlined">Inactive</label>
                                @error('status')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-4 py-4"> {{--This is submit button--}}
                                <button class="btn btn-warning pull-right" type="submit"><i class="fa-solid fa-pen-to-square text-black"></i> Update</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
