@extends('admin.app')

@section('title')
    Banner Management
@endsection

@section('body')
<div class="containter-fluid mt-4 px-4">
    <ul class="nav border-bottom"><span class="nav-link active fs-1"> Banner Management </span></ul>
    @include('admin.components.successAlert')

    @include('admin.components.search_add', [
        'form_action' => 'banner.index',
        'add' => 'banner.create',
    ])

    <table class="table table-responsive border-start border-end">
        <thead style="background-color: #F8F9FC">
            <tr>
                <th class="fs-5 py-4 px-3 font-weight-light" width="1000px">Image</th>
                <th class="fs-5 py-4 font-weight-light" width="400px">Sort Order</th>
                <th class="fs-5 py-4 font-weight-light text-end" width="400px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td class="px-3">
                        {{$d->image}}
                    </td>
                    <td>
                        {{$d->sort_order}}
                    </td>
                    <td class="d-flex justify-content-end">
                        <a class="btn btn-white"href="{{ route('banner.edit', $d->banner_id) }}">
                            <i class="fas fa-edit" style="color: #F88634"></i>
                        </a>

                        <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $d->banner_id }}"
                            class="btn btn-white">
                            <img src="Images/bin.png" style="width: 16px;height:20px" alt="delete">
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
    {!!$pagination!!}
</div>
@endsection
