@extends('layouts.loginapp')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start" style="width: 100%; height: 100%;">
            <div class="col-md-8 align-self-center">
                @include('components.carosel') 
            <div class="col-md-4 align-self-center" style="padding: 4%;">
                    <h4 style="text-align: center;" >Forgot Password </h4>
                    <p style="text-align: center;">

                    <small>
                        Enter your email address you've using for your account below and we will send you a password reset link
                    </small></p>
                    
                    <form action="{{route('check.email')}}" method='post'>
                        @csrf
                        <div class="form-group">
                            <label for="" class="login-text">Email Address</label>
                            <input type="email" class="form-control m-1" name="email" id=""  aria-describedby="emailHelpId" placeholder="Enter your email address..." value="">
                            @error('email')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
    
                        <button type="submit" class="btn btn-outline-warning mt-3" style="width: 100%; border-radius: 23px">Reset my Password</button>
                    </form>

                    @if(session('status'))
                        <div class="alert alert-danger">
                            {!! session('status') !!}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                    @endif

                    @include('components.loginnow')
    
                    @include('components.privacypolicy')
            </div>
        </div>
    </div>
@endsection