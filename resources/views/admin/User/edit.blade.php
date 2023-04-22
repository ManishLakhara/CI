@extends('admin.app')

@section('title')
    User
@endsection

@section('body')
                <div class="container-fluid mt-4">
                    <ul class="nav border-bottom"><span class="nav-link active fs-1"> User </span></ul>

                    <form action="{{ route('user.update', $user->user_id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row py-4">
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer1.png" type="radio" name="avatar"
                                    id="avatar1" @if ($user->avatar == 'Images/volunteer1.png') checked @endif>
                                <label class="form-check-label" for="avatar1">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer1.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer2.png" type="radio" name="avatar"
                                    id="avatar2" @if ($user->avatar == 'Images/volunteer2.png') checked @endif>
                                <label class="form-check-label" for="avatar2">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer2.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer3.png" type="radio" name="avatar"
                                    id="avatar3" @if ($user->avatar == 'Images/volunteer3.png') checked @endif>
                                <label class="form-check-label" for="avatar3">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer3.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer4.png" type="radio" name="avatar"
                                    id="avatar4" @if ($user->avatar == 'Images/volunteer4.png') checked @endif>
                                <label class="form-check-label" for="avatar4">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer4.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer5.png" type="radio" name="avatar"
                                    id="avatar5" @if ($user->avatar == 'Images/volunteer5.png') checked @endif>
                                <label class="form-check-label" for="avatar5">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer5.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer6.png" type="radio" name="avatar"
                                    id="avatar6" @if ($user->avatar == 'Images/volunteer6.png') checked @endif>
                                <label class="form-check-label" for="avatar6">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer6.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer7.png" type="radio" name="avatar"
                                    id="avatar7" @if ($user->avatar == 'Images/volunteer7.png') checked @endif>
                                <label class="form-check-label" for="avatar7">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer7.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer8.png" type="radio" name="avatar"
                                    id="avatar8" @if ($user->avatar == 'Images/volunteer8.png') checked @endif>
                                <label class="form-check-label" for="avatar8">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer8.png') }} alt="Alt Images">
                                </label>
                            </div>
                            <div class="form-check">
                                <input hidden class="form-check-input" value="Images/volunteer9.png" type="radio"
                                    name="avatar" id="avatar9" @if ($user->avatar == 'Images/volunteer9.png') checked @endif>
                                <label class="form-check-label" for="avatar9">
                                    <img class="rounded-circle" height="100px" width="100px"
                                        src={{ asset('Images/volunteer9.png') }} alt="Alt Images">
                                </label>
                            </div>
                        </div>
                        {{-- <div class="row align-items-center py-3">
                            <div class="col"><span class="fs-4">Update users Profile Images</span></div>
                            <div class="col">
                                <label for="avatar" style="cursor: pointer;">
                                    <img src="{{asset($user->avatar)}}"
                                        alt="profile-photo" class="img-fluid rounded-circle mt-5" style="width: 115px; height: 115px;">
                                </label>
                                <input type="file" id="avatar" name="avatar" style="display: none;">
                            </div>
                        </div> --}}

                        @error('avatar')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    @if(old('first_name')==Null)
                                        value={{ $user->first_name }}
                                    @else
                                        value={{old('first_name')}}
                                    @endif>
                                @error('first_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" @if (old('last_name')==Null)
                                    value={{ $user->last_name }}
                                @else
                                    value={{ old('last_name')}}
                                @endif>
                                @error('last_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    @if (old('email') == null) value={{ $user->email }} @else value={{ old('email') }} @endif
                                    id="">
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="tel" name="phone_number" class="form-control"
                                    @if (old('phone_number') == null) value={{ $user->phone_number }} @else value={{ old('phone_number') }} @endif
                                    id="">
                                @error('phone_number')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="">
                                @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password">Confirm password</label>
                                <input type="password" name="confirm_password" class="form-control" id="">
                                @error('confirm_password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="employee_id">Employee ID</label>
                                <input type="text" name="employee_id" class="form-control"
                                    @if (old('employee_id') == 0) value={{ $user->employee_id }}
                                @else
                                    value={{ old('employee_id') }} @endif>
                                @error('employee_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="department">Department</label>
                                <select id="inputState" name="department" class="form-control">
                                    <option disabled value="{{ null }}">Choose...</option>
                                    <option value="HR"
                                    @if(old('department')==Null)
                                        @if ($user->department == 'HR')
                                        selected
                                        @endif
                                    @else
                                        @if (old('department') == 'HR')
                                        selected
                                        @endif
                                    @endif
                                    >HR</option>
                                    <option value="Development"
                                    @if(old('department')==Null)
                                            @if ($user->department == 'Develpment')
                                            selected
                                            @endif
                                        @else
                                            @if (old('department') == 'Develpment')
                                            selected
                                            @endif
                                        @endif
                                        >Development</option>
                                    <option value="Sales"
                                    @if(old('department')==Null)
                                            @if ($user->department == 'Sales')
                                            selected
                                            @endif
                                        @else
                                            @if (old('department') == 'Sales')
                                            selected
                                            @endif
                                        @endif
                                        >Sales</option>
                                    <option value="Deployment"
                                        @if(old('department')==Null)
                                            @if ($user->department == 'Deployment')
                                            selected
                                            @endif
                                        @else
                                            @if (old('department') == 'Deployment')
                                            selected
                                            @endif
                                        @endif
                                        >Deployment</option>
                                    <option value="Manager"
                                        @if(old('department')==Null)
                                            @if ($user->department == 'Manager')
                                            selected
                                            @endif
                                        @else
                                            @if (old('department') == 'Manager')
                                            selected
                                            @endif
                                        @endif
                                        >Manager</option>
                                </select>
                                @error('department')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="profile_text">About You</label>
                                <textarea class="form-control" id="profile_text" name="profile_text">
                                    @if (old('profile_text') == null)
                                        {{ $user->profile_text }}
                                    @else
                                    {{ old('profile_text') }}
                                    @endif
                                </textarea>
                            </div>
                            @error('profile_text')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="col-md-5">
                                <label for="country">Country</label>
                                <select name="country_id" class="form-control" id="country-dropdown">
                                    <option value={{ null }} selected>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_id }}"
                                            @if(old('country_id')==Null)
                                            {{ $user->country_id == $country->country_id ? 'selected' : '' }}
                                            @else
                                            {{ old('country_id') == $country->country_id ? 'selected' : ''}}
                                            @endif>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="city">city</label>
                                <select class="form-control" name="city_id" id="city-dropdown">
                                    @isset($cities)
                                        @if(old('city_id')==null)
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->city_id }}"
                                                {{ $user->city_id == $city->city_id ? 'selected' : '' }}>{{ $city->name }}
                                            </option>
                                        @endforeach
                                        @else
                                        <option value="{{ old('city_id')}}">Old Selected Value</option>
                                            @endif
                                    @endisset
                                </select>
                                @error('city_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row justify-content-left">
                            <div class="col-md-4 py-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="0"
                                        @if (old('status') == null) @if ($user->status == 0)? selected @endif
                                    @else @if (old('status') == 0) ? selected @endif @endif
                                        >
                                        Inactive</option>
                                    <option value="1"
                                        @if (old('status') == null) @if ($user->status == 1)? selected @endif
                                    @else @if (old('status') == 1) ? selected @endif @endif
                                        > Active </option>
                                </select>
                                @error('status')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 py-4 d-flex justify-content-end align-self-end"> {{-- This is submit button --}}
                                <button class="btn btn-warning" type="submit"><i
                                        class="fa-solid fa-pen-to-square text-black"></i> Update</button>
                                <a aria-label="cancle" class="mx-4 btn btn-secondary" href="{{ route('user.index') }}">Cancle</a>
                            </div>
                        </div>
                    </form>
                </div>

@endsection
