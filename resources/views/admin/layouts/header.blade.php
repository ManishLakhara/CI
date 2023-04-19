
    <nav class="position-absolute sb-topnav navbar bg-white navbar-expand navbar justify-content-between" style="height:5em;padding:0%; z-index: 5;box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
        <div>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 px-3" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </div>
        <div class="position-absolute d-none d-lg-block px-4" style="left: 300px">
            <span>{{ (new DateTime())->sub(new DateInterval('PT6H30M'))->format('l, F j, Y, g:i A') }}</span>
        </div>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <a class="btn text-muted btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" id="header-avatar" src="{{ Auth::guard('admin')->user()->avatar ? asset(Auth::guard('admin')->user()->avatar) : asset('Images/volunteer1.png') }}" alt="Profile" style="height:54px;width:54px" >
                            <span id="userAvatar">{{ Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name }}</span>
                          </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('adminlogout') }}">Logout</a>


                        </div>
                    </div>
                </li>
            </ul>

    </nav>
