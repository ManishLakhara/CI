@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1">Add Mission Theme </span></ul>


        <form class="py-4" action="{{ route('missiontheme.store') }}" method="post">
            @csrf
            <label for="title">Title</label>
            <input type="text" class='form-control' name='title'
            value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="py-4">
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

            <div>{{-- This is Create Button to Submit this form --}}
                <button type='submit' class="btn btn-warning">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
