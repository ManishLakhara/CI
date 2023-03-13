@extends('layouts.app')
@section('title')
    Policy Page
@endsection
@section('content')
    <div class="container">
        <h2 class="mt-5 mx-4">Privacy and Cookies Policy</h2>
        <div class="row">

            <div class="col-lg-4 col-md-6">

                <div class="container mt-5" style="height: 100%;">
                    <div class="col-sm-10" style="position: sticky;top:10%;">
                        <ul class="nav flex-column justify-content">
                            @foreach ($data as $item)
                                <li class="nav-item">
                                    <div class="d-flex justify-content-between">
                                        <a class="nav-link text-dark" href="#{{ $item->slug }}">{{ $item->title }}</a>
                                        <a href="#{{ $item->slug }}"><img src="Images/right-arrow1.png"
                                                alt="right-arrow"></a>
                                    </div>
                                    <hr>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="container">


                <div class="row">
                    <div class="mt-5">
                        <div class="col-sm-9">
                            @foreach ($data as $item)
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="{{ $item->slug }}" role="tabpanel">
                                        <h3 class="mt-3">{{ $item->title }}</h3>
                                        <p class="mt-3">{!! $item->text !!}</p>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                </div>
            </div>
            @include('admin.layouts.pagination')
        </div>
    </div>
@endsection
