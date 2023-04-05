@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Edit Mission Skill </span></ul>

        <form class="py-4" action="{{ route('missionskill.update', $skill->skill_id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="skill_name">Skill Name</label>
            <input type="text" class='form-control' name='skill_name' value='{{ $skill->skill_name }}'>
            @error('skill_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="py-4">
                <label class="float-start px-2" for="options-outlined">Status</label>
                <input type="radio" class="btn-check " name="status" value='1' id="success-outlined"
                    @if ($skill->status == 1) checked @endif>
                <label class="btn btn-outline-success px-3" for="success-outlined">Active</label>

                <input type="radio" class="btn-check" value='0' name="status" id="danger-outlined"
                    @if ($skill->status == 0) checked @endif>
                <label class="btn btn-outline-danger px-3" for="danger-outlined">Inactive</label>
                @error('status')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class='btn btn-warning'> Submit Edit</button>
        </form>
    </div>
@endsection
