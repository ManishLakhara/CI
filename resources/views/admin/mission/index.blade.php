@extends('admin.app')

@section('title')
    Mission
@endsection

@section('body')
    <div class="container-fluid px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> Mission </span></ul>

        <!-- Success Alert -->
        @include('admin.components.successAlert')




        <div class="card m-4" style="border:none">
            {{-- <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div> --}}

            <div class="card-body">

                @include('admin.components.search_add', [
                    'form_action' => 'mission.index',
                    'add' => 'mission.create',
                ])

                <table class="table table-responsive border-start border-end">
                    <thead class="table-light">
                        <tr>
                            <th class="col-lg-6">Mission Title</th>
                            <th class="col-lg-2">Mission Type</th>
                            <th class="col-lg-2">Start Date</th>
                            <th class="col-lg-2">End Date</th>
                            <th class="col-lg-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->title }}</td>
                                <td>{{ $d->mission_type }}</td>
                                <td>{{ $d->start_date }}</td>
                                <td>{{ $d->end_date }}</td>
                                <td>

                                    <a class="btn btn-white"href="{{ route('mission.edit', $d->mission_id) }}">
                                        {{-- <img src="Images/edit.png" height="22px" width="22px" alt="edit"> --}}
                                        <i class="far fa-edit" style="color:orange;"></i>
                                    </a>

                                    <button type="button" data-toggle="modal"
                                        data-target="#deleteModal-{{ $d->mission_id }}" class="btn btn-white">
                                        <img src="Images/bin.png" alt="delete">
                                    </button>
                                    <!-- Modal -->
                                    @include('admin.components.deleteModal', [
                                        'id' => $d->mission_id,
                                        'form_action' => 'mission.destroy',
                                    ])
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
