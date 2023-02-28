
@extends('admin.app')

@section('title')
    Mission-Theme Add mission
@endsection

@section('body')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Mission</h1>

            <form method="post" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="missionTitle" class="form-label">Mission Title</label>
                    <input type="text" class="form-control" id="missionTitle">
                </div>
                <div class="col-md-6">
                    <label for="missionDesc" class="form-label">Mission Short Description</label>
                    <input type="text" class="form-control" id="missionDesc">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Mission Description</label>
                    <textarea name="editor1"></textarea>

                     {{-- <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> --}}
                </div>
                <div class="col-md-6">
                    <label for="country-dd" class="form-label">Country</label>
                    <select  id="country-dd" class="form-control">
                        <option value="">Select Country</option>

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="country-dd" class="form-label">City</label>
                    <select id="city-dd" class="form-control">
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="orgName" class="form-label">Mission Organisation Name</label>
                    <input type="text" class="form-control" id="orgName">
                </div>
                <div class="col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Mission Organisation Detail</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mission Start Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mission End Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                    <input type='date' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>
                <div class="col-md-6">
                    <label for="inputType" class="form-label">Mission Type</label>
                    <select id="inputType" class="form-select">
                        <option>Time</option>
                        <option>Goal</option>
                </select>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Total Seats</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    <label for="missionRegDeadline" class="form-label">Mission Registration Deadline</label>
                    <input type="date" class="form-control" id="missionRegDeadline">
                </div>
                <div class="col-md-6">
                    <label for="inputTheme" class="form-label">Mission Theme</label>
                    <select id="inputTheme" class="form-select">

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputSkill" class="form-label">Mission Skills</label>
                    <select id="inputSkill" class="form-select">
                        <option>Time</option>
                        <option>Goal</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Mission Images</label>
                        <input type="file" class="form-control" id="customFile" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Mission Documents</label>
                    <input type="file" class="form-control" id="customFile" />
                </div>
                <div class="col-md-6">
                    <label for="inputAvailable" class="form-label">Mission Availability</label>
                    <select id="inputAvailable" class="form-select">
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Week-end</option>
                        <option>Monthly</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="missionVideo" class="form-label">Mission Video</label>
                    <input type="text" class="form-control" id="orgVideo">
                </div>
                <div class="col-md-6">
                    <label for="inputStatus" class="form-label">Status</label>
                    <select id="inputStatus" class="form-select">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add</button>
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
add
