@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="width: 100%; height: 100%;">
            <div class="col-md-8 align-self-center">
                @include('components.carosel')
            <div class="col-md-4 align-self-center" style="padding: 4%;">





               <form action="{{route('custom-login')}}" method="post">
                <div class="form-group">
                    <label for="" class="login-text">Email Address</label>
                    <input type="email" class="form-control m-1" name="" id="" aria-describedby="emailHelpId" placeholder="" value="evan.donohue@gmail.com">
                  </div>
                  <div class="form-group">
                    <label for="" class="login-text">Password</label>
                    <input type="password" class="form-control m-1" name="" id="" placeholder="" value="password"> 
                  </div> 
                  <button type="submit" class="btn btn-outline-warning mt-3" style="width: 100%; border-radius: 23px">Login</button>
               </form>




                <p class="m-3" style="text-align: center;"> <small>
                    <a href="forgot.html" style="color:#414141; text-decoration:none;">Lost your password?</a>
                </small>
                </p>
                <p class="m-3 fs-12" style="text-align: center; color:#414141;">
                    <small>
                        Don't have an account? <a style="text-decoration:none;" href="#">Create an account</a> 
                    </small>
                </p>
                <p class="m-3 privacy-policy" style="text-align: center;"> <small>
                    <a href="#forgot.html" style="color:#414141; text-decoration:none;">Privacy Policy</a>
                </small>
                </p>
            </div>
        </div>
    </div>
@endsection