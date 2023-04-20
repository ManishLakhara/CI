<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Tatva 2023 intership project">
    {{-- <meta name="theme-color" content="#414141"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}


    {{-- <title>@yield('title')</title> --}}
    <script src={{ asset('JS/jquery.min.js') }}></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- <script src="JS/popper.js"></script>
    <script src="JS/bootstrap.bundle.min.js"></script>
    <script src="JS/custom.js"></script> -->
    <link rel="stylesheet" href={{ asset('CSS/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('CSS/mystyle.css') }}>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}" />
    <title>@yield('title')</title>
</head>

<body>
    {{-- @php
        $user=Auth::user();
    @endphp
    @include('inc.header') --}}
    @auth
        @include('inc.header')
    @endauth
    @yield('content')
    @include('inc.footer')
    <script>
        $('#contactusform').submit(function(event) {
            event.preventDefault();
            var user_id = $('#user_id').val();
            $.ajax({
                type: 'POST',
                url: "{{ url('api/users/contact-us') }}",
                data: $(this).serialize(),
                success: function(response) {
                    $('#contactusModal').modal('hide');
                    location.reload();
                    alert('your message has been conveyed successfully!');
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += '<p>' + value + '</p>';
                    });
                    $('#contactus-error').html(errorHtml).show();
                },
            });
        });
    </script>
    <script src={{ asset('JS/jquery.min.js') }}></script>
</body>
@include('layouts.scripts')
@auth
    @yield('contactus')
@endauth

</html>
