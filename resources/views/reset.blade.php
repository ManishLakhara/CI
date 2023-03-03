@extends('layouts.loginapp')
<style>
    {{include 'CSS/style.css'}}
    {{include 'CSS/bootstrap.min.css'}}
</style>
<script>
    {{include 'JS/bootstrap.bundle.min.js'}}
    {{include 'JS/jquery.min.js'}}
    {{include 'JS/popper.js'}}
</script>
<?php
$token = substr($_SERVER['REQUEST_URI'],-60);
?>
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

                <form action="{{route('password-resetting')}}" method='post'>
                    @csrf
                     <label for="inputNewPassword" class="col-form-label">New Password</label> 
                     <div class="col">
                        <input type="password" class="form-control" id="" name='password' value="">
                        @error('password')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @enderror
                     </div>

                     <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label> 
                     <div class="col">
                        <input type="password" class="form-control" name="confirm-password" id="" value="">
                        @error('confirm-password')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                        @enderror
                     </div>


                     @if(session('error'))
                        <div class="alert alert-danger m-3">
                            {{session('error')}}
                        </div>
                    @endif


                     <div class="col">
                        <input type="password" class="form-control" hidden name="token" id="" value={{$token}}>
                     </div> 

                     <div class="col">
                        <button type="submit" class="btn btn-outline-warning mt-3" style="width: 100%; border-radius: 23px">Change Password</button>
                    </div>
                    <div>
                        
                    </div>
                </form>


                @include('components.login')

                @include('components.privacypolicy')
        </div>
@endsection