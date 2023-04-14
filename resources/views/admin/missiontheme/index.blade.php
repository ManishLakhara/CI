@extends('admin.app')

@section('title')
    list
@endsection
@section('body')
    <div class="container-fluid px-4">

        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Mission Theme </span></ul>
        <!-- Success Alert -->
        @include('admin.components.successAlert')

        @include('admin.components.search_add', [
            'form_action' => 'missiontheme.index',
            'add' => 'missiontheme.create',
        ])
        <table class="table table-responsive border-start border-end">
            <thead style="background-color: #F8F9FC">
                <tr>
                    <th width="500px">S.No</th>
                    <th width="500px">Title</th>
                    <th width="500px">Status</th>
                    <th width="500px">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- $--}}
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->mission_theme_id}}</td>
                        <td>{{ $d->title }}</td>
                        <td>
                            @if ($d->status)
                                <div style="color: #14C506">
                                    Active
                                </div>
                            @else
                                <div class=" text-danger">
                                    Inactive
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-white" href="{{ route('missiontheme.edit', $d->mission_theme_id) }}">
                                    <i class="far fa-edit" style="color:#F88634;"></i>
                                </a>

                                <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $d->mission_theme_id }}"
                                    class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>
                                <!-- Modal -->
                                @include('admin.components.deleteModal', [
                                    'id' => $d->mission_theme_id,
                                    'form_action' => 'missiontheme.destroy',
                                ])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        @include('admin.layouts.pagination')
    </div>
@endsection
