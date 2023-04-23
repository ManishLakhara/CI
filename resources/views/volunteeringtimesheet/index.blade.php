@extends('layouts.app')

@section('title')
    volunteering timesheet
@endsection

@section('content')
    <div class="container mt-5 pt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h2>Volunteering Timesheet</h2>

        <div class="row">
            <div class="col-lg-5 border mt-3 col-sm-10 ms-sm-5">
                <div class="mt-4">
                    <span>Volunteering Hours</span>
                    <button type="button" class="btn btn-outline-warning float-end me-3 mb-3 rounded-pill" data-toggle="modal"
                        data-target="#volunteerhourModal"><i class="fas fa-plus"></i>
                        Add
                    </button>

                </div>

                <table class="table table-borderless table-responsive">
                    @if ($timesheets->where('mission.mission_type', 'TIME')->count() > 0)
                        <thead>
                            <tr>
                                <th class="col-lg-4">Mission</th>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Minutes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timesheets->where('mission.mission_type', 'TIME') as $timesheet)
                                <tr>
                                    <td>{{ $timesheet->mission->title }}</td>
                                    <td>{{ date('d-m-Y', strtotime($timesheet->date_volunteered)) }}</td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($timesheet->date_volunteered)->format('d-m-Y') }}</td> --}}
                                    <td>{{ date('H', strtotime($timesheet->time)) }} h</td>
                                    <td>{{ date('i', strtotime($timesheet->time)) }} min</td>
                                    <td>

                                        {{-- @if ($timesheet->status == 'PENDING')
                                            <a class="btn btn-white" data-toggle="modal"
                                                data-target="#editVolunteerHourModal-{{ $timesheet->timesheet_id }}">
                                                <i class="far fa-edit" style="color: orange;"></i>
                                            </a>
                                        @endif --}}
                                        @if ($timesheet->status == 'PENDING')
                                            <a class="btn btn-white" data-toggle="modal"
                                                data-target="#editVolunteerHourModal-{{ $timesheet->timesheet_id }}"
                                                data-timesheet-id="{{ $timesheet->timesheet_id }}">
                                                <i class="far fa-edit" style="color: orange;"></i>
                                            </a>
                                        @endif

                                        {{-- modal for editing the volunteer hour --}}



                                        <div class="modal fade" id="editVolunteerHourModal-{{ $timesheet->timesheet_id }}"
                                            tabindex="-1" aria-labelledby="volunteerhourModalLabel" aria-hidden="true"
                                            role="dialog">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="border-bottom: none;">
                                                        <h5 class="modal-title" id="volunteerModalLabel">Please input below
                                                            Volunteering Hours</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editTimeTimesheetForm-{{ $timesheet->timesheet_id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="missionSelect">Mission</label>
                                                                <select class="form-control" id="missionSelect"
                                                                    name="mission_id">
                                                                    <option value="" disabled>Select Mission</option>
                                                                    @foreach ($timemissions as $mission)
                                                                        <option value="{{ $mission->mission_id }}"
                                                                            {{ $mission->mission_id == $timesheet->mission_id ? 'selected' : '' }}>
                                                                            {{ $mission->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group  mt-3">
                                                                <label for="dateVolunteered">Date Volunteered</label>
                                                                <input type="date" class="form-control"
                                                                    id="dateVolunteered" name="date_volunteered"
                                                                    value="{{ \Carbon\Carbon::parse($timesheet->date_volunteered)->format('Y-m-d') }}">
                                                            </div>
                                                            <div class="form-group  mt-3">
                                                                <label for="hoursVolunteered">Hours</label>
                                                                <input type="number" class="form-control"
                                                                    id="hoursVolunteered" placeholder="Enter Spent Hours"
                                                                    min="0" name="hour"
                                                                    value="{{ date('H', strtotime($timesheet->time)) }}">
                                                            </div>
                                                            <div class="form-group  mt-3">
                                                                <label for="minutesVolunteered">Minutes</label>
                                                                <input type="number" class="form-control"
                                                                    id="minutesVolunteered"
                                                                    placeholder="Enter Spent Minutes" min="0"
                                                                    max="59" name="minute"
                                                                    value="{{ date('i', strtotime($timesheet->time)) }}">
                                                            </div>
                                                            <div class="form-group  mt-3">
                                                                <label for="messageTextarea">Message</label>
                                                                <textarea class="form-control" id="messageTextarea" rows="3" placeholder="Enter your message" name="notes">{{ $timesheet->notes }}</textarea>
                                                            </div>
                                                            <input type="hidden" id="user_id" name="user_id"
                                                                value="{{ Auth::user()->user_id }}">
                                                            <div id="edittimeentry-error-{{ $timesheet->timesheet_id }}"
                                                                class="alert alert-danger" role="alert"
                                                                style="display: none;"></div>
                                                            <div class="container">
                                                                <div class=" d-flex mt-3 justify-content-end">
                                                                    <button type="button"
                                                                        class="btn px-4 btn-outline-secondary rounded-pill"
                                                                        data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                                                                    <button type="button"
                                                                        class="btn px-4 btn-outline-warning rounded-pill edit-timesheet-btn"
                                                                        data-timesheet-id="{{ $timesheet->timesheet_id }}">Submit
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                        <button type="button" data-toggle="modal"
                                            data-target="#deleteModal-{{ $timesheet->timesheet_id }}"
                                            class="btn btn-white">
                                            <img src="Images/bin.png" alt="delete">
                                        </button>
                                        @include('admin.components.deleteModal', [
                                            'id' => $timesheet->timesheet_id,

                                            'form_action' => 'timesheet.destroy',
                                        ])


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>

                {{-- modal for adding the volunteer hours --}}
                <div class="modal fade" id="volunteerhourModal" tabindex="-1" aria-labelledby="volunteerhourModalLabel"
                    aria-hidden="true" role="dialog">
                    <div class="modal-dialog  modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none;">
                                <h5 class="modal-title" id="volunteerModalLabel">Please input below Volunteering Hours
                                </h5>

                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="timesheetForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="missionSelect">Mission</label>
                                        <select class="form-control" id="missionSelect" name="mission_id">
                                            <option value="" disabled selected>Select Mission</option>
                                            @foreach ($timemissions as $mission)
                                                <option value="{{ $mission->mission_id }}">{{ $mission->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group  mt-3">
                                        <label for="dateVolunteered">Date Volunteered</label>
                                        <input type="date" class="form-control" id="dateVolunteered"
                                            name="date_volunteered">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="hoursVolunteered">Hours</label>
                                        <input type="number" class="form-control" id="hoursVolunteered"
                                            placeholder="Enter Spent Hours" min="0" name="hour">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="minutesVolunteered">Minutes</label>
                                        <input type="number" class="form-control" id="minutesVolunteered"
                                            placeholder="Enter Spent Minutes" min="0" max="59"
                                            name="minute">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="messageTextarea">Message</label>
                                        <textarea class="form-control" id="messageTextarea" rows="3" placeholder="Enter your message" name="notes"></textarea>
                                    </div>
                                    <input type="hidden" id="user_id" name="user_id"
                                        value="{{ Auth::user()->user_id }}">
                                    <div id="timeentry-error" class="alert alert-danger" role="alert"
                                        style="display: none;"></div>
                                    <div class="container">
                                        <div class=" d-flex mt-3 justify-content-end">
                                            <button type="button" class="btn px-4 btn-outline-secondary rounded-pill"
                                                data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                                            <button type="button" id="submitTimesheetBtn"
                                                class="btn px-4 btn-outline-warning rounded-pill">
                                                Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-5 border ms-lg-5 mt-3 col-sm-10 ms-sm-5">
                <div class="mt-4">
                    <span>Volunteering Goals</span>
                    <button type="button" class="btn  btn-outline-warning float-end me-3 mb-3 rounded-pill"
                        data-toggle="modal" data-target="#volunteergoalModal"><i class="fas fa-plus"></i>
                        Add
                    </button>
                </div>


                <table class="table table-borderless table-responsive">
                    @if ($timesheets->where('mission.mission_type', 'GOAL')->count() > 0)
                        <thead>
                            <tr>
                                <th class="col-lg-4">Mission</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($timesheets->where('mission.mission_type', 'GOAL') as $timesheet)
                                <tr>
                                    <td>{{ $timesheet->mission->title }}</td>
                                    {{-- <td>{{ $timesheet->date_volunteered) }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($timesheet->date_volunteered)->format('d-m-Y') }}</td>

                                    <td>{{ $timesheet->action }}</td>

                                    <td>

                                        @if ($timesheet->status == 'PENDING')
                                            <a class="btn btn-white" data-toggle="modal"
                                                data-target="#editVolunteerGoalModal-{{ $timesheet->timesheet_id }}"
                                                data-timesheet-id="{{ $timesheet->timesheet_id }}">
                                                <i class="far fa-edit" style="color: orange;"></i>
                                            </a>
                                        @endif





                                        {{-- modal for editing the volunteer goal --}}

                                        <div class="modal fade"
                                            id="editVolunteerGoalModal-{{ $timesheet->timesheet_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="volunteerModalLabel" aria-hidden="true">
                                            <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="border-bottom: none;">
                                                        <h5 class="modal-title" id="volunteerModalLabel">Please input
                                                            below Volunteering Goal</h5>

                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editGoalTimesheetForm-{{ $timesheet->timesheet_id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="missionSelect">Mission</label>
                                                                <select class="form-control" id="missionSelect"
                                                                    name="mission_id">
                                                                    <option value="" disabled>Select Mission</option>
                                                                    @foreach ($goalmissions as $mission)
                                                                        <option value="{{ $mission->mission_id }}"
                                                                            {{ $mission->mission_id == $timesheet->mission_id ? 'selected' : '' }}>
                                                                            {{ $mission->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="action">Action</label>
                                                                <input type="text" class="form-control" id="action"
                                                                    placeholder="Enter Actions" name="action"
                                                                    value="{{ $timesheet->action }}">
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="dateVolunteered">Date Volunteered</label>
                                                                <input type="date" class="form-control"
                                                                    id="dateVolunteered" name="date_volunteered"
                                                                    value="{{ \carbon\carbon::parse($timesheet->date_volunteered)->format('Y-m-d') }}">
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="message">Message</label>
                                                                <textarea class="form-control" id="message" rows="3" placeholder="Enter your message" name="notes">{{ $timesheet->notes }}</textarea>
                                                            </div>
                                                            <div id="editgoalentry-error-{{ $timesheet->timesheet_id }}"
                                                                class="alert alert-danger" role="alert"
                                                                style="display: none;"></div>
                                                            <div class="container">
                                                                <div class=" d-flex mt-3 justify-content-end">
                                                                    <button type="button"
                                                                        class="btn px-4 btn-outline-secondary rounded-pill"
                                                                        data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                                                                    <button type="button"
                                                                        data-timesheet-id="{{ $timesheet->timesheet_id }}"
                                                                        class="btn px-4 btn-outline-warning rounded-pill edit-goal-timesheet-btn">
                                                                        Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>










                                        <button type="button" data-toggle="modal"
                                            data-target="#deleteModal-{{ $timesheet->timesheet_id }}"
                                            class="btn btn-white">
                                            <img src="Images/bin.png" alt="delete">
                                        </button>
                                        @include('admin.components.deleteModal', [
                                            'id' => $timesheet->timesheet_id,

                                            'form_action' => 'timesheet.destroy',
                                        ])

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>

                {{-- modal for adding the volunteer goal --}}
                <div class="modal fade" id="volunteergoalModal" tabindex="-1" role="dialog"
                    aria-labelledby="volunteerModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none;">
                                <h5 class="modal-title" id="volunteerModalLabel">Please input below Volunteering Goal</h5>

                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="goaltimesheetForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="missionSelect">Mission</label>
                                        <select class="form-control" id="missionSelect" name="mission_id">
                                            <option value="" disabled selected>Select Mission</option>
                                            @foreach ($goalmissions as $mission)
                                                <option value="{{ $mission->mission_id }}">{{ $mission->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="action">Action</label>
                                        <input type="text" class="form-control" id="action"
                                            placeholder="Enter Actions" name="action">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="dateVolunteered">Date Volunteered</label>
                                        <input type="date" class="form-control" id="dateVolunteered"
                                            name="date_volunteered">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="Enter your message" name="notes"></textarea>
                                    </div>
                                    <div id="goalentry-error" class="alert alert-danger" role="alert"
                                        style="display: none;"></div>
                                    <div class="container">
                                        <div class=" d-flex mt-3 justify-content-end">
                                            <button type="button" class="btn px-4 btn-outline-secondary rounded-pill"
                                                data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                                            <button type="button" id="submitgoalTimesheetBtn"
                                                class="btn px-4 btn-outline-warning rounded-pill">
                                                Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>





            </div>

        </div>
    </div>

    {{-- script for adding the volunteer hour --}}
    <script>
        $(document).ready(function() {
            $('#submitTimesheetBtn').click(function() {
                $.ajax({
                    url: "{{ route('timesheet.store') }}",
                    type: "POST",
                    data: $('#timesheetForm').serialize(),
                    dataType: "json",
                    success: function(response) {
                        alert('volunteering hours added successfully');
                        $('#volunteerhourModal').modal('hide');
                        location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });
                        $('#timeentry-error').html(errorHtml).show();
                    },
                });
            });
        });
    </script>

    {{-- script for adding the volunteering goal --}}

    <script>
        $(document).ready(function() {
            $('#submitgoalTimesheetBtn').click(function() {
                $.ajax({
                    url: "{{ route('timesheet.store') }}",
                    type: "POST",
                    data: $('#goaltimesheetForm').serialize(),
                    dataType: "json",
                    success: function(response) {
                        alert('volunteering goal added successfully');
                        $('#volunteerhourModal').modal('hide');
                        location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });
                        $('#goalentry-error').html(errorHtml).show();
                    },
                });
            });
        });
    </script>

    {{-- script for editing the volunteering hour --}}
    <script>
        $(document).ready(function() {
            $('.edit-timesheet-btn').click(function() {

                var timesheetId = $(this).data('timesheet-id');
                var formId = 'editTimeTimesheetForm-' + timesheetId;
                console.log();
                $.ajax({
                    url: "{{ route('timesheet.update', ':id') }}".replace(':id', timesheetId),
                    type: "PUT",
                    data: $('#' + formId).serialize(),
                    dataType: "json",
                    success: function(response) {
                        alert('volunteering hours updated successfully');
                        $('#editVolunteerHourModal-' + timesheetId).modal('hide');
                        location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });
                        $('#edittimeentry-error-' + timesheetId).html(errorHtml).show();


                    },
                });
            });
        });
    </script>

    {{-- script for editing the volunteering goal --}}

    <script>
        $(document).ready(function() {
            $('.edit-goal-timesheet-btn').click(function() {

                var timesheetId = $(this).data('timesheet-id');
                var formId = 'editGoalTimesheetForm-' + timesheetId;
                console.log();
                $.ajax({
                    url: "{{ route('timesheet.update', ':id') }}".replace(':id', timesheetId),
                    type: "PUT",
                    data: $('#' + formId).serialize(),
                    dataType: "json",
                    success: function(response) {
                        alert('volunteering goals updated successfully');
                        $('#editVolunteerGoalModal-' + timesheetId).modal('hide');
                        location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });
                        $('#editgoalentry-error-' + timesheetId).html(errorHtml).show();


                    },
                });
            });
        });
    </script>


@endsection
