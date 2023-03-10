@extends('admin.app')

@section('title')
    User
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="border-bottom"><span style="text-decoration-line: underline">User</span></h1>

        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="form-row py-4">
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer1.png" type="radio" name="avatar" id="avatar1"
                        @if (old('avatar') == 'Images/volunteer1.png') checked @endif>
                    <label class="form-check-label" for="avatar1">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer1.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer2.png" type="radio" name="avatar"
                        id="avatar2" @if (old('avatar') == 'Images/volunteer2.png') checked @endif>
                    <label class="form-check-label" for="avatar2">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer2.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer3.png" type="radio" name="avatar"
                        id="avatar3" @if (old('avatar') == 'Images/volunteer3.png') checked @endif>
                    <label class="form-check-label" for="avatar3">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer3.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer4.png" type="radio" name="avatar"
                        id="avatar4" @if (old('avatar') == 'Images/volunteer4.png') checked @endif>
                    <label class="form-check-label" for="avatar4">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer4.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer5.png" type="radio" name="avatar"
                        id="avatar5" @if (old('avatar') == 'Images/volunteer5.png') checked @endif>
                    <label class="form-check-label" for="avatar5">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer5.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer6.png" type="radio" name="avatar"
                        id="avatar6" @if (old('avatar') == 'Images/volunteer6.png') checked @endif>
                    <label class="form-check-label" for="avatar6">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer6.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer7.png" type="radio" name="avatar"
                        id="avatar7" @if (old('avatar') == 'Images/volunteer7.png') checked @endif>
                    <label class="form-check-label" for="avatar7">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer7.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer8.png" type="radio" name="avatar"
                        id="avatar8" @if (old('avatar') == 'Images/volunteer8.png') checked @endif>
                    <label class="form-check-label" for="avatar8">
                        <img class="rounded-circle" height="100px" width="100px" src={{ asset('Images/volunteer8.png') }}
                            alt="Alt Images">
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Images/volunteer9.png" type="radio" name="avatar"
                        id="avatar9" @if (old('avatar') == 'Images/volunteer9.png') checked @endif>
                    <label class="form-check-label" for="avatar9">
                        <img class="rounded-circle" height="100px" width="100px"
                            src={{ asset('Images/volunteer9.png') }} alt="Alt Images">
                    </label>
                </div>
                @error('avatar')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}"
                        id="">

                    @error('first_name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                        id="">
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
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        id="">
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="tel" name="phone_number" class="form-control" value="{{ old('phone_number') }}"
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
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                        id="">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" name="confirm_password" class="form-control"
                        value="{{ old('confirm_password') }}" id="">
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
                    <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id') }}"
                        id="">
                    @error('employee_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="department">Department</label>
                    <select id="inputState" name="department" class="form-control">
                        <option value="{{Null}}" selected>Choose...</option>
                        <option value="HR" {{ old('department') == 'HR' ? 'selected' : '' }}>HR</option>
                        <option value="Development" {{ old('department') == 'Development' ? 'selected' : '' }}>Development
                        </option>
                        <option value="Sales" {{ old('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                        <option value="Deployment" {{ old('department') == 'Deployment' ? 'selected' : '' }}>Deployment
                        </option>
                        <option value="Manager" {{ old('department') == 'Manager' ? 'selected' : '' }}>Manager</option>
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
                    <textarea class="form-control" id="profile_text" name="profile_text">{{ old('profile_text') }}</textarea>
                    @error('profile_text')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="form-row justify-content-start">
                <div class="col-md-5">
                    <label for="country">Country</label>
                    <select name="country_id" class="form-control" id="country-dropdown">
                        <option value="{{Null}}" selected>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country_id }}"
                                {{ old('country_id') == $country->country_id ? 'selected' : '' }}>{{ $country->name }}
                            </option>
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
                    <input type="radio" class="btn-check form-control" name="status"
                        {{ old('status') == '1' ? 'checked' : '' }} value='1' id="success-outlined">
                    {{-- @if ($skill->status == 1) checked @endif> --}}
                    <label class="btn btn-outline-success px-3" for="success-outlined">Active</label>

                    <input type="radio" class="btn-check form-control" value='0'
                        {{ old('status') == '0' ? 'checked' : '' }} name="status" id="danger-outlined">
                    {{-- @if ($skill->status == 0) checked @endif> --}}
                    <label class="btn btn-outline-danger px-3" for="danger-outlined">Inactive</label>
                    @error('status')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button class="btn btn-warning pull-right" type="submit"><i class="fa-solid fa-plus text-black"></i>
                Add</button>
        </form>

    </div>
@endsection
