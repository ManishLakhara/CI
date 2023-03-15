@extends('layouts.app')
@section('title')
    Edit Profile
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 img-thumbnail mt-5 d-flex-column justify-content-center text-center"
                style="width: 330px;height:315px;">
                <img src="{{ asset('Images/user-img1.png') }}" alt="profile-photo" class="img-fluid rounded-circle mt-5"
                    style="width: 130px;height:115px;">
                <h5 class="mt-2">Evan Donohue</h5>
                <button type="submit" class="btn btn-outline-warning mt-3" style="width: 50%; border-radius: 23px">Change
                    Password</button>
            </div>
            <div class="col-lg-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px solid #ADADAD;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                            role="tab" aria-controls="home" aria-selected="true"
                            style="color: #443d3e; font-weight: 500px; border-bottom: 3px solid #3b3636; padding: 14px 18px;">Basic
                            Information</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                        style="font-size: 15px; line-height: 24px; color: #3E3E3E;">

                        <form action="{{ route('profile.update') }}"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="first_name" class="form-label">Name*</label>
                                    <input type="text" class="form-control" id="first_name" name='first_name'
                                        placeholder="Enter your name">
                                </div>
                                <div class="col-lg-6">
                                    <label for="last_name" class="form-label">Surname*</label>
                                    <input type="text" class="form-control" id="last_name" name='last_name'
                                        placeholder="Enter your surname">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <label for="employee_id" class="form-label">Employee ID</label>
                                    <input type="text" name="employee_id" class="form-control" id="employee_id"
                                        placeholder="Enter your Employee ID">
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <label for="manager" class="form-label">Manager</label>
                                    <input type="text" class="form-control" id="manager" name='manager'
                                        placeholder="Enter your manager details">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name='title'
                                        placeholder="Enter your title">
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="department" name='department'
                                        placeholder="Enter your Department">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mt-4">
                                    <label for="profile_text">My Profile*</label>
                                    <textarea class="form-control mt-2" id="profile_text" name="profile_text" placeholder="Enter your comments..."></textarea>
                                    @error('profile_text')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mt-4">
                                    <label for="why_i_volunteer">Why I Volunteer?</label>
                                    <textarea class="form-control mt-2" id="why_i_volunteer" name="why_i_volunteer" placeholder="Enter your comments..."></textarea>
                                    @error('why_i_volunteer')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                    </div>

                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px solid #ADADAD;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                            role="tab" aria-controls="home" aria-selected="true"
                            style="color: #443d3e; font-weight: 500px; border-bottom: 3px solid #3b3636; padding: 14px 18px;">Address
                            Information</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                        style="font-size: 15px; line-height: 24px; color: #3E3E3E;">

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="country">Country</label>
                                <select name="country_id" class="form-control" id="country-dropdown">
                                    <option value="{{ null }}" selected>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->country_id }}"
                                            {{ old('country_id') == $country->country_id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
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
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
