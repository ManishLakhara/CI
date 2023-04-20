@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Mission Skill </span></ul>

        <!-- Success Alert -->
        @include('admin.components.successAlert')


        @include('admin.components.search_add', [
            'form_action' => 'missionskill.index',
            'add' => 'missionskill.create',
        ])
        <table class="table table-responsive border-start border-end">
            <thead style="background-color: #F8F9FC">
                <tr>
                    <th class="fs-5 py-4 px-3 font-weight-light" width="600px">Sr.no</th>
                    <th class="fs-5 py-4 font-weight-light" width="600px">Skill Name</th>
                    <th class="fs-5 py-4 font-weight-light" width="600px">Status</th>
                    <th class="fs-5 py-4 font-weight-light text-end pe-4" width="600px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $mt)
                    <tr>
                        <td class="px-3">{{ $mt->skill_id}}</td>
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
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-white" href="{{ route('missionskill.edit', $mt->skill_id) }}">
                                    <i class="far fa-edit" style="color:#F88634;"></i>
                                </a>
                                <button type="button" data-toggle="modal" data-target="#deleteModal-{{ $mt->skill_id }}"
                                    class="btn btn-white">
                                    <img src="Images/bin.png" style="width: 16px;height:20px" alt="delete">
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
        {!!$pagination!!}
    </div>
@endsection
