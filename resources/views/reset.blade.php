@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-start" style="width: 100%; height: 100%;">
        <div class="col-md-8 align-self-center">
            @include('components.carosel')
        <div class="col-md-4 align-self-center" style="padding: 4%;">
            <h4 style="text-align: center;" >Forgot Password</h4>
                <p style="text-align: center;">
                <small>
                    Please enter a new password in the fields below.
                </small></p>

                <form action="{{route('reset.password')}}" method='post'>
                    @csrf
                     <label for="inputNewPassword" class="col-form-label">New Password</label> 
                     <div class="col">
                        <input type="password" class="form-control" id="" name='password' value="Password">
                     </div>

                     <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label> 
                     <div class="col">
                        <input type="password" class="form-control" id="" value="Password">
                     </div>
                     <div class="col">
                        <button type="submit" class="btn btn-outline-warning mt-3" style="width: 100%; border-radius: 23px">Change Password</button>
                    </div>
                </form>


                <p class="m-3" style="text-align: center;"> <small>
                    <a href="{{route('login')}}" style="color:#414141; text-decoration:none;">Login</a>
                </small>
                </p>
                <p class="m-3" style="text-align: center;"> <small>
                    <a href="#forgot.html" style="color:#414141; text-decoration:none;">Privacy Policy</a>
                </small>
                </p>
        </div>
@endsection