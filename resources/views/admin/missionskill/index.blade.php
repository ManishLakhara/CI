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
        <span class="border-bottom">
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
    </span>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Skills</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">

                    <thead>
                        <tr>
                            <th>Skill Name</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Skill Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach ($data as $mt)
                                <tr>
                                    <td>{{$mt->skill_name}}</td>
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
                                        <button type="button">
                                            
                                        </button>

                                        <button type="button">
                                            <a href="missionskill/delete/{{ $mt->skill_id }}">
                                                <img src="Images/bin.png" alt="">
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
