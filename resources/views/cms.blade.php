@extends('layouts.app')

@section('title')
    Policy Page
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-5 mx-4">Privacy and Cookies Policy</h2>
        <div class="row">

            <div class="col-lg-4 col-md-6">

                {{-- @section('cms-toggle') --}}
                <div class="container mt-5 d-lg-none d-md-none">
                    <button class="customnavbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars" style="color:blue;text-decoration:none;"></i>
                    </button>
                    <div class="collapse customnavbar-collapse" id="navbarNav">
                        <ul class="nav flex-column justify-content" style="list-style:none;padding-left:0;">
                            @foreach ($policies as $policy)
                                <li class="nav-item">
                                    <a href="#{{ $policy->slug }}" style="cursor: pointer;text-decoration:none;"
                                        class="nav-link text-dark pl-3 py-2">{{ $policy->title }}</a>
                                </li>
                                <hr>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{--   @endsection --}}

                <div class="container mt-5 d-none d-lg-block" style="height: 100%;">
                    <div class="col-sm-10" style="position: sticky;top:10%;">
                        <ul class="customnav flex-column justify-content" style="list-style:none;padding-left:0;">
                            @foreach ($policies as $policy)
                                <li class="nav-item">
                                    <a href="#{{ $policy->slug }}" style="cursor: pointer;text-decoration:none;">
                                        <div class="d-flex justify-content-between">
                                            <span class="nav-link text-dark pl-3 py-2">{{ $policy->title }}</span>
                                            <img src="Images/right-arrow1.png" alt="right-arrow"
                                                style="width:15px;height:15px;padding-right:10px;">
                                        </div>
                                    </a>

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
                                @foreach ($policies as $policy)
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="{{ $policy->slug }}" role="tabpanel">
                                            <h3 class="mt-3">{{ $policy->title }}</h3>
                                            <p class="mt-3" style="line-height: 1.5;">{!! $policy->text !!}</p>
                                            <hr>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<div class="d-flex p-3 justify-content-end">
    {!! $policies->links('pagination::bootstrap-4') !!}
</div>

        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"
    integrity="sha512-pPpz+eqirKNxjh1fjZzscOZ6gC/G6QfBnIy9PQvyjvRcApjjUpaU+RVZ3CO4p4jzjc/CnF/HMWWsL+O13pxTQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"
    integrity="sha512-8/ZRH6UUsY6cJGBfPQoLPbXWk1GnK1lnJ5h5zhsBZgAfKjCwPugrMnSPDx9Kp+3r3vV7hJGjjCwbZ8KzPQYv7g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>


<script>
    $(document).ready(function() {
        // Hamburger Menu Toggle
        $('.customnavbar-toggler').on('click', function() {
            $('.customnavbar-collapse').toggleClass('show');
        });

        $('.nav-link').on('click', function() {
            $('.customnavbar-collapse').removeClass('show');
        });


        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.hash);
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                $('.customnavbar-collapse').removeClass('show');
            }
        });

    });
</script>
