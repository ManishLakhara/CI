<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="{{asset('admin/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <?php
         $token = substr($_SERVER['REQUEST_URI'],-60);
        ?>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New Password</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted text-center">Enter your new password.</div>
                                        <form method="post" action="{{route('adminPasswordResetting')}}">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password"  placeholder="Password" required/>
                                                <label for="inputPassword">New Password</label>
                                                @error('password')
                                                <div class="text-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="confirm-password"  placeholder="Password" required/>
                                                <label for="inputPassword">Confirm New Password</label>
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

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="{{ route('adminlogin') }}">Return to login</a>
                                                <button type="submit" class="btn btn-primary">Change Password</a>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                @include('admin.layouts.footer')
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
