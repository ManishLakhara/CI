@extends('admin.app')

@section('title')
     edit mission
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Edit Mission </span></ul>

        <form class="mt-3" method="post" action="{{ route('mission.update', $mission->mission_id) }}" class="row g-3"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
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
        </div>
        <div class="row">
             <div class="col-12">
                <label for="inputAddress" class="form-label">Mission Description</label>
                <textarea name="description" id="editor1">{{ $mission->description }}</textarea>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>
        <div class="row">
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
                <label for="city">City</label>
                <select class="form-control" name="city_id" id="city-dropdown">
                    <option value="none" selected="" disabled="" hidden=""></option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->city_id }}" {{ $city->city_id == $mission->city_id ? 'selected' : '' }}>
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
        <div class="row">
            <div class="col-md-6">
                <label for="orgName" class="form-label">Mission Organisation Name</label>
                <input type="text" class="form-control" id="orgName" name='organization_name'
                    value='{{ $mission->organization_name }}'>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Mission Organisation Detail</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='organization_detail'>{{ $mission->organization_detail }}</textarea>
            </div>
        </div>
        <div class="row">
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
                @error('end_date')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
            <div class="row">
            <div class="col-md-6">
                <label for="inputType" class="form-label">Mission Type</label>
                <select id="inputType" class="form-select" name='mission_type' onchange="handleMissionTypeChange(this)">
                    <option value="none" selected="" disabled="" hidden="">select mission type</option>
                    <option value="TIME" {{ $mission->mission_type === 'TIME' ? 'selected' : '' }}>Time</option>
                    <option value="GOAL" {{ $mission->mission_type === 'GOAL' ? 'selected' : '' }}>Goal</option>
                </select>
                @error('mission_type')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="text" class="form-label">Total Seats</label>
                <input type="text" class="form-control" id="text" name='total_seats'
                    value="{{ $timeMission ? $timeMission->total_seats : '' }}"
                    {{ $mission->mission_type === 'GOAL' ? 'disabled' : '' }}>
                @error('total_seats')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <label for="missionRegDeadline" class="form-label">Mission Registration Deadline</label>
                <input type="date" class="form-control" id="missionRegDeadline" name='registration_deadline'
                    value="{{ $timeMission ? date('Y-m-d', strtotime($timeMission->registration_deadline)) : '' }}"
                    {{ $mission->mission_type === 'GOAL' ? 'disabled' : '' }}>
                @error('registration_deadline')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="goal_objective_text" class="form-label">Goal Objective Text</label>
                <input type="text" class="form-control" id="goal_objective_text" name='goal_objective_text'
                    value="{{ $goalMission ? $goalMission->goal_objective_text : '' }}"
                    {{ $mission->mission_type === 'TIME' ? 'disabled' : '' }}>
                @error('goal_objective_text')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <label for="goal_value" class="form-label">Goal Value</label>
                <input type="text" class="form-control" id="goal_value" name='goal_value'
                    value="{{ $goalMission ? $goalMission->goal_value : '' }}"
                    {{ $mission->mission_type === 'TIME' ? 'disabled' : '' }}>
                @error('goal_value')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
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
            </div>
            <div class="row">
            <div class="col-md-6">
                <label for="mission_skills">Mission Skills</label>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Skills
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                        style="max-height: 200px; overflow-y: auto;">
                        @foreach ($mission_skills as $skill)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skill_id[]"
                                    value="{{ $skill->skill_id }}" id="skill-{{ $skill->skill_id }}"
                                    @if (in_array($skill->skill_id, $selected_skills->pluck('skill_id')->toArray())) checked @endif>
                                <label class="form-check-label" for="skill-{{ $skill->skill_id }}">
                                    {{ $skill->skill_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('skill_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="col-md-6">
                <label class="form-label" for="customFile">Mission Images</label>
                <input type="file" class="form-control" id="customFile" name="media_name[]" multiple />

                @error('media_name.*')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div>
                    @foreach ($missionImages as $image)
                        <span>{{ $image->media_name }}</span>
                        <input type="checkbox" name="selected_media[]" value="{{ $image->media_name }}" checked>
                    @endforeach
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="customFile">Mission Documents</label>
                <input type="file" class="form-control" id="customFile" name="document_name[]" multiple />

                @error('document_name.*')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div>
                    @foreach ($missionDocuments as $document)
                        <span>{{ $document->document_name }}</span>
                        <input type="checkbox" name="selected_documents[]" value="{{ $document->document_name }}"
                            checked>
                    @endforeach
                </div>
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
            </div>
            <div class="row">
            <div class="col-md-6">
                <label for="missionVideo" class="form-label">Mission Video</label>

                @if ($missionVideo && $missionVideo->count() > 0)
                    <input type="text" class="form-control" id="orgVideo" name="media_names"
                        value='{{ $missionVideo->first()->media_path }}'>
                @else
                    <input type="text" class="form-control" id="orgVideo" name="media_names" value=''>
                @endif


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
            </div>
            <div class="row mt-3">
            <div class="col-6">
                <button type="submit" class="btn btn-primary">Submit Edit</button>
            </div>
            <div class="col-6">
                <a class="btn btn-primary pull-right float-end" href="{{ route('mission.index') }}">cancel</a>
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script></script>
    <script>
        const missionTypeSelect = document.querySelector('#inputType');
        const totalSeatsInput = document.querySelector('#text');
        const registrationDeadlineInput = document.querySelector('#missionRegDeadline');
        const goalObjectiveTextInput = document.querySelector('#goal_objective_text');
        const goalValueInput = document.querySelector('#goal_value');

        function disableTotalSeatsAndRegistrationDeadline() {
            totalSeatsInput.disabled = true;
            registrationDeadlineInput.disabled = true;
            totalSeatsInput.value = '';
            registrationDeadlineInput.value = '';
        }

        function disableGoalObjectiveTextAndGoalValue() {
            goalObjectiveTextInput.disabled = true;
            goalValueInput.disabled = true;
            goalObjectiveTextInput.value = '';
            goalValueInput.value = '';
        }

        function enableTotalSeatsAndRegistrationDeadline() {
            totalSeatsInput.disabled = false;
            registrationDeadlineInput.disabled = false;
        }

        function enableGoalObjectiveTextAndGoalValue() {
            goalObjectiveTextInput.disabled = false;
            goalValueInput.disabled = false;
        }

        function handleMissionTypeChange(selectElement) {
            const selectedMissionType = selectElement.value;
            if (selectedMissionType === 'TIME') {
                disableGoalObjectiveTextAndGoalValue();
                enableTotalSeatsAndRegistrationDeadline();
            } else if (selectedMissionType === 'GOAL') {
                disableTotalSeatsAndRegistrationDeadline();
                enableGoalObjectiveTextAndGoalValue();
            }
        }

        missionTypeSelect.addEventListener('change', function() {
            handleMissionTypeChange(this);
        });

        // Initialize field states based on the initial mission type value
        const initialMissionType = missionTypeSelect.value;
        if (initialMissionType === 'TIME') {
            disableGoalObjectiveTextAndGoalValue();
        } else if (initialMissionType === 'GOAL') {
            disableTotalSeatsAndRegistrationDeadline();
        }
    </script>
@endsection
