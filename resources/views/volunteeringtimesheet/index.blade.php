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
            <div class="col-lg-6 border mt-3">
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
                                    {{-- <td>{{ $timesheet->date_volunteered }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($timesheet->date_volunteered)->format('d-m-Y') }}</td>
                                    <td>{{ date('H', strtotime($timesheet->time)) }} h</td>
                                    <td>{{ date('i', strtotime($timesheet->time)) }} min</td>
                                    <td>

                                        @if ($timesheet->status == 'PENDING')
                                            <a class="btn btn-white">
                                                <i class="far fa-edit" style="color: orange;"></i>
                                            </a>
                                        @endif


                                        <button type="button" data-toggle="modal"
                                            data-target="#deleteModal-{{ $timesheet->timesheet_id }}" class="btn btn-white">
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


                <div class="modal fade" id="volunteerhourModal" tabindex="-1" aria-labelledby="volunteerhourModalLabel"
                    aria-hidden="true" role="dialog">
                    <div class="modal-dialog  modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none;">
                                <h5 class="modal-title" id="volunteerModalLabel">Please input below Volunteering Hours
                                </h5>

                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                                            placeholder="Enter Spent Minutes" min="0" max="59" name="minute">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="messageTextarea">Message</label>
                                        <textarea class="form-control" id="messageTextarea" rows="3" placeholder="Enter your message" name="notes"></textarea>
                                    </div>
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->user_id }}">
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

            <div class="col-lg-5 border ms-5 mt-3">
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
                                            <a class="btn btn-white">
                                                <i class="far fa-edit" style="color: orange;"></i>
                                            </a>
                                        @endif


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
                    }
                });
            });
        });
    </script>


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
                    }
                });
            });
        });
    </script>
@endsection
