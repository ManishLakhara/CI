<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav zindex-sticky bg-orange" id="sidenavAccordion">
        <div class="sb-sidenav-menu align-content-center">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-white">NAVIGATION</div>

                {{-- <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">Header</div>
                    </div>
                </a> --}}
                <a class="nav-link" href="#">
                    <div class='container'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-user text-white"></i>
                        <span class="text-white font-weight-light">
                            User
                        </span>
                    </div>
                </a>

                <a class="nav-link" href="#">
                    <div class='container'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-pen-to-square text-white"></i>
                        <span class="text-white font-weight-light ">
                            CMS Page
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="#">
                    <div class='container'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-bullseye text-white"></i>
                        <span class="text-white ">
                            Mission
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missiontheme">
                    <div class='container-fluid'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-thin fa-rectangles-mixed"></i>
                        <span class="text-white text-active">
                            Mission Theme
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missionskill">
                    <div class='container'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-folder text-white"></i>
                        <span class="text-white">
                            Mission skill
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="#">
                    <div class='container'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-folder text-white"></i>
                        <span class="text-white">
                            Mission Application
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="#">
                    <div class='container'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-book-blank text-white"></i>
                        <span class="text-white ">
                            Story
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="#">
                    <div class='container-fluid'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-brands fa-canadian-maple-leaf text-white"></i>
                        <span class="text-white ">
                            Banner Management
                        </span>
                    </div>
                </a>
                
                {{-- <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            CI platform
        </div> --}}
    </nav>
</div>