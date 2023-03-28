@extends('layouts.app')

@section('title')
    volunteering timesheet
@endsection

@section('content')
    <div class="container mt-5 pt-5">
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
                                <th>Mission</th>
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

                                        <a class="btn btn-white">
                                            <i class="far fa-edit" style="color: orange;"></i>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                            data-target="#deleteModal-{{ $timesheet->story_media_id }}"
                                            class="btn btn-white">
                                            <img src="Images/bin.png" alt="delete">
                                        </button>
                                        @include('admin.components.deleteModal', [
                                            // 'id' => $timesheet->timesheet_id,
                                            'id' => $timesheet->story_media_id,
                                            'form_action' => 'timesheet.destroy',
                                        ])

                                        {{-- <button type="button" class="btn btn-white">
                                            <img src="Images/bin.png" alt="delete">
                                        </button> --}}
                                        {{-- <form action="{{ route('timesheet.destroy', $timesheet->story_media_id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white"> <img src="Images/bin.png"
                                                    alt="delete"></button>
                                        </form> --}}
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
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="border:none;background:none">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="missionSelect">Mission</label>
                                        <select class="form-control" id="missionSelect">
                                            <option>Option 1</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="dateVolunteered">Date Volunteered</label>
                                        <input type="date" class="form-control" id="dateVolunteered">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="hoursVolunteered">Hours</label>
                                        <input type="number" class="form-control" id="hoursVolunteered"
                                            placeholder="Enter Spent Hours">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="minutesVolunteered">Minutes</label>
                                        <input type="number" class="form-control" id="minutesVolunteered"
                                            placeholder="Enter Spent Minutes" max="60">
                                    </div>
                                    <div class="form-group  mt-3">
                                        <label for="messageTextarea">Message</label>
                                        <textarea class="form-control" id="messageTextarea" rows="3" placeholder="Enter your message"></textarea>
                                    </div>

                                    <div class="container">
                                        <div class=" d-flex mt-3 justify-content-end">
                                            <button type="button" class="btn px-4 btn-outline-secondary rounded-pill"
                                                data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                                            <button type="submit" class="btn px-4 btn-outline-warning rounded-pill">
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
                    <span>Volunteering Goal</span>
                    <button type="button" class="btn  btn-outline-warning float-end me-3 mb-3 rounded-pill"
                        data-toggle="modal" data-target="#volunteergoalModal"><i class="fas fa-plus"></i>
                        Add
                    </button>
                </div>

                {{-- <table class="table table-borderless table-responsive">
                    <thead>
                        <tr>
                            <th>Mission</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Environment</td>
                            <td>23-02-2013</td>
                            <td>13</td>

                            <td>

                                <a class="btn btn-white">
                                    <i class="far fa-edit" style="color: orange;"></i>
                                </a>
                                <button type="button" class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>


                            </td>




                        </tr> --}}
                {{-- @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->title }}</td>
                                <td>
                                    @if ($d->status)
                                        <div class="h5 text-success">
                                            Active
                                        </div>
                                    @else
                                        <div class="h5 text-danger">
                                            Inactive
                                        </div>
                                    @endif
                                </td>
                                <td>

                                    <a class="btn btn-white" href="{{ route('cmspage.edit', $d->cms_page_id) }}">
                                        <img src="Images/edit.png" height="22px" width="22px" alt="edit">
                                    </a>
                                    <button type="button" data-toggle="modal"
                                        data-target="#deleteModal-{{ $d->cms_page_id }}" class="btn btn-white">
                                        <img src="Images/bin.png" alt="delete">
                                    </button>
                                    @include('admin.components.deleteModal', [
                                        'id' => $d->cms_page_id,
                                        'form_action' => 'cmspage.destroy',
                                    ])
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                {{-- </tbody>
                </table> --}}


                <table class="table table-borderless table-responsive">
                    @if ($timesheets->where('mission.mission_type', 'GOAL')->count() > 0)
                        <thead>
                            <tr>
                                <th>Mission</th>
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

                                        <a class="btn btn-white">
                                            <i class="far fa-edit" style="color: orange;"></i>
                                        </a>
                                        <button type="button" class="btn btn-white">
                                            <img src="Images/bin.png" alt="delete">
                                        </button>


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
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="border:none;background:none">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="missionDropdown">Mission</label>
                                        <select class="form-control" id="missionDropdown">
                                            <option>Option 1</option>
                                            <option>Option 2</option>
                                            <option>Option 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="action">Action</label>
                                        <input type="text" class="form-control" id="action"
                                            placeholder="Enter Actions">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="dateVolunteered">Date Volunteered</label>
                                        <input type="date" class="form-control" id="dateVolunteered">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="Enter your message"></textarea>
                                    </div>

                                    <div class="container">
                                        <div class=" d-flex mt-3 justify-content-end">
                                            <button type="button" class="btn px-4 btn-outline-secondary rounded-pill"
                                                data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                                            <button type="submit" class="btn px-4 btn-outline-warning rounded-pill">
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
@endsection
