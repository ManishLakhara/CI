
@extends('admin.app')

@section('title')
    Mission-Theme Add mission
@endsection

@section('body')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Mission</h1>

            <form method="post" action="{{route('mission.update',$mission->mission_id) }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                  @method('PUT')
                <div class="col-md-6">
                    <label for="missionTitle" class="form-label">Mission Title</label>
                    <input type="text" class="form-control" id="missionTitle" name='title' value='{{$mission->title}}'>
                    @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="col-md-6">
                    <label for="missionDesc" class="form-label">Mission Short Description</label>
                    <input type="text" class="form-control" id="missionDesc" name='short_description' value='{{$mission->short_description}}'>
                    @error('short_description')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Mission Description</label>
                    <textarea name="description" id="editor1">{{$mission->description}}</textarea>
                    @error('description')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror

                </div>
                <div class="col-md-6">
                    <label for="country">Country</label>
                    <select name="country_id" class="form-control" id="country-dropdown">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country_id }}" @if ($country->country_id == $mission->country_id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>

                                @error('country_id')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                </div>

                <div class="col-md-6">
                    <label for="city">city</label>
                    <select class="form-control" name="city_id" id="city-dropdown" value='{{$mission->city}}'>
                    </select>
                    @error('city_id')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="orgName" class="form-label">Mission Organisation Name</label>
                    <input type="text" class="form-control" id="orgName" name='organization_name' value='{{$mission->organization_name}}'>
                </div>
                <div class="col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Mission Organisation Detail</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  name='organization_detail'>{{$mission->organization_detail}}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mission Start Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control"  name='start_date' value='{{$mission->start_date}}'/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mission End Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control"  name='end_date' />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>
                <div class="col-md-6">
                    <label for="inputType" class="form-label">Mission Type</label>
                    <select id="inputType" class="form-select"  name='mission_type'>
                        <option>Time</option>
                        <option>Goal</option>
                </select>
                </div>
                <div class="col-md-6">
                    <label for="text" class="form-label">Total Seats</label>
                    <input type="text" class="form-control" id="text" name='total_seats' value='{{$mission->total_seats}}'>
                </div>
                <div class="col-md-6">
                    <label for="missionRegDeadline" class="form-label">Mission Registration Deadline</label>
                    <input type="date" class="form-control" id="missionRegDeadline" name='registration_deadline'>
                </div>
                <div class="col-md-6">
                    <label for="inputTheme" class="form-label">Mission Theme</label>
                    <select class="form-control" id="country-dropdown" name='theme_id'>
                        <option selected>Select Theme</option>
                                  @foreach ($mission_theme as $theme)
                                      <option value="{{ $theme->mission_theme_id }}">{{ $theme->title }}</option>
                                  @endforeach
                              </select>

                </div>
                <div class="col-md-6">
                    <label for="inputSkill" class="form-label">Mission Skills</label>
                    <select id="inputSkill" class="form-select"  name='mission_skills'>
                        <option>Time</option>
                        <option>Goal</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Mission Images</label>
                        <input type="file" class="form-control" id="customFile"  name='mission_images'/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Mission Documents</label>
                    <input type="file" class="form-control" id="customFile"  name='mission_documents'/>
                </div>
                <div class="col-md-6">
                    <label for="inputAvailable" class="form-label">Mission Availability</label>
                    <select id="inputAvailable" class="form-select" name='mission_availability'>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Week-end</option>
                        <option>Monthly</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="missionVideo" class="form-label">Mission Video</label>
                    <input type="text" class="form-control" id="orgVideo" name='mission_video'>
                </div>
                <div class="col-md-6">
                    <label class="float-start px-2" for="options-outlined">Status</label>
                    <input type="radio" class="btn-check " name="status" value='1' id="success-outlined"
                    @if($mission->status==1) checked @endif>
                    <label class="btn btn-outline-success px-3"  for="success-outlined">Active</label>

                    <input type="radio" class="btn-check" value='0' name="status"  id="danger-outlined"
                    @if($mission->status==0) checked @endif>
                    <label class="btn btn-outline-danger pxv-3" for="danger-outlined">Inactive</label>
                    @error('status')
                        <div class="text-danger">
                            {{$message}}
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

        </script>

@endsection
