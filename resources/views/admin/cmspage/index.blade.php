@extends('admin.app')

@section('title')
    CMS Page
@endsection

@section('body')
    <div class="container-fluid mt-4 px-4">
        <ul class="nav border-bottom"><span class="nav-link active fs-1"> CMS Page</span></ul>
        @include('admin.components.successAlert')

        {{-- <div class="card m-4" style="border:none">
           <div class="card-header">
                <i class="fas fa-table me-1"></i>
            </div>

            <div class="card-body"> --}}

                @include('admin.components.search_add', [
                    'form_action' => 'cmspage.index',
                    'add' => 'cmspage.create',
                ])

                <table class="table table-responsive border-start border-end">
                    {{-- <thead class="table-light" style="background-color: #F8F9FC"> --}}
                    <thead style="background-color: #F8F9FC">

                        <tr>
                            <th class="fs-5 py-4 px-3 font-weight-light col-lg-8">Title</th>
                            <th class="fs-5 py-4 font-weight-light col-lg-4">Status</th>
                            <th class="fs-5 py-4 font-weight-light">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td class="px-3">{{ $d->title }}</td>
                                <td>
                                    @if ($d->status)
                                        <div class="h5" style="color: #14C506">
                                            Active
                                        </div>
                                    @else
                                        <div class="h5 text-danger">
                                            Inactive
                                        </div>
                                    @endif
                                </td>
                                <td class="d-flex">

                                    <a class="btn btn-white" href="{{ route('cmspage.edit', $d->cms_page_id) }}">
                                        {{-- <img src="Images/edit.png" height="22px" width="22px" alt="edit"> --}}
                                          <i class="far fa-edit" style="color:orange;"></i>
                                    </a>
                                    <button type="button" data-toggle="modal"
                                        data-target="#deleteModal-{{ $d->cms_page_id }}" class="btn btn-white">
                                        <img src="Images/bin.png" style="width: 16px;height:20px" alt="delete">
                                    </button>
                                    @include('admin.components.deleteModal', [
                                        'id' => $d->cms_page_id,
                                        'form_action' => 'cmspage.destroy',
                                    ])
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {!!$pagination!!}
            </div>
        {{-- </div>
    </div> --}}
@endsection
