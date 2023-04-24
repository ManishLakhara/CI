@extends('layouts.loginapp')
@section('content')
    <div class="container-fluid w-100">
        <div class="row h-100 w-100">
            <div class="col-md-8 align-self-center" style="padding: 0%">
                @include('components.carosel')
            </div>
            <div class="col-md-4 align-self-center" style="padding: 4%;">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

               <form action="{{route('login.custom')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email" class="login-text">Email Address</label>
                    <input type="email" class="form-control m-1" name="email" id="email" aria-describedby="emailHelpId" placeholder="" value="{{old('email')}}">
                    @error('email')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password" class="login-text">Password</label>
                    <input type="password" class="form-control m-1" name="password" id="password" placeholder="" value="{{old('password')}}">
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
