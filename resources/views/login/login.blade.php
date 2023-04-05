@extends('layouts.loginapp')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="width: 100%; height: 100%;">
            <div class="col-md-8 align-self-center">
                @include('components.carosel')
            <div class="col-md-4 align-self-center" style="padding: 4%;">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

               <form action="{{route('login.custom')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="login-text">Email Address</label>
                    <input type="email" class="form-control m-1" name="email" id="" required aria-describedby="emailHelpId" placeholder="" value="">
                    @error('email')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="" class="login-text">Password</label>
                    <input type="password" class="form-control m-1" name="password" required id="" placeholder="" value="">
                    @error('password')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-outline-warning mt-3" style="width: 100%; border-radius: 23px">Login</button>
               </form>

               @if(session('status'))
                <div class="alert alert-danger">
                    {{ session('status')}}
                </div>
               @endif   


                @include('components.lostyourpassword')

                @include('components.createanaccount')

                @include('components.privacypolicy')
            </div>
        </div>
    </div>
@endsection
