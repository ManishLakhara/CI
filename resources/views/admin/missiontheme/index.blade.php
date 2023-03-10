@extends('admin.app')

@section('title')
    list
@endsection
@section('body')
    <div class="container-fluid px-4">
        
        <h1 class="border-bottom"> <span style="text-decoration-line: underline">Mission Theme</span></h1>
        <!-- Success Alert -->
        @include('admin.components.successAlert')

        @include('admin.components.search_add', [
            'form_action' => 'missiontheme.index',
            'add' => 'missiontheme.create',
        ])
        <table class="table table-responsive border-start border-end">
            <thead>
                <tr>
                    <th class="w-25">S.No</th>
                    <th class="w-25">Title</th>
                    <th class="w-25">Status</th>
                    <th class="w-25">Action</th>
                </tr>
            </thead>
            <tbody>
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
                                    <img src="Images/edit.png" height="22px" width="22px" alt="edit">
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
