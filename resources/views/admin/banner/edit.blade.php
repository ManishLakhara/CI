@extends('admin.app')

@section('title')
    Banner editor
@endsection

@section('body')
<div class="containter-fluid px-4">
    <ul class="nav border-bottom"><span class="nav-link active fs-1"> Edit Banner </span></ul>
    <form class="mt-3" action="{{route('banner.update',$banner->banner_id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <label for="inputAddress" class="form-label">Mission Description</label>
        <textarea name="text" id="editor1">{{ $banner->text }}</textarea>
        @error('text')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror

    <label for="sort_order" class="my-3 form-label">Sort Order</label>
    <input type="number" value="{{ $banner->sort_order}}" class="form-control" id="sort_order" name="sort_order">
    @error('sort_order')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div>
        <label for="formFileLg" class="my-3 form-label">Update Photo</label>
        <input type="file" value="{{$banner->image}}" class="form-control form-control-lg" id="formFileLg" name="photo">
    </div>
    @error('photo')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div class="my-4 row justify-content-end"> <div class="col-md-4 text-end">
        <button type="reset" class="btn mx-2 btn-outline-secondary"> cancle </button>
        <button type="submit" class="btn mx-2 btn-outline-warning" > Save </button>
        </div></div>
    </form>

    <h4> selected Photo</h4>
    <div class="row justify-content-center"><div class="col-md-6" style="width: '600px'; height: '900px';" id="show_photo">
        <img class="img-fluid w-100 h-100"src="{{asset('storage/'.$banner->image)}}" alt="{{$banner->image}}">
    </div></div>
</div>



<script>
    CKEDITOR.replace('editor1');
</script>

@endsection
