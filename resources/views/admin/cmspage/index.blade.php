@extends('admin.app')

@section('title')
    CMS Page
@endsection

@section('body')

    <div class="container-fluid px-4">
        <h1 class="mt-4">CMS Page</h1>
        @include('admin.components.successAlert')

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">CMS Page</li>
        </ol>
        <a href="{{ route('cmspage.create') }}">
        <button type="button" class="btn rounded text-right btn-outline-warning">
            <i class="fa-solid fa-plus px-3"></i> Add</button>
        </a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>

            <div class="card-body">

                @include('admin.components.search_add',['form_action' => 'cmspage.index','add' => 'cmspage.create'])

                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th class="col-lg-8">Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->title}}</td>
                        <td>
                            @if($d->status)
                                            <div class="h5 text-success">
                                                Active
                                            </div>
                                       @else
                                            <div class="h5 text-danger">
                                                Inactive
                                            </div>
                                       @endif
                        </td>
                        <td>
                            <form action="{{ route('cmspage.destroy',$d->cms_page_id) }}" method="post">
                                <a class="btn btn-white" href="{{route('cmspage.edit',$d->cms_page_id)}}">
                                <img src="Images/edit.png" height="22px" width="22px" alt="edit">
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-toggle="modal" data-target="#deleteModal" class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>
                                @include('admin.components.deleteModal')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                @include('admin.layouts.pagination')
            </div>
        </div>
    </div>
@endsection
