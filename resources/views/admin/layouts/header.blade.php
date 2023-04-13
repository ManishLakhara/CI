
    <nav class="sb-topnav navbar bg-white navbar-expand navbar justify-content-between" style="padding:0%; !important">
        <!-- Navbar Brand-->
        {{-- <a class="navbar-brand ps-3" href="index.html">CI platform</a> --}}
        <!-- Sidebar Toggle-->
        <div style="width: 225px; background-color:#F88634; height: inherit;" id="filler-gap"></div>
        <div>
          
            {{-- <span>{{ date('l, F j, Y, g:i A') }}</span> --}}
            <span>{{ (new DateTime())->sub(new DateInterval('PT6H30M'))->format('l, F j, Y, g:i A') }}</span>


            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 px-3" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </div>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <a class="btn text-muted btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle px-3" id="header-avatar" src="{{ Auth::guard('admin')->user()->avatar ? asset(Auth::guard('admin')->user()->avatar) : asset('Images/volunteer1.png') }}" alt="Profile" style="height:54px">
                            <span id="userAvatar">{{ Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name }}</span>
                          </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('adminlogout') }}">Logout</a>


                        </div>
                    </div>
                </li>
            </ul>

    </nav>
