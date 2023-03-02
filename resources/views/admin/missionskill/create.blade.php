@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Skill</h1>
       
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
            <li class="breadcrumb-item active">Skill</li>
        </ol>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-plus text-black"></i>
            </div>
            
            <div class="card-body">
            
                <form action="{{route('missionskill.store') }}" method="post">
                    @csrf
                    <label for="skill_name">Skill Name</label>
                    <input type="text" class='form-control' name='skill_name' value="{{old('skill_name')}}">
                    @error('skill_name')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    <div class="py-4"> {{-- This is Status Radio button--}}
                        <label class="float-start px-2" for="options-outlined">Status</label>
                        <input type="radio" class="btn-check " name="status" {{old('status')==1?'checked':''}} value='1' id="success-outlined">
                        <label class="btn btn-outline-success px-3"  for="success-outlined">Active</label>
                        <input type="radio" class="btn-check" value='0' {{old('status')==0?'checked':''}} name="status" id="danger-outlined">
                        <label class="btn btn-outline-danger px-3" for="danger-outlined">Inactive</label>

                        @error('status')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                    </div>

                <div> {{-- This is Create Button --}}
                    <button type='submit' class="btn btn-warning">
                        Create
                    </button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
@endsection
