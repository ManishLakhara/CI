@extends('admin.app')

@section('title')
    Banner Management
@endsection

@section('body')
<div class="containter-fluid mt-4 px-4">
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
    <input type="number" min="1" value="{{old('sort_order')}}" class="form-control" id="sort_order" name="sort_order">
    @error('sort_order')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div>
        <label for="formFileLg" class="my-3 form-label">Photo</label>
        <input type="file" value="{{old('photo')}}" class="form-control form-control-lg" onchange="handleFiles(this.files);" id="formFileLg" name="photo">
    </div>
    @error('photo')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div class="my-4 row justify-content-end"> <div class="col-md-4 text-end">
        <button aria-label="reset" type="reset" class="reset-button btn mx-2 btn-outline-secondary"> Reset </button>
        <button aria-label="submit" type="submit" class="btn mx-2 btn-outline-warning" > Submit </button>
        <a aria-label="cancle" class="btn mx-2 btn-secondary" href="{{ route('banner.index') }}">Cancle</a>
        </div></div>
    </form>

    <script>
        CKEDITOR.replace('editor1');
        $('.reset-button').click(function() {
            CKEDITOR.instances['editor1'].setData('');
        });
    </script>
@endsection

