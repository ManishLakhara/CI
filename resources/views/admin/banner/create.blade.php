@extends('admin.app')

@section('title')
    Banner Management
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
        <input type="file" value="{{old('photo')}}" class="form-control form-control-lg" onchange="handleFileSelect(event)" id="formFileLg" name="photo">
    </div>
    <img id="preview" class="my-4" style="display: none; width:1000px;height:500px;" >
    @error('photo')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div class="my-4 row justify-content-end"> <div class="col-md-4 text-end">
        <button aria-label="reset" type="reset" class="reset-button btn mx-2 btn-outline-secondary"> Reset </button>
        <button aria-label="submit" type="submit" class="btn mx-2 btn-outline-warning" > Submit </button>
        <a aria-label="cancle" class="btn mx-2 btn-secondary" href="{{ route('banner.index') }}">Cancel</a>
        </div></div>
    </form>
    <script>
        CKEDITOR.replace('editor1');
        $('.reset-button').click(function() {
            CKEDITOR.instances['editor1'].setData('');
            $('#preview').hide();
        });
        // function handleFiles(files) {
        //     var reader = new FileReader();
        //     reader.readAsDataURL(files[0]);
        //     reader.onload = function(e) {
        //         var img = new Image();
        //         img.src = reader.result;
        //         img.onload = function() {
        //         var preview = document.getElementById('preview');
        //         preview.src = img.src;
        //         preview.style.display = 'block';
        //         }
        //     }
        // }
        $(document).ready(function(event){
            $('.reset-button').click(function() {
                CKEDITOR.instances['editor1'].setData('');
                $('#preview').hide();
            });
        });
        // function handleFiles(files) {
        //     //console.log(files);
        //     var preview = document.getElementById("preview");
        //     // for (let i = 0; i < files.length; i++) {
        //         console.log(files);
        //         var file = files;
        //         // if (recentuploadFiles.includes(file.name)) {
        //         //     continue;
        //         // }
        //         //uploadedFiles = [...uploadedFiles, file.name];
        //         // recentuploadFiles = [...recentuploadFiles, file];
        //         var reader = new FileReader();
        //         reader.onload = function(event) {
        //             var src = event.target.result;
        //             var div = document.createElement("div");
        //             div.setAttribute("style",
        //                 "position:relative; display:inline-block; margin-right:10px;margin-left:10px;");
        //             var img = document.createElement("img");
        //             img.setAttribute("src", src);
        //             img.setAttribute("style", "width: 118px;height: 118px;");
        //             div.appendChild(img);
        //             var closeIcon = document.createElement("button");
        //             closeIcon.setAttribute("class", "close_new_preview fa fa-times");
        //             closeIcon.setAttribute("type", "button");
        //             closeIcon.setAttribute("data-path", file.name);
        //             closeIcon.setAttribute("style",
        //                 "position:absolute; top:0px; right:0px; background-color:black; color:white; border-radius:10%; padding:4px; cursor:pointer;"
        //             );
        //             closeIcon.onclick = function() {
        //                 div.parentNode.removeChild(div);
        //                 // recentuploadFiles = recentuploadFiles.filter(item => item.name != file.name);

        //             };
        //             div.appendChild(closeIcon);
        //             preview.appendChild(div);
        //         };
        //         reader.readAsDataURL(file);
        //     // }
        // }
    </script>
@endsection

