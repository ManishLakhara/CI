@extends('admin.app')

@section('title')
    Banner Management
@endsection

@section('body')
<div class="containter-fluid px-4">
    <ul class="nav border-bottom"><span class="nav-link active fs-1"> Banner Management </span></ul>
    @include('admin.components.successAlert')

    @include('admin.components.search_add', [
        'form_action' => 'banner.index',
        'add' => 'banner.create',
    ])

    <table class="table table-responsive border-start border-end">
        <thead style="background-color: #F8F9FC">
            <tr>
                <th width="1000px">Image</th>
                <th width="400px">Sort Order</th>
                <th width="400px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>
                        {{$d->image}}
                    </td>
                    <td>
                        {{$d->sort_order}}
                    </td>
                    <td>

                        <a class="btn btn-white"href="{{ route('banner.edit', $d->banner_id) }}">
                            <i class="fas fa-edit" style="color: #F88634"></i>
                        </a>

                        <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $d->banner_id }}"
                            class="btn btn-white">
                            <img src="Images/bin.png" alt="delete">
                        </button>
                        {{-- model --}}
                        @include('admin.components.deleteModal', [
                            'id' => $d->banner_id,
                            'form_action' => 'banner.destroy',
                        ])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.layouts.pagination')
</div>
@endsection
