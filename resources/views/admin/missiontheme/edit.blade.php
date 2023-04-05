@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Edit Mission Theme </span></ul>

        <form class="py-4" action="{{ route('missiontheme.update', $missionTheme->mission_theme_id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="title">Title</label>
            <input type="text" class='form-control' name='title' value='{{ $missionTheme->title }}'>
            @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="py-4">
                <label class="float-start px-2" for="options-outlined">Status</label>
                <input type="radio" class="btn-check " name="status" value='1' id="success-outlined"
                    @if ($missionTheme->status == 1) checked @endif>
                <label class="btn btn-outline-success px-3" for="success-outlined">Active</label>

                <input type="radio" class="btn-check" value='0' name="status" id="danger-outlined"
                    @if ($missionTheme->status == 0) checked @endif>
                <label class="btn btn-outline-danger pxv-3" for="danger-outlined">Inactive</label>
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
