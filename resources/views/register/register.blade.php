@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start" style="width: 100%; height: 100%;">
            <div class="col-md-8 align-self-center">
                @include('components.carosel')
                <div class="col-md-4 align-self-center" style="padding: 4%;">

                    <form action="{{ route('post-register') }}" method='post'>
                        @csrf
                        <label for="inputFirstName" class="col-form-label"> First Name</label>
                        <div class="col">
                            <input type="text" class="form-control" required name="first_name" id="" value="">
                            @error('first_name')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        
                        <label for="inputLastName" class="col-form-label"> Last Name</label>
                        <div class="col">
                            <input type="text" class="form-control" required name="last_name" id="" value="">
                            @error('last_name')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label for="inputPhone" class="col-form-label"> Phone Number</label>
                        <div class="col">
                            <input type="tel" class="form-control" required name="phone_number" id=""
                                value="">
                                @error('phone_number')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                        </div>
                        <label for="inputEmail" class="col-form-label"> Email</label>
                        <div class="col">
                            <input type="email" class="form-control" required name="email" id=""
                                value="">
                                @error('email')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                        </div>
                        <label for="inputPassword" class="col-form-label">Password</label>
                        <div class="col">
                            <input type="password" class="form-control" required name="password" id="" value="">
                            @error('password')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label for="inputComfirmPassword" class="col-form-label">Confirm Password</label>
                        <div class="col">
                            <input type="password" class="form-control" required name="confirm_password" id=""
                                value="">
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

                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('components.lostyourpassword')

                    @include('components.loginnow')
                    
                    @include('components.privacypolicy')
                    
                    
@endsection
