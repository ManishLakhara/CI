<style>
    #layoutSidenav_nav {
  position: absolute;
  top: 0;
  height: 100%;
}
</style>
<div class="navbar-collapse" id="layoutSidenav_nav">
    <button type="button" style="top:1em;right:1em;z-index:999;" class="btn-close position-absolute navbar-close" aria-label="Close"></button>
    <nav class="sb-sidenav accordion sb-sidenav zindex-sticky bg-orange" data-bs-backdrop='true' id="sidenavAccordion">
        <div class="sb-sidenav-menu align-content-center" style="z-index: 10">
            <div class="nav">
                <div class="text-white fs-6 pl-3">NAVIGATION</div>
                <a class="nav-link" href="{{route('user.index')}}">
                        <div id="user" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-user"></i>
                            <span class="font-weight-light pl-3" style="color: inherit">
                                User
                            </span>
                    </div>
                </a>

                <a class="nav-link" href="/cmspage">
                        <div id="cmspage" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-file"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            CMS Page
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/mission">
                        <div id="mission" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-bullseye"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            Mission
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missiontheme">
                        <div id="missiontheme" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-palette"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            Mission Theme
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missionskill">
                        <div id="missionskill" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-tools"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            Mission skill
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/admin-mission-application">
                        <div id="admin-mission-application" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-folder"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            Mission Application
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/admin-story">
                        <div id="admin-story" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-book"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            Story
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/banner">
                        <div id="banner" class='container px-3 py-3 rounded fs-5'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <i class="fas fa-flag"></i>
                        <span class="font-weight-light pl-3" style="color: inherit">
                            Banner Management
                        </span>
                    </div>
                </a>
    </nav>
</div>
