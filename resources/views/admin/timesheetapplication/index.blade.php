@extends('admin.app')


@section('title')
    Timesheet Application
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Timesheet Application </span></ul>

        @include('admin.components.successAlert')

        <div class="mt-4 mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-4">
                    <form id="search-form" action="#" method="GET">
                        @csrf
                        <label for="search" class="sr-only">
                            Search
                        </label>
                        <div class="d-flex border rounded w-100">
                            <button type="submit" class="btn">
                                <i class="fas fa-search"></i>
                            </button>
                            <div class="form-outline py-2 w-100">
                                <input type="search" id="search-input" name="s" placeholder="Search"
                                    value='{{ request()->input('s') }}' class="form-control border-0" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-responsive border-start border-end">
            <thead style="background-color: #F8F9FC">
                <tr>
                    <th class="fs-5 py-4 px-3 font-weight-light" width="300px">Mission Title</th>
                    <th class="fs-5 py-4 font-weight-light" width="300px">Mission Id</th>
                    <th class="fs-5 py-4 font-weight-light" width="300px">User Id</th>
                    <th class="fs-5 py-4 font-weight-light" width="300px">User Name</th>
                    <th class="fs-5 py-4 font-weight-light" width="300px">Time</th>
                    <th class="fs-5 py-4 font-weight-light" width="300px">Action</th>
                    <th class="fs-5 py-4 font-weight-light text-center" width="300px">Notes</th>
                    <th class="fs-5 py-4 font-weight-light" width="300px">Date Volunteered</th>
                    <th class="fs-5 py-4 font-weight-light text-center" width="300px">Manage</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Timesheets as $Timesheet)
                    <tr>
                        <td class="px-3">
                            {{ $Timesheet->mission->title }}
                        </td>
                        <td>{{ $Timesheet->mission_id }}</td>
                        <td>{{ $Timesheet->user_id }}</td>
                        <td>{{ $Timesheet->user->first_name }} {{ $Timesheet->user->last_name }}</td>
                        <td>{{ isset($Timesheet->time) ? $Timesheet->time : '-' }}</td>
                        <td>{{ isset($Timesheet->action) ? $Timesheet->action : '-' }}</td>
                        <td>{{ $Timesheet->notes }}</td>
                        <td>{{ \carbon\carbon::parse($Timesheet->date_volunteered)->format('d-m-Y') }}</td>
                        <td class="d-flex justify-content-center pe-4">

                            <span id="application_status_a_{{ $Timesheet->timesheet_id }}"
                                class="border rounded px-2 py-1 text-success border-success"
                                @if ($Timesheet->status != 'APPROVED') style="display: none;" @endif>
                                Accepted
                            </span>

                            <a id="application_a_{{ $Timesheet->timesheet_id }}"
                                @if ($Timesheet->status == 'APPROVED') style="display: none;" @endif>
                                <img src="{{ asset('Images/correct-icon.svg') }}" width="25px" height="25px"
                                    alt="">
                            </a>

                            <span id="application_status_r_{{ $Timesheet->timesheet_id }}"
                                class="border rounded px-2 py-1 text-danger border-danger"
                                @if ($Timesheet->status != 'DECLINED') style="display: none;" @endif>
                                Rejected
                            </span>
                            <a id="application_r_{{ $Timesheet->timesheet_id }}"
                                @if ($Timesheet->status == 'DECLINED') style="display: none;" @endif>
                                <img src="{{ asset('Images/cancle-icon.svg') }}" width="25px" height="25px"
                                    alt="">
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $pagination !!}
    </div>
    <script>
        $(document).ready(function() {

            $('a[id^=application_a_]').on('click', function(event) {
                event.preventDefault();
                let app_id = this.id.split('_')[2];
                $.ajax({
                    url: "{{ url('api/timesheet/approve-application') }}",
                    method: "GET",
                    data: {
                        timesheet_id: app_id,
                    },
                    success: function(result) {
                        console.log(result);
                        $('#application_a_' + app_id).hide();
                        $('#application_r_' + app_id).show();
                        $('#application_status_a_' + app_id).show();
                        $('#application_status_r_' + app_id).hide();
                    }
                })
            })
            $('a[id^=application_r_]').on('click', function(event) {
                event.preventDefault();
                let app_id = this.id.split('_')[2];
                $.ajax({
                    url: "{{ url('api/timesheet/reject-application') }}",
                    method: "GET",
                    data: {
                        timesheet_id: app_id,
                    },
                    success: function(result) {
                        console.log(result)
                        $('#application_r_' + app_id).hide();
                        $('#application_a_' + app_id).show();
                        $('#application_status_r_' + app_id).show();
                        $('#application_status_a_' + app_id).hide();
                    }
                })
            })
            var searchInput = $('#search-input');
            var searchForm = $('#search-form');


            var typingTimer;


            searchInput.on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(performSearch, 1000);
            });


            searchInput.on('keydown', function() {
                clearTimeout(typingTimer);
            });


            function performSearch() {

                var query = searchInput.val();


                if (query.trim() !== '') {
                    searchForm.submit();
                } else {

                    searchForm.attr('action', "{{ url('timesheet-application') }}").submit();
                }
            }
        })
    </script>
@endsection
