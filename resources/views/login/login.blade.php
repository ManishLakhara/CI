@extends('layouts.loginapp')
@section('content')
    <div class="container-fluid w-100">
        <div class="row h-100 w-100">
            <div class="col-md-8 align-self-center" style="padding: 0%">
                @include('components.carosel')
            </div>
            <div class="col-md-4 align-self-center" style="padding: 4%;">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login.custom') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="login-text">Email Address</label>
                        <input type="email" autocomplete="on" class="form-control m-1" name="email" id="email"
                            aria-describedby="emailHelpId" placeholder="" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="login-text">Password</label>
                        <input type="password" autocomplete="on" class="form-control m-1" name="password" id="password"
                            placeholder="" value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha"
                            name="captcha">
                    </div>
                    @error('captcha')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-outline-warning mt-3"
                        style="width: 100%; border-radius: 23px">Login</button>
                </form>

                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif

                <script type="text/javascript">
                    $('#reload').click(function() {
                        $.ajax({
                            type: 'GET',
                            url: 'reload-captcha',
                            success: function(data) {
                                $(".captcha span").html(data.captcha);
                            }
                        });
                    });
                </script>

                @include('components.lostyourpassword')

                @include('components.createanaccount')

                @include('components.privacypolicy')
            </div>
        </div>
    </div>
@endsection
