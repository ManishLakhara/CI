@extends('admin.app')

@section('title')
    Mission-Theme Add mission
@endsection

@section('body')
    <div class="container-fluid px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Add Mission </span></ul>

        <form class="mt-3" method="post" action="{{ route('mission.store') }}" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="missionTitle" class="form-label">Mission Title</label>
                    <input type="text" class="form-control" id="missionTitle" name='title' value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="missionDesc" class="form-label">Mission Short Description</label>
                    <input type="text" class="form-control" id="missionDesc" name='short_description'
                        value="{{ old('short_description') }}">
                    @error('short_description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="inputAddress" class="form-label">Mission Description</label>
                    <textarea name="description" id="editor1">{{ old('description') }}</textarea>
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
                        <option value="none" selected="" disabled="" hidden="">select country</option>
                        @foreach ($countries as $country)
                            {{-- <option value="{{ $country->country_id }}">{{ $country->name }}</option> --}}
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
                <div class="col-md-6">
                    <label for="city">City</label>
                    <select class="form-control" name="city_id" id="city-dropdown">
                        <option value="none" selected="" disabled="" hidden=""></option>

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
                        value="{{ old('organization_name') }}">
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Mission Organisation Detail</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='organization_detail'>{{ old('organization_name') }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="inputdate" class="form-label">Mission Start Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='date' class="form-control" name='start_date' value="{{ old('start_date') }}" />

                    </div>
                    @error('start_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mission End Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='date' class="form-control" name='end_date' value="{{ old('end_date') }}" />

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
                    <select id="inputType" class="form-select" name='mission_type' value="{{ old('mission_type') }}">
                        <option value="none" selected="" disabled="" hidden="">select mision type</option>
                        <option value="time">Time</option>
                        <option value="goal">Goal</option>
                    </select>
                    @error('mission_type')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="text" class="form-label">Total Seats</label>
                    <input type="text" class="form-control" id="text" name='total_seats' disabled>
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
                        disabled value="{{ old('registration_deadline') }}">
                    @error('registration_deadline')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="goal_objective_text" class="form-label">Goal Objective Text</label>
                    <input type="text" class="form-control" id="goal_objective_text" name='goal_objective_text'
                        disabled value="{{ old('goal_objective_text') }}">
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
                    <input type="text" class="form-control" id="goal_value" name='goal_value' disabled
                        value="{{ old('goal_value') }}">
                    @error('goal_value')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="inputTheme" class="form-label">Mission Theme</label>
                    <select class="form-control" id="country-dropdown" name='theme_id'>
                        <option value="none" selected="" disabled="" hidden="">select mission theme
                        </option>
                        @foreach ($mission_theme as $theme)
                            <option value="{{ $theme->mission_theme_id }}">{{ $theme->title }}</option>
                        @endforeach
                    </select>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="mission_skills">Mission Skills</label>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle col-md-6" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Skills
                        </button>
                        <div class="dropdown-menu col-md-6" aria-labelledby="dropdownMenuButton"
                            style="max-height: 200px; overflow-y: auto;">
                            @foreach ($mission_skills as $skill)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="skill_id[]"
                                        value="{{ $skill->skill_id }}" id="skill-{{ $skill->skill_id }}">
                                    <label class="form-check-label" for="skill-{{ $skill->skill_id }}">
                                        {{ $skill->skill_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('skill_id')
                        <div class="text-danger">
                            Please select at least one skill.
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
                </div>
                <div class="col-md-6">
                    <label for="inputAvailable" class="form-label">Mission Availability</label>
                    <select id="inputAvailable" class="form-select" name='availability'>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Week-end</option>
                        <option>Monthly</option>
                    </select>
                </div>
            </div>
            <div class="row">
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
                        <option value="0">Inactive</option>
                        <option value="1" selected>Active</option>
                    </select>


                    @error('status')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6 py-4">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <div class="col-6 py-4">
                    <a class="btn btn-primary pull-right float-end" href="{{ route('mission.index') }}">cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        const missionTypeSelect = document.getElementById('inputType');
        const totalSeatsInput = document.getElementById('text');
        const registrationDeadlineInput = document.getElementById('missionRegDeadline');
        const goalObjectiveTextInput = document.getElementById('goal_objective_text');
        const goalValueInput = document.getElementById('goal_value');

        missionTypeSelect.addEventListener('change', function() {
            const selectedOption = missionTypeSelect.value;

            if (selectedOption === 'time') {
                totalSeatsInput.disabled = false;
                registrationDeadlineInput.disabled = false;
                goalObjectiveTextInput.disabled = true;
                goalValueInput.disabled = true;


                goalObjectiveTextInput.value = '';
                goalValueInput.value = '';
            } else if (selectedOption === 'goal') {
                totalSeatsInput.disabled = true;
                registrationDeadlineInput.disabled = true;
                goalObjectiveTextInput.disabled = false;
                goalValueInput.disabled = false;


                totalSeatsInput.value = '';
                registrationDeadlineInput.value = '';
            } else {
                totalSeatsInput.disabled = true;
                registrationDeadlineInput.disabled = true;
                goalObjectiveTextInput.disabled = true;
                goalValueInput.disabled = true;


                totalSeatsInput.value = '';
                registrationDeadlineInput.value = '';
                goalObjectiveTextInput.value = '';
                goalValueInput.value = '';
            }
        });
    </script>
@endsection
add
