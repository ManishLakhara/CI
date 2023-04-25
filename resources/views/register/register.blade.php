@extends('layouts.loginapp')
@section('content')
    <div class="container-fluid">
        <div class="row h-100 w-100">
            <div class="col-lg-8 align-self-center" style="padding: 0%">
                @include('components.carosel')
            </div>
            <div class="col-lg-4 align-self-center" style="padding: 4%;">

                @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
                @endif

                    <form action="{{ route('post-register') }}" method='post'>
                        @csrf
                        <label for="inputFirstName" class="col-form-label"> First Name</label>
                        <div class="col">
                            <input type="text" autocomplete="on" class="form-control"  name="first_name" value="{{old('first_name')}}">
                            @error('first_name')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <label for="inputLastName" class="col-form-label"> Last Name</label>
                        <div class="col">
                            <input type="text" autocomplete="on" class="form-control"  name="last_name" value="{{old('last_name')}}">
                            @error('last_name')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label for="inputPhone" class="col-form-label"> Phone Number</label>
                        <div class="col">
                            <input type="tel" autocomplete="on" class="form-control"  name="phone_number"
                                value="{{old('phone_number')}}">
                                @error('phone_number')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                        </div>
                        <label for="inputEmail" class="col-form-label"> Email</label>
                        <div class="col">
                            <input autocomplete="on"  class="form-control"  name="email"
                                value="{{old('email')}}">
                                @error('email')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                        </div>
                        <label for="inputPassword" class="col-form-label">Password</label>
                        <div class="col">
                            <input autocomplete="on" type="password" class="form-control"  name="password" value="{{old('password')}}">
                            @error('password')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label for="inputComfirmPassword" class="col-form-label">Confirm Password</label>
                        <div class="col">
                            <input autocomplete="on" type="password" class="form-control"  name="confirm_password"
                                value="{{old('comfirm_password')}}">
                            @error('confirm_password')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-outline-warning mt-3"
                                style="width: 100%; border-radius: 23px">Register</button>
                        </div>
                    </form>

                    @include('components.lostyourpassword')

                    @include('components.loginnow')

                    @include('components.privacypolicy')
            </div>
        </div>
    </div>
@endsection
