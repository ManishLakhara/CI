@extends('admin.app')

@section('title')
    list
@endsection

@section('body')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mission Theme</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Missions</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>action</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                    </tfoot>

                    <tbody>
        @foreach ($data as $mt)
                <tr>
                    <td>{{$mt->title}}</td>
                    <td>{{$mt->status}}</td>
                    <td><img src="" alt=""></td>
                </tr>
        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
