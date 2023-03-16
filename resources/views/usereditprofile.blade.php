@extends('layouts.app')
@section('title')
    Edit Profile
@endsection

@section('content')
    <form action="" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-4 img-thumbnail mt-5 d-flex-column justify-content-center text-center"
                    style="width: 330px;height:315px;">
                    <img src="{{ asset('Images/user-img1.png') }}" alt="profile-photo" class="img-fluid rounded-circle mt-5"
                        style="width: 130px;height:115px;">
                    <h5 class="mt-2">Evan Donohue</h5>
                    <button type="button" data-toggle="modal" data-target="#passwordModal"
                        class="btn btn-warning">Change
                        Password</button>


                    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog"
                        aria-labelledby="passwordModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content p-3">
                                <form action="" method="post">
                                    @csrf
                                    @method('POST')
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div class="py-2 text-start">
                                                Change Password
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="border:none;background:none">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-4">

                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    placeholder="Enter Old Password">
                                            </div>
                                            <div class="col-12 mt-4">

                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    placeholder="Enter new Password">
                                            </div>
                                            <div class="col-12 mt-4">

                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    placeholder="Enter confirm Password">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex py-4 justify-content-end">
                                        <div class="px-1">
                                            <button type="button" class="btn btn-outline-secondary px-4"
                                                style="border-radius: 23px" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="px-1">
                                            <button type="submit" class="btn btn-outline effects px-4"
                                                style="border-color: #f88634 ;border-radius: 23px; color: #f88634">Change
                                                Password</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px solid #ADADAD;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-1" type="button"
                                role="tab" aria-controls="home" aria-selected="true"
                                style="color: #443d3e; font-weight: 500px; border:none; border-bottom: 3px solid #3b3636; padding: 14px 18px;">Basic
                                Information</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                            style="font-size: 15px; line-height: 24px; color: #3E3E3E;">


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
                                    <textarea class="form-control mt-2" id="why_i_volunteer" name="why_i_volunteer"
                                        placeholder="Enter your comments..."></textarea>
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
                            <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-1"
                                type="button" role="tab" aria-controls="home" aria-selected="true"
                                style="color: #443d3e; font-weight: 500px; border:none; border-bottom: 3px solid #3b3636; padding: 14px 18px;">Address
                                Information</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                            style="font-size: 15px; line-height: 24px; color: #3E3E3E;">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="country_id" class="form-label">Country*</label>
                                    <select id="country_id" class="form-select" name='country_id'>
                                        <option value="none" selected="" disabled="" hidden="">Select Your
                                            Country</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="city_id" class="form-label">City</label>
                                    <select id="city_id" class="form-select" name='city_id'>
                                        <option value="none" selected="" disabled="" hidden="">Select Your
                                            City
                                        </option>
                                    </select>
                                </div>
                            </div>


                        </div>

                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px solid #ADADAD;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-1"
                                type="button" role="tab" aria-controls="home" aria-selected="true"
                                style="color: #443d3e; font-weight: 500px; border:none; border-bottom: 3px solid #3b3636; padding: 14px 18px;">Professional
                                Information</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                            style="font-size: 15px; line-height: 24px; color: #3E3E3E;">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="inputAvailable" class="form-label">Availability</label>
                                    <select id="inputAvailable" class="form-select" name='availability'
                                        placeholder="Enter your employee id">
                                        <option>Select Your Availability</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="linked_in_url" class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" id="linked_in_url"
                                        placeholder="Enter your Linkdin URL" name="linked_in_url">
                                    @error('linkedin')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <footer>
                                <div class="container policy">
                                    <div class="col-md-2 text-muted ">
                                        <a class="no-decor text-muted " href="#"> Privacy Policy</a>
                                    </div>
                                </div>
                            </footer>
                        </div>

                    </div>


                </div>
            </div>
        </div>


    </form>

@endsection
