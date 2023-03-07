@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Skill</h1>

        <!-- Success Alert -->  
        @include('admin.components.successAlert')

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Skill</li>
        </ol>
        <div class="card mb-4 ">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>
            <div class="card-body">
                @include('admin.components.search_add', [
                    'form_action' => 'missionskill.index',
                    'add' => 'missionskill.create',
                ])
                <div class="card-body ">
                    <table id="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th width="280px">Skill Name</th>
                                <th width="280px">Status</th>
                                <th width="280px">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $mt)
                                <tr>
                                    <td>{{ $mt->skill_name }}</td>
                                    <td>
                                        @if ($mt->status)
                                            <div class=" text-success">
                                                Active
                                            </div>
                                        @else
                                            <div class=" text-danger">
                                                Inactive
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('missionskill.destroy', $mt->skill_id) }}" method="Post">
                                            <a class="btn btn-white" href="{{ route('missionskill.edit', $mt->skill_id) }}">
                                                <img src="Images/edit.png" height="22px" width="22px" alt="edit">
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-toggle="modal" data-target="#deleteModal"
                                                class="btn btn-white">
                                                <img src="Images/bin.png" alt="delete">
                                            </button>
                                            <!-- Modal -->
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
    </div>
@endsection
