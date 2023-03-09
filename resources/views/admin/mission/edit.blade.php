@extends('admin.app')

@section('title')
    Mission-Theme Add mission
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Mission</h1>

        <form method="post" action="{{ route('mission.update', $mission->mission_id) }}" class="row g-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <label for="missionTitle" class="form-label">Mission Title</label>
                <input type="text" class="form-control" id="missionTitle" name='title' value='{{ $mission->title }}'>
                @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="missionDesc" class="form-label">Mission Short Description</label>
                <input type="text" class="form-control" id="missionDesc" name='short_description'
                    value='{{ $mission->short_description }}'>
                @error('short_description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Mission Description</label>
                <textarea name="description" id="editor1">{{ $mission->description }}</textarea>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="col-md-6">
                <label for="country">Country</label>
                <select name="country_id" class="form-control" id="country-dropdown">

                    @foreach ($countries as $country)
                        <option value="{{ $country->country_id }}" @if ($country->country_id == $mission->country_id) selected @endif>
                            {{ $country->name }}</option>
                    @endforeach
                </select>

                @error('country_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="city">city</label>
                <select class="form-control" name="city_id" id="city-dropdown" value='{{ $mission->city }}'>
                </select>
                @error('city_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="orgName" class="form-label">Mission Organisation Name</label>
                <input type="text" class="form-control" id="orgName" name='organization_name'
                    value='{{ $mission->organization_name }}'>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Mission Organisation Detail</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='organization_detail'>{{ $mission->organization_detail }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Mission Start Date</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" name='start_date'
                        value='{{ date('Y-m-d', strtotime($mission->start_date)) }}' />

                </div>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Mission End Date</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" name='end_date'
                        value='{{ date('Y-m-d', strtotime($mission->end_date)) }}' />

                </div>
            </div>
            {{-- <div class="col-md-6">
                    <label for="inputType" class="form-label">Mission Type</label>
                    <select id="inputType" class="form-select" name='mission_type'>
                        <option value="time">Time</option>
                        <option value="goal">Goal</option>
                    </select>
                </div> --}}
            <div class="col-md-6">
                <label for="inputType" class="form-label">Mission Type</label>
                <select id="inputType" class="form-select" name='mission_type'>
                    <option value="none" selected="" disabled="" hidden=""></option>
                    <option value="TIME" @if ($mission->mission_type == 'TIME') selected @endif>Time</option>
                    <option value="GOAL" @if ($mission->mission_type == 'GOAL') selected @endif>Goal</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="text" class="form-label">Total Seats</label>
                <input type="text" class="form-control" id="text"
                    name='total_seats'value='{{ $mission->total_seats }}' disabled>
            </div>
            <div class="col-md-6">
                <label for="missionRegDeadline" class="form-label">Mission Registration Deadline</label>
                <input type="date" class="form-control" id="missionRegDeadline" name='registration_deadline'
                    disabled>
            </div>
            <div class="col-md-6">
                <label for="inputTheme" class="form-label">Mission Theme</label>
                <select class="form-control" id="country-dropdown" name='theme_id'>
                    <option value="none" selected="" disabled="" hidden=""></option>
                    @foreach ($mission_theme as $theme)
                        <option value="{{ $theme->mission_theme_id }}"
                            {{ $theme->mission_theme_id == $mission->theme_id ? 'selected' : '' }}>{{ $theme->title }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="col-md-6">
                <label for="mission_skills">Mission Skills</label>
                <select name="skill_id[]" class="form-control" id="skill-dropdown" multiple>
                    @foreach ($mission_skills as $skill)
                        <option value="{{ $skill->skill_id }}"
                            @foreach ($selected_skills as $selected_skill) {{ $selected_skill->skill_id == $skill->skill_id ? 'selected' : '' }} @endforeach>
                            {{ $skill->skill_name }}</option>
                    @endforeach
                </select>
                @error('skill_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="customFile">Mission Images</label>
                <input type="file" class="form-control" id="customFile" name='mission_images' />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="customFile">Mission Documents</label>
                <input type="file" class="form-control" id="customFile" name="document_name[]" multiple />

                @error('document_name.*')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="col-md-6">
                <label for="inputAvailable" class="form-label">Mission Availability</label>
                <select id="inputAvailable" class="form-select" name='availability'>
                    <option value=""></option>
                    <option value="daily" @if ($mission->availability == 'daily') selected @endif>Daily</option>
                    <option value="weekly" @if ($mission->availability == 'weekly') selected @endif>Weekly</option>
                    <option value="week-end" @if ($mission->availability == 'week-end') selected @endif>Week-end</option>
                    <option value="monthly" @if ($mission->availability == 'monthly') selected @endif>Monthly</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="missionVideo" class="form-label">Mission Video</label>
                <input type="text" class="form-control" id="orgVideo" name="media_names">
                @error('media_names')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="0" @if (!$mission->status) selected @endif>Inactive</option>
                    <option value="1" @if ($mission->status) selected @endif>Active</option>
                </select>


                @error('status')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit Edit</button>
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // get the mission type select element
        var missionType = $('#inputType');

        // get the total seats and registration deadline inputs
        var totalSeats = $('#text');
        var regDeadline = $('#missionRegDeadline');

        // add an event listener to the mission type select element
        missionType.on('change', function() {
            // check if the selected mission type is 'time'
            if (missionType.val() === 'time') {
                // if it is, enable the total seats and registration deadline inputs
                totalSeats.prop('disabled', false);
                regDeadline.prop('disabled', false);
            } else {
                // if it isn't, disable the total seats and registration deadline inputs
                totalSeats.prop('disabled', true);
                regDeadline.prop('disabled', true);
            }
        });
    </script>
@endsection
