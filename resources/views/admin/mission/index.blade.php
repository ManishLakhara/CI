@extends('admin.app')

@section('title')
    Mission
@endsection

@section('body')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        <script>
        setTimeout(() => {
            $('.alert').alert('close');
        }, 3000);
        </script>
        {{-- <span class="border-bottom">
        <form action="{{route('missiontheme.create')}}" method="post">
            @csrf
            <div class='row m-3'>
            <div>
                <label for="title">Title</label><input type="text" class="form-control" name="title" id="">
                @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="container-fluid py-3">

                <label class="float-start px-2" for="options-outlined">Status</label>
                <input type="radio" class="btn-check " name="status" value='1' id="success-outlined">
                <label class="btn btn-outline-success px-3"  for="success-outlined">Active</label>
                <input type="radio" class="btn-check" value='0' name="status" id="danger-outlined">
                <label class="btn btn-outline-danger px-3" for="danger-outlined">Inactive</label>

                @error('status')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror

                <button type="submit" class="btn btn-primary float-end">Add</button>
        </form>
    </span> --}}
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Missions</li>
        </ol>
        @if(session('success'))
            <div class="alert">
                {{session('success')}}
            </div>
        @endif
        <a href="{{ route('mission.create') }}">
        <button type="button" class="btn rounded text-right btn-outline-warning">
            <i class="fa-solid fa-plus px-3"></i> Add</button>
        </a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>

            <div class="card-body">
                <div class="mt-1 mb-4">
                    <div class="relative max-w-xs">
                        <form action="{{ route('mission.index') }}" method="GET">
                            @csrf
                            <label for="search" class="sr-only">
                                Search
                            </label>
                            <input type="text" name="s"
                                class="block w-full p-3 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                placeholder="Search..." />
                        </form>
                    </div>
                </div>


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mission Title</th>
                            <th>Mission Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->mission_type }}</td>
                        <td>{{ $d->start_date }}</td>
                        <td>{{ $d->end_date }}</td>
                        <td>
                            <form action="{{ route('mission.destroy',$d->mission_id) }}" method="post">
                                <a class="btn btn-white"href="{{route('mission.edit',$d->mission_id)}}">
                                <img src="Images/edit.png" height="22px" width="22px" alt="edit">
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                <div>
                    {!! $data->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
