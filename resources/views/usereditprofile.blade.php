@extends('layouts.app')
@section('title')
    Edit Profile
@endsection

@section('content')
    <form action="{{ route('update-profile') }}" enctype="multipart/form-data" method="POST">
        @csrf

        @method('PUT')

        <div class="container">
            <div class="row">
                <div class="col-lg-4 img-thumbnail mt-5 d-flex-column justify-content-center text-center"
                    style="width: 330px;height:315px;">
                    <label for="avatar" style="cursor: pointer;">
                        <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('Images/user-img1.png') }}"
                            alt="profile-photo" class="img-fluid rounded-circle mt-5" style="width: 130px; height: 115px;">
                    </label>
                    <input type="file" id="avatar" name="avatar" style="display: none;">
                    <h5 class="mt-2">{{ $user->first_name }} {{ $user->last_name }}</h5>

                    <button type="button" data-toggle="modal" data-target="#passwordModal" class="btn btn-warning">Change
                        Password
                    </button>

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
                                        placeholder="Enter your name" value="{{ $user->first_name }}">
                                    @error('first_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="last_name" class="form-label">Surname*</label>
                                    <input type="text" class="form-control" id="last_name" name='last_name'
                                        placeholder="Enter your surname" value="{{ $user->last_name }}">
                                    @error('last_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <label for="employee_id" class="form-label">Employee ID</label>
                                    <input type="text" name="employee_id" class="form-control" id="employee_id"
                                        placeholder="Enter your Employee ID" value="{{ $user->employee_id }}">
                                    @error('employee_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

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
                                        placeholder="Enter your title" value="{{ $user->title }}">
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="department" name='department'
                                        placeholder="Enter your Department" value="{{ $user->department }}">
                                    @error('department')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mt-4">
                                    <label for="profile_text">My Profile*</label>
                                    <textarea class="form-control mt-2" id="profile_text" name="profile_text" placeholder="Enter your comments...">{{ $user->profile_text }}</textarea>
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
                                        placeholder="Enter your comments...">{{ $user->why_i_volunteer }}</textarea>
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
                            <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-2"
                                type="button" role="tab" aria-controls="home" aria-selected="true"
                                style="color: #443d3e; font-weight: 500px; border:none; border-bottom: 3px solid #3b3636; padding: 14px 18px;">Address
                                Information</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                        <div class="tab-pane fade show active" id="tab-2" role="tabpanel"
                            style="font-size: 15px; line-height: 24px; color: #3E3E3E;">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="country">Country</label>
                                    <select name="country_id" class="form-control" id="country-dropdown">
                                        <option value="none">select your country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country_id }}"
                                                @if ($country->country_id == $user->country_id) selected @endif>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="city">City</label>
                                    <select class="form-control" name="city_id" id="city-dropdown">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->city_id }}"
                                                {{ $city->city_id == $user->city_id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
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
                                    <select id="inputAvailable" class="form-select" name='availability'>
                                        <option value="">Select your availability</option>
                                        <option value="daily" @if ($user->availability == 'daily') selected @endif>Daily
                                        </option>
                                        <option value="weekly" @if ($user->availability == 'weekly') selected @endif>Weekly
                                        </option>
                                        <option value="week-end" @if ($user->availability == 'week-end') selected @endif>Week-end
                                        </option>
                                        <option value="monthly" @if ($user->availability == 'monthly') selected @endif>Monthly
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="linked_in_url" class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Enter your Linkdin URL" name="linked_in_url"
                                        value="{{ $user->linked_in_url }}">
                                    @error('linked_in_url')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <ul class="nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px solid #ADADAD;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active mt-5" data-bs-toggle="tab" data-bs-target="#tab-1"
                                type="button" role="tab" aria-controls="home" aria-selected="true"
                                style="color: #443d3e; font-weight: 500px; border:none; border-bottom: 3px solid #3b3636; padding: 14px 18px;">My
                                Skills</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="margin-top: 25px;">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                            style="font-size: 15px; line-height: 24px; color: #3E3E3E;">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="mission_skills">My Skills</label>
                                    <select name="skill_id[]" class="form-control" id="skill-dropdown" multiple>
                                        <option value="">Time management.</option>
                                        <option value="">Effective communication</option>
                                        <option value="">Problem-solving</option>
                                        <option value="">Productivity & Organization</option>
                                        <option value="">Teamwork skills</option>
                                    </select>
                                    <div class="col-3 mt-3">
                                        <span class="btn pull-right btn-outline-secondary" style="border-radius:18px">Add
                                            Skills</span>
                                    </div>
                                    @error('skill_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn apply-btn mt-5 float-end">Save</button>
                </div>
            </div>
        </div>

    </form>


    {{-- <div class="modal fade" id="passwordModal-{{ $user->user_id }}" tabindex="-1" role="dialog"
        aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">

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

                            <input type="password" class="form-control" id="old_password_id"
                                placeholder="Enter Old Password" name="old_password">
                            @error('old_password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-4">

                            <input type="password" class="form-control" id="new_password_id"
                                placeholder="Enter new Password" name="password">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-4">

                            <input type="password" class="form-control" id="new_confirm_password_id"
                                placeholder="Enter confirm Password" name="confirm_password">
                            @error('confirm_password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="d-flex py-4 justify-content-end">
                    <div class="px-1">
                        <button type="button" class="btn btn-outline-secondary px-4" style="border-radius: 23px"
                            data-dismiss="modal">Close</button>
                    </div>
                    <div class="px-1">
                        <button type="button" class="btn btn-outline effects px-4"
                            style="border-color: #f88634 ;border-radius: 23px; color: #f88634"
                            id="update_password_form_{{ Auth::user()->user_id }}">Change
                            Password</button>
                    </div>

                </div>

            </div>

        </div>
    </div> --}}
    {{-- <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border:none;background:none">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="passwordForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">

                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="confirm_password">
                        </div>
                        <div id="password-error" class="alert alert-danger" role="alert" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class=" d-flex justify-content-between">

                        <div class=" mt-4 text-start">
                            <h6>Change Password
                        </div>
                        <button type="button" class="close mt-3" data-dismiss="modal" aria-label="Close"
                            style="border:none;background:none">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form id="passwordForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <input type="password" class="form-control" id="old_password"
                                        placeholder="Enter Old Password" name="old_password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Enter new Password" name="password">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Enter confirm Password" name="confirm_password">
                                </div>

                            </div>
                        </div>
                        <div id="password-error" class="alert alert-danger" role="alert" style="display: none;"></div>
                    </div>

                    <div class="container">
                        <div class=" d-flex mt-3 justify-content-end">
                            <button type="button" class="btn px-4 btn-outline-secondary" style="border-radius:18px"
                                data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
                            <button type="submit" class="btn px-4 btn-outline-warning" style="border-radius:18px">Change
                                Password</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-city') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .city_id + '">' + value.name + '</option>');
                        });
                    }
                });
            })
            // $("button[id^='update_password_form_']").on('click',function(){
            //     newPassword = $('#new_password_id').val();
            //     newConfirmPassword = $('#new_confirm_password_id').val();
            //     oldPassword = $('#old_password_id').val();
            //     user_id = this.id.split("_")[3];
            //     $.ajax({
            //         url: "{{ url('api/change-password') }}",
            //         type: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             oldPassword: oldPassword,
            //             password: newPassword,
            //             user_id: user_id,
            //             newConfirmPassword: newConfirmPassword,
            //         },
            //         success: function(data){
            //             alert('password changed');
            //         },
            //         // error: function(xhr){
            //         //     if(xhr.status == 422){
            //         //         var errors = JSON.parse(xhr.responseText);
            //         //         if (errors.old_password) {
            //         //             alert('old is required'); // and so on
            //         //         }
            //         //         if (errors.password) {
            //         //             alert(' is required'); // and so on
            //         //         }
            //         //         if (errors.confirm_password) {
            //         //             alert('required'); // and so on
            //         //         }
            //         //     }
            //         // }
            //         error: function (err) {
            //             if (err.status == 422) { // when status code is 422, it's a validation issue
            //                 console.log(err.responseJSON);
            //                 $('#success_message').fadeIn().html(err.responseJSON.message);

            //                 // you can loop through the errors object and show it to the user
            //                 console.warn(err.responseJSON.errors);
            //                 // display errors on each form field
            //                 $.each(err.responseJSON.errors, function (i, error) {
            //                     var el = $(document).find('[name="'+i+'"]');
            //                     el.after($('<span style="color: red;">'+error[0]+'</span>'));
            //                 });
            //             }
            //         }
            //     });
            // })
        });
    </script>
    <script>
        $('#passwordForm').submit(function(event) {
            event.preventDefault();
            var user_id = $('#user_id').val();
            $.ajax({
                type: 'POST',
                url: "{{ url('api/users/update-password') }}",
                data: $(this).serialize(),
                success: function(response) {
                    $('#passwordModal').modal('hide');
                    location.reload();
                    alert('Password has been updated successfully!');
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += '<p>' + value + '</p>';
                    });
                    $('#password-error').html(errorHtml).show();
                },
            });
        });
    </script>
    {{-- <script>
        $(function() {
            $('label[for="avatar"]').on('click', function() {
                $('#avatar').click();
            });
        });
    </script> --}}
    <script>
        $(function() {
            $('label[for="avatar"]').on('click', function(e) {
                e.stopPropagation();
                $('#avatar').click();
            });

            $('#avatar').on('click', function(e) {
                e.stopPropagation();
            });

            $('#avatar').on('change', function() {
                var input = $(this);
                var img = $('label[for="avatar"] img');
                var file = input[0].files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    {{-- @section('contactus')
    @include('inc.contactus')
@endsection --}}


    <script>
        // $(document).ready(function() {
        //     //Handle form submission
        //     $('update-password-form').submit(function(event) {
        //         // Prevent the form from submitting normally
        //         event.preventDefault();

        //        // Get form data
        //         var formData = new FormData(this);

        //         // Send form data to server using AJAX
        //         $.ajax({
        //             url: $(this).attr('action'),
        //             type: $(this).attr('method'),
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function(response) {
        //                 // Handle success response
        //                 console.log(response);
        //             },
        //             error: function(xhr, status, error) {
        //                 // Handle error response
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     });
        // });
    </script>
@endsection
