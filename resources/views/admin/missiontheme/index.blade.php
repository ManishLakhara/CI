@extends('admin.app')

@section('title')
    list
@endsection

@section('body')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Theme</h1>
        
        <!-- Success Alert -->  
        @include('admin.components.successAlert')

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

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>
            
            <div class="card-body">
                
                @include('admin.components.search_add',['form_action'=>'missiontheme.index','add' => 'missiontheme.create'])
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->mission_theme_id }}</td>
                        <td>{{ $d->title }}</td>
                        <td>
                            @if($d->status)
                                            <div class=" text-success">
                                                Active
                                            </div>
                                       @else
                                            <div class=" text-danger">
                                                Inactive
                                            </div>
                                       @endif
                        </td>
                        <td>
                            <form action="{{ route('missiontheme.destroy',$d->mission_theme_id) }}" method="Post">
                                <a class="btn btn-white" href="{{route('missiontheme.edit',$d->mission_theme_id)}}">
                                <img src="Images/edit.png" height="22px" width="22px" alt="edit">
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>
                                <!-- Modal -->
                                @include('admin.components.deleteModal')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                @include('admin.layouts.pagination')
            </div>
        </div>
    </div>
@endsection
