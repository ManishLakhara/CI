@extends('layouts.app')
@section('title')
    share your story
@endsection


@section('content')
    <form id="story-form" action="{{ route('mystories.update', $story->story_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container mt-5">
            <h2>Share Your Story</h2>
            <div id="story-error" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div class="row">
                <div class="col-lg-4">

                    <label for="missionSelect" class="form-label">Mission</label>
                    <select class="form-control" id="missionSelect" name="mission_id">
                        <option value="" disabled selected>Select Mission</option>
                        @foreach ($appliedMissions as $mission)
                            <option value="{{ $mission->mission_id }}" @if ($mission->mission_id == $story->mission_id) selected @endif>
                                {{ $mission->title }}</option>
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
                        placeholder="Enter story title" value="{{ $story->title }}">
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
                            placeholder="Select date" value="{{ date('Y-m-d\TH:i:s', strtotime($story->published_at)) }}">
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
                    <textarea name="description" class="story-textarea" id="editor1">{{ $story->description }}</textarea>
                </div>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="orgVideo" class="form-label">Enter Video URL</label>
                    <textarea class="form-control" id="path" name="path[]" placeholder="Enter your url">
                        @foreach ($storyvideoMedia as $videomedia){{ $videomedia->path }}&#13;&#10;@endforeach
                    </textarea>
                    @error('path.*')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- @foreach ($storyvideoMedia as $videomedia)
                <div class="theme-color border p-2 m-2 from_untill">
                    {{ $videomedia->path }} <button type="button" data-story_media_id="{{ $videomedia->story_media_id }}" class="story_media btn btn-white"><i class="fa fa-times"></i></button>
                </div>
                @endforeach --}}
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
                    @error('photos.*')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="preview" data-prev_file="{{ $storyimageMedia->count() }}">
                        @foreach ($storyimageMedia as $imagemedia)
                            <div style="position:relative; display:inline-block; margin-right:10px;margin-left:10px;">
                                <img src="{{ asset('storage/' . $imagemedia->path) }}" alt="" width="118px"
                                    height="118px">
                                {{-- <i class="fa fa-times" style="position:absolute; top:0px; right:0px; background-color:black; color:white; border-radius:10%; padding:4px; cursor:pointer;"
                                       onclick="removeImage('{{ $imagemedia->path }}')"></i> --}}
                                <button type="button" class="close_preview_img"
                                    data-story_media_id="{{ $imagemedia->story_media_id }}"
                                    style="position:absolute; top:0px; right:0px; background-color:black; color:white; border-radius:10%; padding:4px; cursor:pointer;"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="row">

                <div class=" mt-4">
                    <a aria-label="cancel" type="button" class="btn px-4  btn-outline-secondary  rounded-pill float-start"
                        href="{{ route('mystories.index') }}">Cancel</a>
                    <button aria-label="submit" type="submit" class="btn px-3 btn-outline-warning ms-3 rounded-pill float-end"
                        id="submit-button">
                        Submit</button>

                    <button type="button" id="edit_story_save" data-story_id={{ $story->story_id }}
                        class="btn px-4 btn-outline-warning rounded-pill float-end">Save</button>

                </div>
            </div>

        </div>
    </form>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        var uploadedFiles = [
            @foreach ($storyimageMedia as $imagemedia)
                '{{ $imagemedia->path }}',
            @endforeach
        ];
        var deleteFiles = [];
        var recentuploadFiles = [];

        // function removeImage(path) {
        // var imageDiv = event.target.parentNode;
        // imageDiv.parentNode.removeChild(imageDiv);
        // // console.log(path);
        // //Remove the image from the uploadedFiles array
        // // var index = uploadedFiles.indexOf(path);
        // // if (index !== -1) {
        // //     uploadedFiles.splice(index, 1);
        // // }
        // uploadedFiles = uploadedFiles.filter(item => item != path);
        // console.log(uploadedFiles);
        // }
        function handleFiles(files) {
            console.log(files);
            var preview = document.getElementById("preview");
            for (let i = 0; i < files.length; i++) {
                console.log(files[i]);
                let file = files[i];
                if (uploadedFiles.includes('storage/story_media/' + file.name)) {
                    continue;
                }
                uploadedFiles = [...uploadedFiles, file.name];
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

        // function close_new_preview() {
        //     $('button[class="close_new_preview"]').on('click', function() {
        //         $(this).parent().remove();
        //         recentuploadFiles = recentuploadFiles.filter(item => item.name != $(this).data('path'));
        //     })
        // }
        $(document).ready(function() {
            $('#submit-button').on('click', function() {
                for (var i = 0; i < recentuploadFiles.length; i++) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'photos[]',
                    }).prop('files', recentuploadFiles[i]).appendTo('form');
                }
                $('<input>').attr({
                        type: 'hidden',
                        name: 'removedPhotos',
                        value: deleteFiles,
                    }).appendTo('form');
                });


            $('#edit_story_save').on('click', function(event) {
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
                formData.append('removedPhotos', deleteFiles);

                // Append other form data to the FormData object
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('mission_id', $('#missionSelect').val());
                formData.append('title', $('#title').val());
                formData.append('published_at', $('#published_at').val());
                formData.append('description', value);
                // Split the path input by new lines
                var path = $('#path').val().split('\n');
                let count = 0;
                let total_image = $('#preview').data('prev_file')+recentuploadFiles.length-deleteFiles.length;
                console.log(total_image);
                for (var i = 0; i < path.length; i++) {
                    if (path[i].trim().length !== 0) {
                        formData.append('path[]', path[i]);
                        count++;
                    }
                }
                if(total_image>20){
                    alert("can't have more than 20 images");
                }
                else if(total_image == 0){
                    alert("can't have no url")
                }
                else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: "{{ url('mystories/draft/:story_id') }}".replace(':story_id', $(this).data('story_id')),
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert(response);
                        },
                        // error: function(response) {
                        //     var errors = response.responseJSON.errors;
                        //     var errorHtml = '';
                        //     $.each(errors, function(key, value) {
                        //         errorHtml += '<p>' + value + '</p>';
                        //     });
                        //     $('#story-error').html(errorHtml).show();
                        // }
                        error: function(response) {
                        var errors = response.responseJSON.errors;

                        $.each(errors, function(field, messages) {
                            var $input = $('input[name="' + field + '"]');
                            $input.addClass('border-red-500');
                            if (field === 'name') {
                                $input.next('.text-red-500').html(messages[0]);
                            }
                        });
                    }
                    });
                }
            });
            $('button[class="close_preview_img"]').on('click', function() {
                deleteFiles = [...deleteFiles, $(this).data('story_media_id')];
                $(this).parent().remove();
            });
        })
            // $('#submit-button').on('click', function() {
            // var path = $('#path').val().split('\n');
            // console.log(path);
            // })
        // $(document).ready(function(event) {

        //     close_preview();
        //     $('#submit-button').on('click', function() {

        //     var files = $('#file-input')[0].files;
        //     for (var i = 0; i < files.length; i++) {
        //         $('<input>').attr({
        //             type: 'hidden',
        //             name: 'photos[]',
        //         }).prop('files', files[i]).appendTo('form');
        //     }
        //     $('<input>').attr({
        //             type: 'hidden',
        //             name: 'photosPath[]',
        //             value: uploadedFiles
        //         }).appendTo('form');
        //     });
        // })
    </script>
@endsection
