
    <nav class="sb-topnav navbar bg-white navbar-expand navbar justify-content-between" style="padding:0%; !important">
        <!-- Navbar Brand-->
        {{-- <a class="navbar-brand ps-3" href="index.html">CI platform</a> --}}
        <!-- Sidebar Toggle-->
        <div style="width: 225px; background-color:#F88634; height: inherit;" id="filler-gap"></div>
        <div>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 px-3" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </div>
        <div>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-black" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle me-3 user_image" src={{asset('Images/user-img1.png')}} alt="">
                        <span class='me-2'>Evan Donohue</span></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="adminlogin">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
