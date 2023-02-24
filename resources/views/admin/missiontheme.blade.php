@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Theme</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <span class="border-bottom">
        <form action="{{route('missiontheme.new')}}" method="post">
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
            <li class="breadcrumb-item active">Missions</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">

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
                                    <td><img src="" alt=""></td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
