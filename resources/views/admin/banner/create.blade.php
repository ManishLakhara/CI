@extends('admin.app')

@section('title')
    Banner Management
@endsection

@section('body')
<div class="containter-fluid px-4">
    <ul class="nav border-bottom"><span class="nav-link active fs-1"> Add Banner </span></ul>

    <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="inputAddress" class="form-label">Mission Description</label>
        <textarea name="text" id="editor1">{{ old('text') }}</textarea>
        @error('text')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror

    <label for="sort_order" class="my-3 form-label">Sort Order</label>
    <input type="number" value="{{old('sort_order')}}" class="form-control" id="sort_order" name="sort_order">
    @error('sort_order')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div>
        <label for="formFileLg" class="my-3 form-label">Photo</label>
        <input type="file" value="{{old('photo')}}" class="form-control form-control-lg" id="formFileLg" name="photo">
    </div>
    @error('photo')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div class="my-4 row justify-content-end"> <div class="col-md-4 text-end">
        <button type="reset" class="btn mx-2 btn-outline-secondary"> cancle </button>
        <button type="submit" class="btn mx-2 btn-outline-warning" > Submit </button>
        </div></div>
    </form>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection

