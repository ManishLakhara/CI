@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Edit Mission Skill </span></ul>

        <form class="py-4" action="{{ route('missionskill.update', $skill->skill_id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="skill_name">Skill Name</label>
            <input type="text" class='form-control' name='skill_name'
            @if (old('skill_name')==null)
                value='{{ $skill->skill_name }}'
            @else
                value="{{old('skill_name')}}"
            @endif>
            @error('skill_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="py-4">
                <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="0"
                            @if (old('status') == null)
                                @if ($skill->status == '0')
                                    selected
                                @endif
                            @else
                                @if (old('status') == '0') selected
                                @endif
                            @endif
                            >Inactive</option>
                        <option value="1"
                            @if (old('status')==null)
                                @if ($skill->status == '1')
                                    selected
                                @endif
                            @else
                                @if (old('status')=='1')
                                    selected
                                @endif
                            @endif
                        >Active</option>
                    </select>
                @error('status')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class='btn btn-warning'> Submit Edit</button>
            <a aria-label="cancle" class="btn mx-4 btn-secondary" href="{{ route('missionskill.index') }}">Cancel</a>
        </form>
    </div>
@endsection
