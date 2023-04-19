@extends('layouts.app')
@section('title')
    share your story
@endsection


@section('content')
    <form id="story-form" action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container mt-5">
            <h2>Share Your Story</h2>
            <div id="story-error" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div class="row">
                <div class="col-lg-4">

                    <label for="missionSelect" class="form-label">Mission</label>
                    <select class="form-control" id="missionSelect" name="mission_id">
                        <option value="" disabled selected>Select Mission</option>
                        @foreach ($appliedMissions as $mission)
                            <option value="{{ $mission->mission_id }}">{{ $mission->title }}</option>
                        @endforeach
                    </select>
                    @error('mission_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label for="title" class="form-label">My Story Title</label>
                    <input type="text" class="form-control" id="title" name='title' placeholder="Enter your title"
                        value="{{ old('title') }}" placeholder="Enter story title">
                    @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label for="inputdate" class="form-label">Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='datetime-local' class="form-control" id='published_at' name='published_at'
                            value="{{ old('published_at') }}" placeholder="Select date">
                    </div>
                    @error('published_at')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="summary-ckeditor" class="form-label">My Story</label>
                    <textarea name="description" class="story-textarea" id="editor1">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="missionVideo" class="form-label">Enter Video URL</label>
                    <textarea class="form-control" id="orgVideo" name="path" placeholder="Enter your url"></textarea>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="orgVideo" class="form-label">Enter Video URL</label>
                    <textarea class="form-control" id="path" name="path[]" placeholder="Enter your url"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="UploadYourPhotos" class="form-label">Upload your Photos</label>
                    <div id="drop-zone" style="border: 2px dashed #d8d7d7; padding: 20px; text-align: center;"
                        ondragover="event.preventDefault(); document.getElementById('drop-zone').classList.add('dragover');"
                        ondragleave="document.getElementById('drop-zone').classList.remove('dragover');"
                        ondrop="event.preventDefault(); document.getElementById('drop-zone').classList.remove('dragover'); handleDrop(event);">
                        <i class="fas fa-plus" style="font-size: 40px;"></i>
                        <div style="margin-top: 20px;">Drag and Drop Pictures Here</div>
                    </div>
                    <input type="file" id="file-input" name="photos[]" onchange="handleFiles(this.files);" multiple
                        hidden />
                    <div id="preview"></div>
                </div>
            </div>


            <div class="row">

                <div class=" mt-4">
                    <button type="button" class="btn px-4  btn-outline-secondary  rounded-pill float-start">Cancel</button>
                    <button type="submit" class="btn px-3 btn-outline-warning ms-3 rounded-pill float-end"
                        id="submit-button" disabled>
                        Submit</button>
                    <button type="button" id="story_save"
                        class="btn px-4 btn-outline-warning rounded-pill float-end">Save</button>
                </div>
            </div>

        </div>
    </form>



    <script>
        CKEDITOR.replace('editor1');
    </script>




    <script>

        //var uploadedFiles = [];
        var recentuploadFiles = [];
        function handleFiles(files) {
            //console.log(files);
            var preview = document.getElementById("preview");
            for (let i = 0; i < files.length; i++) {
                console.log(files[i]);
                let file = files[i];
                if (recentuploadFiles.includes(file.name)) {
                    continue;
                }
                //uploadedFiles = [...uploadedFiles, file.name];
                recentuploadFiles = [...recentuploadFiles, file];
                var reader = new FileReader();
                reader.onload = function(event) {
                    var src = event.target.result;
                    var div = document.createElement("div");
                    div.setAttribute("style",
                        "position:relative; display:inline-block; margin-right:10px;margin-left:10px;");
                    var img = document.createElement("img");
                    img.setAttribute("src", src);
                    img.setAttribute("style", "width: 118px;height: 118px;");
                    div.appendChild(img);
                    var closeIcon = document.createElement("button");
                    closeIcon.setAttribute("class", "close_new_preview fa fa-times");
                    closeIcon.setAttribute("type", "button");
                    closeIcon.setAttribute("data-path", file.name);
                    closeIcon.setAttribute("style",
                        "position:absolute; top:0px; right:0px; background-color:black; color:white; border-radius:10%; padding:4px; cursor:pointer;"
                    );
                    closeIcon.onclick = function() {
                        div.parentNode.removeChild(div);
                        recentuploadFiles = recentuploadFiles.filter(item => item.name != file.name);

                    };
                    div.appendChild(closeIcon);
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        }

        function handleDrop(event) {
            var files = event.dataTransfer.files;
            handleFiles(files);
        }

        document.getElementById("drop-zone").addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById("file-input").click();
        });

        $(document).ready(function(event) {
            $('#story_save').on('click', function(event) {

                event.preventDefault();

                var value = CKEDITOR.instances['editor1'].getData();

                // Get the selected files
                var files = document.getElementById("file-input").files;

                // Create a new FormData object
                var formData = new FormData();

                // Append the uploaded files to the FormData object
                for (var i = 0; i < recentuploadFiles.length; i++) {
                    formData.append('photos[]', recentuploadFiles[i], recentuploadFiles[i].name);
                }

                // Append other form data to the FormData object
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('mission_id', $('#missionSelect').val());
                formData.append('title', $('#title').val());
                formData.append('published_at', $('#published_at').val());
                formData.append('description', value);

                // Split the path input by new lines
                var path = $('#path').val().split('\n');

                for (var i = 0; i < path.length; i++) {
                    if(path[i].length!=0){
                        formData.append('path[]', path[i]);
                    }
                }

                $.ajax({
                    type: 'post',
                    url: '{{ route('stories.store') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(id) {
                        alert("Saved to Draft");
                        var link = document.createElement('a');
                        link.href = "{{ route('mystories.edit',':id') }}".replace(':id',id);
                        link.click();
                    },
                    error: function(response) {
                    var errors = response.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += '<p>' + value + '</p>';
                    });
                    $('#story-error').html(errorHtml).show();
                },
                })
            })
        })
    </script>
@endsection
