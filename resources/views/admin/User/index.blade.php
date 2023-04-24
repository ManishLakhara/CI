@extends('admin.app')
@section('title')
    User
@endsection

@section('body')
    <div class="container-fluid mt-4">
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
                    <th class="fs-5 py-4 px-3 font-weight-light" width="600px">First Name</th>
                    <th class="fs-5 py-4  font-weight-light" width="600px">Last Name</th>
                    <th class="fs-5 py-4  font-weight-light" width="600px">Email</th>
                    <th class="fs-5 py-4  font-weight-light" width="600px">Employee Id</th>
                    <th class="fs-5 py-4  font-weight-light" width="600px">Department</th>
                    <th class="fs-5 py-4  font-weight-light" width="600px">Status</th>
                    <th class="fs-5 py-4  font-weight-light text-end pe-4" width="600px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td class="px-3">{{ $d->first_name }}</td>
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
                            <div class="d-flex justify-content-end">
                                <a aria-label="edit" class="btn btn-white" href="{{ route('user.edit', $d->user_id) }}">
                                    <i class="fas fa-edit" style="color: #F88634"></i>
                                </a>

                                <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $d->user_id }}"
                                    class="btn btn-white">
                                    <img src="Images/bin.png" style="width: 16px;height:20px" alt="delete">
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
