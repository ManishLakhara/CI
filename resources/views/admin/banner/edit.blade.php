@extends('admin.app')

@section('title')
    Banner editor
@endsection

@section('body')
<script>
		function handleFileSelect(evt) {
			var file = evt.target.files[0];
			var reader = new FileReader();
			reader.onload = function(e) {
				var img = new Image();
				img.src = e.target.result;
				img.onload = function() {
					var preview = document.getElementById('preview');
					preview.src = img.src;
					preview.style.display = 'block';
				}
			}
			reader.readAsDataURL(file);
		}
	</script>
<div class="containter-fluid mt-4 px-4">
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
            <input type="number" value="{{ $banner->sort_order }}" class="form-control" id="sort_order" name="sort_order">
            @error('sort_order')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <label for="formFileLg" class="my-3 form-label">Update Photo</label>
                <input type="file" value="{{ $banner->image }}" onchange="handleFileSelect(file)" class="form-control form-control-lg" id="formFileLg"
                    name="photo">
            </div>
    <img id="preview" src="{{ asset('storage/'.$banner->image) }}" class="my-4" style=" width:1000px;height:500px;" >
    @error('photo')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror


            <div class="my-4 row justify-content-end">
                <div class="col-md-4 text-end">
                    <a aria-label="cancel" class="btn mx-2 btn-secondary" href="{{ route('banner.index') }}">Cancel</a>
                    <button type="submit" class="btn mx-2 btn-outline-warning"> Save </button>
                </div>
            </div>
        </form>

    </div>



    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
