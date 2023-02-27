@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Skill</h1>
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
        <form action="{{route('missionskill.new')}}" method="post">
            @csrf
            <div class='row m-3'>
            <div>       
                <label for="title">Skill Name</label><input type="text" class="form-control" name="skill_name" id="">
                @error('title')
                    <div class="text-danger">
                        {{$message}}
                    </div>   
                @enderror
            </div>
            <div class="container-fluid py-3">
               
                <label class="float-start px-2" for="options-outlined">Status</label>
                <input type="radio" class="btn-check " name="status" value='1' id="success-outlined" autocomplete="off">
                <label class="btn btn-outline-success px-3"  for="success-outlined">Active</label>
                <input type="radio" class="btn-check" value='0' name="status" id="danger-outlined" autocomplete="off">
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
        <li class="breadcrumb-item active">Skill</li>
    </ol>
    <a href="{{ route('missionskill.create') }}">
        <button type="button" class="btn rounded text-right btn-outline-warning">
            <i class="fa-solid fa-plus px-3"></i> Add</button>
    </a>

        <div class="card mb-4 ">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>
            <div class="mt-1 mb-4">
                <div class="relative max-w-xs">
                    <form action="{{ route('missionskill.index') }}" method="GET">
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
            
            <div class="card-body ">
                <table id="table table-bordered">

                    <thead>
                        <tr >
                            <th width="280px">Skill Name</th>
                            <th width="280px">Status</th>
                            <th width="280px">Action</th>
                            
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>Skill Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}

                    <tbody>
                        @foreach ($data as $mt)
                                <tr>
                                    <td>{{$mt->skill_name}}</td>
                                    <td>
                                       @if($mt->status)
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
                                        <form action="{{ route('missionskill.destroy',$mt->skill_id) }}" method="Post">
                                            <a class="btn btn-white" href="{{route('missionskill.edit',$mt->skill_id)}}">
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
                        {{-- @if ($_SERVER['REQUEST_URI']=='/missionskill') --}}
                            {!! $data->links('pagination::bootstrap-4')!!}
                        {{-- @else --}}
                            
                            {{-- {{ $data->appends($_SERVER['REQUEST_URI'])->links('pagination::bootstrap-4') }} --}}
                        {{-- @endif --}}
                        
                </div>
            </div>
        </div>
    </div>
@endsection
