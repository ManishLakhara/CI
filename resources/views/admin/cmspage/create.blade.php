@extends('admin.app')

@section('title')
    CMS Page
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">CMS Page</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">CMS Page</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <span>Add</span>
            </div>

            <div class="card-body">
                <div class="container">
                    <form action="{{ route('cmspage.store') }}" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="Title">Title</label>
                                <input type="text" name="title" class="form-control" id="">

                                @error('title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="inputAddress" class="form-label">Description</label>
                                <textarea name="text" id="editor1"></textarea>
                                @error('text')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" id="">

                                @error('slug')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="0">Inactive</option>
                                    <option value="1" selected>Active</option>
                                </select>


                                @error('status')
                                    <div class="text-danger">
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
                </div>
            </div>
        </div>

    </div>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
