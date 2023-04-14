<style>
    #layoutSidenav_nav {
  position: absolute;
  top: 0;
  height: 100%;
}
</style>
<div class="navbar-collapse" id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav zindex-sticky bg-orange"  id="sidenavAccordion">
        <div class="sb-sidenav-menu align-content-center" style="z-index: 10">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-white">NAVIGATION</div>
                <a class="nav-link" href="{{route('user.index')}}">
                        <div id="user" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                            <i class="fa-solid fa-user" style="color: inherit"></i>
                            <span class="font-weight-light" style="color: inherit">
                                User
                            </span>
                    </div>
                </a>

                <a class="nav-link" href="/cmspage">
                        <div id="cmspage" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-pen-to-square" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            CMS Page
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/mission">
                        <div id="mission" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-bullseye" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            Mission
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missiontheme">
                        <div id="missiontheme" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-folder" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            Mission Theme
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missionskill">
                        <div id="missionskill" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-folder" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            Mission skill
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/admin-mission-application">
                        <div id="admin-mission-application" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-solid fa-folder" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            Mission Application
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/admin-story">
                        <div id="admin-story" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-brands fa-canadian-maple-leaf" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            Story
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/banner">
                        <div id="banner" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fa-brands fa-canadian-maple-leaf" style="color: inherit"></i>
                        <span class="font-weight-light" style="color: inherit">
                            Banner Management
                        </span>
                    </div>
                </a>
    </nav>
</div>
