@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="border-bottom"><span style="text-decoration-line: underline">Mission Skill</span></h1>

        <!-- Success Alert -->
        @include('admin.components.successAlert')


        @include('admin.components.search_add', [
            'form_action' => 'missionskill.index',
            'add' => 'missionskill.create',
        ])
        <table class="table table-responsive border-start border-end">
            <thead style="background-color: #F8F9FC">
                <tr>
                    <th width="600px">Sr.no</th>
                    <th width="600px">Skill Name</th>
                    <th width="600px">Status</th>
                    <th width="600px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $mt)
                    <tr>
                        <td>{{ $mt->skill_id}}</td>
                        <td>{{ $mt->skill_name }}</td>
                        <td>
                            @if ($mt->status)
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
                                <a class="btn btn-white" href="{{ route('missionskill.edit', $mt->skill_id) }}">
                                    <img src="Images/edit.png" height="22px" width="22px" alt="edit">
                                </a>
                                <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $mt->skill_id }}"
                                    class="btn btn-white">
                                    <img src="Images/bin.png" alt="delete">
                                </button>
                                <!-- Modal -->
                                @include('admin.components.deleteModal', [
                                    'id' => $mt->skill_id,
                                    'form_action' => 'missionskill.destroy',
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
