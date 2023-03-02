@extends('admin.app')

@section('title')
    User
@endsection

@section('body')

    <div class="container-fluid px-4">
        <h1 class="mt-4">User</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        
        
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
            <li class="breadcrumb-item active">User</li>
        </ol>
        @if(session('success'))
            <div class="alert">
                {{session('success')}}
            </div>
        @endif
        <a href="{{ route('user.create') }}">
        <button type="button" class="btn rounded text-right btn-outline-warning">
            <i class="fa-solid fa-plus px-3"></i> Add</button>
        </a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>
            
            <div class="card-body">
                <div class="mt-1 mb-4">    <!-- This is search bar -->
                    <div class="relative max-w-xs">
                        <form action="{{ route('user.index') }}" method="GET">
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
                {{-- <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>action</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach ($data as $mt)
                                <tr>
                                    <td>{{$mt->title}}</td>
                                    <td>
                                       @if($mt->status) 
                                            <div class="h5">
                                                <span class="badge text-white bg-success">Active</span>
                                            </div>
                                       @else
                                            <div class="h5">
                                                <span class="badge text-white bg-danger">Inactive</span>
                                            </div>
                                       @endif
                                    </td>
                                    <td>
                        <button>
            
                        </button>
                        <button type="button">
                            <a href="missiontheme/{{ $mt->mission_theme_id }}">
                            <img src="Images/bin.png" alt="">
                            </a>
                        </button>
                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table> --}}

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Employee Id</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->first_name }}</td>
                        <td>{{ $d->last_name }}</td>
                        <td>{{ $d->email }}</td>
                        <td>{{ $d->employee_id }}</td>
                        <td>{{ $d->department }}</td>
                        <td>
                            @if($d->status)
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
                            <form action="{{ route('user.destroy',$d->user_id) }}" method="Post">
                                <a class="btn btn-white" href="{{route('user.edit',$d->user_id)}}">
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