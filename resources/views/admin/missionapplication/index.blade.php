@extends('admin.app')


@section('title')
    Mission Application
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Applications</h1>

        @include('admin.components.successAlert')

        {{-- <div class="mt-4 mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-4 relative w-100">
                    <form action="#" method="GET">
                        @csrf
                        <label for="search" class="sr-only">
                            Search
                        </label>
                        <div class="d-flex border rounded w-100">
                            <button type="submit" class="btn">
                                <i class="fas fa-search"></i>
                              </button>
                            <div class="form-outline w-100">
                              <input type="search" name="s" placeholder="Search" value='{{request()->input('s')}}' class="form-control border-0" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <div class="col-sm-4 relative w-100 py-4">
            <form action="{{ url('admin-mission-application') }}" method="GET">
                @csrf
                <label for="search" class="sr-only">
                    Search
                </label>
                <div class="d-flex border rounded w-100">
                    <button type="submit" class="btn">
                        <i class="fas fa-search"></i>
                      </button>
                    <div class="form-outline w-100">
                      <input type="search" name="s" placeholder="Search" value='{{request()->input('s')}}' class="form-control border-0" />
                    </div>
                </div>
            </form>
        </div>


        <table class="table table-responsive border-start border-end">
            <thead style="background-color: #F8F9FC">
                <tr>
                    <th width="300px">Mission Title</th>
                    <th width="300px">Mission Id</th>
                    <th width="300px">User Id</th>
                    <th width="300px">User Name</th>
                    <th width="300px">Applied Date</th>
                    <th width="300px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $mt)
                    <tr>
                        <td>
                        {{$mt->mission->title}}
                        </td>
                        <td>{{$mt->mission->mission_id}}</td>
                        <td>{{$mt->user->user_id}}</td>
                        <td>{{$mt->user->first_name}} {{$mt->user->last_name}}</td>
                        <td>{{$mt->applied_at}}</td>
                        <td>
                            <div class="pt-2">
                                @if($mt->approval_status=="APPROVE")
                                    <span class="border px-2 py-1 text-success border-success" style="border-radius: 23px;">
                                        Accepted
                                    </span>
                                    @else
                                    <a id="application_a_{{$mt->mission_application_id}}">
                                        <img src="{{asset('Images/correct-icon.svg')}}" width="25px" height="25px" alt="">
                                    </a>
                                    @endif
                                <span id="application_status_a_{{$mt->mission_application_id}}"  class="border px-2 py-1 text-success border-success" style="border-radius: 23px; display: none;">
                                    Accepted
                                    </span>
                                @if($mt->approval_status=="DECLINE")
                                    <span class="border px-2 py-1 text-danger border-danger" style="border-radius: 23px;">
                                        Rejected
                                    </span>
                                @else
                                    <a id="application_r_{{$mt->mission_application_id}}">
                                        <img src="{{asset('Images/cancle-icon.svg')}}" width="25px" height="25px" alt="">
                                    </a>
                                    @endif
                                <span id="application_status_r_{{$mt->mission_application_id}}" class="border px-2 py-1 text-danger border-danger" style="border-radius: 23px; display: none;">
                                Rejected
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('admin.layouts.pagination')
    </div>
    <script>
        $(document).ready(function(){
            $('a[id^=application_a_]').on('click', function(event){
                event.preventDefault();
                let app_id=this.id.split('_')[2];
                $.ajax({
                    url: "{{url('api/approve-application')}}",
                    method: "GET",
                    data: {
                        mission_application_id: app_id,
                    },
                    success: function(result){
                        console.log(result);
                        $('#application_a_'+app_id).hide();
                        $('#application_r_'+app_id).show();
                        $('#application_status_a_'+app_id).show();
                        $('#application_status_r_'+app_id).hide();
                    }
                })
            })
            $('a[id^=application_r_]').on('click', function(event){
                event.preventDefault();
                let app_id=this.id.split('_')[2];
                $.ajax({
                    url: "{{url('api/reject-application')}}",
                    method: "GET",
                    data: {
                        mission_application_id: app_id,
                    },
                    success: function(result){
                        console.log(result)
                        $('#application_r_'+app_id).hide();
                        $('#application_a_'+app_id).show();
                        $('#application_status_r_'+app_id).show();
                        $('#application_status_a_'+app_id).hide();
                    }
                })
            })
        })
    </script>
@endsection
