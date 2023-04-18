@extends('admin.app')
@section('title')
    User
@endsection

@section('body')
    <div class="container-fluid px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> User </span></ul>

        <!-- Success Alert -->
        @include('admin.components.successAlert')

        @include('admin.components.search_add', [
            'form_action' => 'user.index',
            'add' => 'user.create',
        ])
        <table class="table table-responsive border-start border-end">
            <thead style="background-color: #F8F9FC">
                <tr>
                    <th width="600px">First Name</th>
                    <th width="600px">Last Name</th>
                    <th width="600px">Email</th>
                    <th width="600px">Employee Id</th>
                    <th width="600px">Department</th>
                    <th width="600px">Status</th>
                    <th width="600px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->first_name }}</td>
                        <td>{{ $d->last_name }}</td>
                        <td>{{ $d->email }}</td>
                        <td>{{ $d->employee_id }}</td>
                        <td>{{ $d->department }}</td>
                        <td>
                            @if ($d->status)
                                <div style="color: #14C506">
                                    Active
                                </div>
                            @else
                                <div class="text-danger">
                                    Inactive
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-white" href="{{ route('user.edit', $d->user_id) }}">
                                    <i class="fas fa-edit" style="color: #F88634"></i>
                                </a>

                                <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $d->user_id }}"
                                    class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>
                                <!-- Modal -->
                                @include('admin.components.deleteModal', [
                                    'id' => $d->user_id,
                                    'form_action' => 'user.destroy',
                                ])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {!!$pagination!!}
    </div>
@endsection
