@extends('admin.app')


@section('title')
    Story
@endsection

@section('body')
<div class="container-fluid px-4">
    <h1 class="mt-4">
        Story
    </h1>
    @include('admin.components.successAlert')

    <table class="table table-responsive border-start border-end">
        <thead style="background-color: #F8F9FC">
            <tr>
                <th width="500px">Story Title</th>
                <th width="500px">Mission Title</th>
                <th width="500px">User Full Name</th>
                <th width="300px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $mt)
                <tr>
                    <td>
                        {{$mt->title}}
                    </td>
                    <td>
                        {{$mt->mission->title}}
                    </td>
                    <td>
                        {{$mt->user->first_name}} {{$mt->user->last_name}}
                    </td>
                    <td>
                        <a id="application_a_{{$mt->story_id}}">
                            <img src="{{asset('Images/correct-icon.svg')}}" width="25px" height="25px" alt="">
                        </a>
                        <a id="application_r_{{$mt->story_id}}">
                            <img src="{{asset('Images/cancle-icon.svg')}}" width="25px" height="25px" alt="">
                        </a>
                        <a class="btn btn-white"href="{{ route('admin-story.edit', $mt->story_id) }}">
                            {{-- <img src="Images/edit.png" height="22px" width="22px" alt="edit"> --}}
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.layouts.pagination')
</div>
@endsection
