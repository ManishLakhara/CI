@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Add Mission Skill </span></ul>
        <form class="py-4" action="{{ route('skill.store') }}" method="post">
            @csrf
            <label for="skill_name">Skill Name</label>
            <input type="text" class='form-control' name='skill_name' value="{{ old('skill_name') }}">
            @error('skill_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="py-4"> {{-- This is Status Radio button --}}
                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="0" @if(old('status')=="0")? selected @endif >Inactive</option>
                                    <option value="1" @if(old('status')=="1")? selected @endif >Active</option>
                                </select>
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
                <a aria-label="cancle" class="btn mx-4 btn-secondary" href="{{ route('skill.index') }}">Cancel</a>
            </div>
        </form>

    </div>
@endsection
