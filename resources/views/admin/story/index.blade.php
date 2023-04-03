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

    <div class="col-sm-4 relative w-100 py-4">
        <form action="{{ route('admin-story.index') }}" method="GET">
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
                        <a  href="{{route('admin-story.show', $mt->story_id)}}"><button class="btn btn-outline border px-2 py-1" style="border-radius: 23px;">View</button></a>
                        @if($mt->status=='PUBLISHED')
                            <span class="border px-2 py-1 text-success border-success" style="border-radius: 23px;">
                                PUBLISHED
                            </span>
                        @else
                            <a  id="application_a_{{$mt->story_id}}" href="{{route('admin-story.published', $mt->story_id)}}">
                                <img src="{{asset('Images/correct-icon.svg')}}" width="25px" height="25px" alt="">
                            </a>
                        @endif
                        @if($mt->status=="DECLINED")
                            <span class="border px-2 py-1 text-danger border-danger" style="border-radius: 23px;">
                                DECLINED
                            </span>
                        @else
                            <a id="application_r_{{$mt->story_id}}" href="{{route('admin-story.declined', $mt->story_id)}}">
                                <img src="{{asset('Images/cancle-icon.svg')}}" width="25px" height="25px" alt="">
                            </a>
                        @endif

                        <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $mt->story_id }}"
                            class="btn btn-white">
                            <img src="Images/bin.png" alt="delete">
                        </button>
                        <!-- Modal -->
                        @include('admin.components.deleteModal', [
                            'id' => $mt->story_id,
                            'form_action' => 'admin-story.destroy',
                        ])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.layouts.pagination')
</div>
@endsection
