@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-start" style="width: 100%; height: 100%;">
        <div class="col-md-8 align-self-center">
            @include('components.carosel')
        <div class="col-md-4 align-self-center" style="padding: 4%;">

            

            <form action="{{route('post-register')}}" method='post'>
                @csrf
                <label for="inputFirstName" class="col-form-label">  First Name</label>
                <div class="col">
                    <input type="text" class="form-control" name="first_name" id="" value="evan">
                </div>
                <label for="inputLastName" class="col-form-label">  Last Name</label>
                <div class="col">
                    <input type="text" class="form-control" name="last_name" id="" value="donohue">
                </div>
                <label for="inputPhone" class="col-form-label"> Phone Number</label>
                <div class="col">
                    <input type="tel" class="form-control" name="phone_number" id="" value="9123456789">
                </div>
                <label for="inputEmail" class="col-form-label"> Email</label>
                <div class="col">
                    <input type="email" class="form-control" name="email" id="" value="evan.donohue@gmail.com">
                </div>
                <label for="inputPassword" class="col-form-label">Password</label>
                <div class="col">
                    <input type="password" class="form-control" name="password" id="" value="password">
                </div>
                <label for="inputComfirmPassword" class="col-form-label">Confirm Password</label>
                <div class="col">
                    <input type="password" class="form-control" name="confirm_password" id="" value="password">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-outline-warning mt-3" style="width: 100%; border-radius: 23px">Register</button>
                </div>
            </form>

            @if(session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif

            <p class="m-3" style="text-align: center;"> <small>
                <a href="{{route('forgot.password')}}" style="color:#414141; text-decoration:none;">Lost your password?</a>
            </small>
            </p>

            <p class="m-3 fs-12" style="text-align: center; color:#414141;">
                <small>
                    Already Registered? <a style="text-decoration:none;" href="{{route('login')}}">Login now</a> 
                </small>
            </p>

            <p class="m-3" style="text-align: center;"> <small>
                <a href="#forgot.html" style="color:#414141; text-decoration:none;">Privacy Policy</a>
            </small>
            </p>


@endsection