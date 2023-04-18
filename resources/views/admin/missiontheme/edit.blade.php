@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Edit Mission Theme </span></ul>

        <form class="py-4" action="{{ route('missiontheme.update', $missionTheme->mission_theme_id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="title">Title</label>
            <input type="text" class='form-control' name='title'
            @if (old('title') == null)
                value="{{ $missionTheme->title }}"
            @else
                value="{{ old('title') }}"
            @endif>
            @error('title')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
                <div class="py-4">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="0"
                    @if (old('status') == null)
                        @if ($missionTheme->status == '0')
                            selected
                        @endif
                    @else
                        @if (old('status') == '0') selected
                        @endif
                    @endif
                    >Inactive</option>
                <option value="1"
                    @if (old('status')==null)
                        @if ($missionTheme->status == '1')
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
    </form>
    </div>
@endsection
