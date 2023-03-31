@extends('layouts.app')
@section('title')
    share your story
@endsection


@section('content')
    <form action="">
        @csrf

        <div class="container mt-5">
            <h2>Share Your Story</h2>

            <div class="row">
                <div class="col-lg-4">

                    <label for="missionSelect" class="form-label">Mission</label>
                    <select class="form-control" id="missionSelect" name="mission_id">
                        <option value="" disabled selected>Select Mission</option>
                        @foreach ($appliedMissions as $mission)
                            <option value="{{ $mission->mission_id }}">{{ $mission->title }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-lg-4">
                    <label for="title" class="form-label">My Story Title</label>
                    <input type="text" class="form-control" id="title" name='title' placeholder="Enter your title"
                        value="{{ old('title') }}" placeholder="Enter story title">
                </div>

                <div class="col-lg-4">
                    <label for="inputdate" class="form-label">Date</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='datetime-local' class="form-control" name='published_at'
                            value="{{ old('published_at') }}" placeholder="Select date">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="inputAddress" class="form-label">My Story</label>
                    <textarea name="description" id="summary-ckeditor">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="missionVideo" class="form-label">Enter Video URL</label>
                    <input type="text" class="form-control" id="orgVideo" name="path" placeholder="Enter your url">
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="UploadYourPhotos" class="form-label">Upload your Photos</label>
                    <div id="drop-zone" style="border: 2px dashed #d8d7d7; padding: 20px; text-align: center;"
                         ondragover="event.preventDefault(); document.getElementById('drop-zone').classList.add('dragover');"
                         ondragleave="document.getElementById('drop-zone').classList.remove('dragover');"
                         ondrop="event.preventDefault(); document.getElementById('drop-zone').classList.remove('dragover'); handleDrop(event);">
                        <i class="fas fa-plus" style="font-size: 40px;"></i>
                        <div style="margin-top: 20px;">Drag and Drop Pictures Here</div>
                    </div>
                    <input type="file" id="file-input" name="photos[]" onchange="handleFiles(this.files);" multiple hidden/>
                    <div id="preview"></div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-lg-12 mt-5">
                    <label for="UploadYourPhotos" class="form-label">Upload your Photos</label>
                    <div id="drop-zone" class="p-5 border border-dashed text-center"
                        ondragover="event.preventDefault(); document.getElementById('drop-zone').classList.add('dragover');"
                        ondragleave="document.getElementById('drop-zone').classList.remove('dragover');"
                        ondrop="event.preventDefault(); document.getElementById('drop-zone').classList.remove('dragover'); handleDrop(event);">
                        <i class="fas fa-plus fa-5x"></i>
                        <div class="mt-3">Drag and Drop Pictures Here</div>
                    </div>
                    <input type="file" id="file-input" name="photos[]" onchange="handleFiles(this.files);" multiple
                        hidden />
                    <div id="preview" class="row mt-3"></div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-lg-6">
                    <button type="button" class="btn px-4  btn-outline-secondary  rounded-pill float-start">Cancel</button>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn px-4 btn-outline-warning rounded-pill float-end">Save</button>
                    <button type="submit" class="btn px-4 btn-outline-warning ms-3 rounded-pill float-end">
                        Submit</button>
                </div> --}}
                <div class=" mt-4">
                    <button type="button" class="btn px-4  btn-outline-secondary  rounded-pill float-start">Cancel</button>
                    <button type="submit" class="btn px-3 btn-outline-warning ms-3 rounded-pill float-end">
                        Submit</button>
                    <button type="button" class="btn px-4 btn-outline-warning rounded-pill float-end">Save</button>
                </div>
            </div>

        </div>
    </form>


    {{-- <script>
  var uploadedFiles = [];

function handleFiles(files) {
    var preview = document.getElementById("preview");
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (uploadedFiles.includes(file.name)) {
            continue;
        }
        uploadedFiles.push(file.name);
        var reader = new FileReader();
        reader.onload = function(event) {
            var src = event.target.result;
            var img = document.createElement("img");
            img.setAttribute("src", src);
            img.setAttribute("style", "width: 118px;height: 118px;margin-left:30px;margin-top:20px;");
            preview.appendChild(img);
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


    </script> --}}

    <script>
        var uploadedFiles = [];

        function handleFiles(files) {
            var preview = document.getElementById("preview");
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (uploadedFiles.includes(file.name)) {
                    continue;
                }
                uploadedFiles.push(file.name);
                var reader = new FileReader();
                reader.onload = function(event) {
                    var src = event.target.result;
                    var img = document.createElement("img");
                    img.setAttribute("src", src);
                    img.setAttribute("style", "width: 148px;height: 118px;margin-left:30px;margin-top:20px;");
                    img.classList.add("preview-image");
                    preview.appendChild(img);
                    addCloseIcon(img);
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

        function handleFileInput() {
            var files = document.getElementById("file-input").files;
            handleFiles(files);
        }

        function addCloseIcon(img) {
            var closeIcon = document.createElement("i");
            closeIcon.classList.add("fas", "fa-times-square", "close-icon");
            closeIcon.addEventListener("click", function(event) {
                event.stopPropagation();
                uploadedFiles.splice(uploadedFiles.indexOf(img.src), 1);
                img.parentNode.removeChild(img);
            });
            img.parentNode.appendChild(closeIcon);
        }
    </script>
@endsection
