@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="border-bottom"><span style="text-decoration-line: underline">Mission Skill</span></h1>
        <form class="py-4" action="{{ route('missionskill.store') }}" method="post">
            @csrf
            <label for="skill_name">Skill Name</label>
            <input type="text" class='form-control' name='skill_name' value="{{ old('skill_name') }}">
            @error('skill_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="py-4"> {{-- This is Status Radio button --}}
                <label class="float-start px-2" for="options-outlined">Status</label>
                <input type="radio" class="btn-check " name="status" {{ old('status') == 1 ? 'checked' : '' }}
                    value='1' id="success-outlined">
                <label class="btn btn-outline-success px-3" for="success-outlined">Active</label>
                <input type="radio" class="btn-check" value='0' {{ old('status') == 0 ? 'checked' : '' }}
                    name="status" id="danger-outlined">
                <label class="btn btn-outline-danger px-3" for="danger-outlined">Inactive</label>

                @error('status')
                    <div class="text-danger">
                        {{ $message }}
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
@endsection
