@extends('admin.app')

@section('title')
    CMS Page
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> CMS Page </span></ul>
        <div class="card m-4">
            <div class="card-header">
                <h4>Add</h4>
            </div>

            <div class="card-body">
                {{-- <div class="container"> --}}
                <form action="{{ route('cmspage.store') }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="Title">Title <span style="color:red;">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="" value="{{ old('title') }}">

                            @error('title')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputAddress" class="form-label">Description<span
                                    style="color:red;">*</span></label>
                            <textarea name="text" id="editor1">{{ old('text') }}</textarea>
                            @error('text')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="slug">Slug<span style="color:red;">*</span></label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                id="" value="{{ old('slug') }}">

                            @error('slug')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="status">Status<span style="color:red;">*</span></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="0">Inactive</option>
                                <option value="1" selected>Active</option>
                            </select>


                            @error('status')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 py-4">
                                <button class="btn btn-warning pull-right" type="submit">Save</button>
                            </div>
                            <div class="col-md-6 py-4">
                                <a class="btn btn-warning pull-right" href="{{ route('cmspage.index') }}">cancel</a>
                            </div>
                        </div>
                    </div>

                </form>
                {{-- </div> --}}
            </div>
        </div>

    </div>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
