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
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path id="path"
                                d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
                        </svg>
                            <span class="font-weight-light" style="color: inherit">
                                User
                            </span>
                    </div>
                </a>

                <a class="nav-link" href="/cmspage">
                        <div id="cmspage" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path id="path"
                                d="M14.568.075c2.202 1.174 5.938 4.883 7.432 6.881-1.286-.9-4.044-1.657-6.091-1.179.222-1.468-.185-4.534-1.341-5.702zm7.432 10.925v13h-20v-24h8.409c4.857 0 3.335 8 3.335 8 3.009-.745 8.256-.419 8.256 3zm-16 5h5v-4h-5v4zm12 2h-12v1h12v-1zm0-3h-5v1h5v-1zm0-3h-5v1h5v-1z" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            CMS Page
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/mission">
                        <div id="mission" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path id="path"
                                d="M6 12c0 2.206 1.794 4 4 4 1.761 0 3.242-1.151 3.775-2.734l2.224-1.291.001.025c0 3.314-2.686 6-6 6s-6-2.686-6-6 2.686-6 6-6c1.084 0 2.098.292 2.975.794l-2.21 1.283c-.248-.048-.503-.077-.765-.077-2.206 0-4 1.794-4 4zm4-2c-1.105 0-2 .896-2 2s.895 2 2 2 2-.896 2-2l-.002-.015 3.36-1.95c.976-.565 2.704-.336 3.711.159l4.931-2.863-3.158-1.569.169-3.632-4.945 2.87c-.07 1.121-.734 2.736-1.705 3.301l-3.383 1.964c-.29-.163-.621-.265-.978-.265zm7.995 1.911l.005.089c0 4.411-3.589 8-8 8s-8-3.589-8-8 3.589-8 8-8c1.475 0 2.853.408 4.041 1.107.334-.586.428-1.544.146-2.18-1.275-.589-2.69-.927-4.187-.927-5.523 0-10 4.477-10 10s4.477 10 10 10c5.233 0 9.521-4.021 9.957-9.142-.301-.483-1.066-1.061-1.962-.947z" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            Mission
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missiontheme">
                        <div id="missiontheme" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg clip-rule="evenodd" width="17" height="17" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path id="path"
                                d="m11.6 11c0-.552-.448-1-1-1-1.655 0-4.945 0-6.6 0-.552 0-1 .448-1 1v9c0 .552.448 1 1 1h6.6c.552 0 1-.448 1-1 0-2.092 0-6.908 0-9zm9.4 6c0-.552-.448-1-1-1h-6c-.538 0-1 .477-1 1v3c0 .552.448 1 1 1h6c.552 0 1-.448 1-1zm0-13c0-.552-.448-1-1-1-1.537 0-4.463 0-6 0-.552 0-1 .448-1 1v9.6c0 .552.448 1 1 1h6c.552 0 1-.448 1-1 0-2.194 0-7.406 0-9.6zm-9.4 0c0-.552-.448-1-1-1-1.655 0-4.945 0-6.6 0-.552 0-1 .448-1 1v3.6c0 .552.448 1 1 1h6.6c.552 0 1-.448 1-1 0-1.017 0-2.583 0-3.6z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            Mission Theme
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/missionskill">
                        <div id="missionskill" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path id="path"
                                d="M23.27 19.743l-11.946-11.945c-.557-.557-.842-1.331-.783-2.115.115-1.485-.395-3.009-1.529-4.146-1.03-1.028-2.375-1.537-3.723-1.537-.507 0-1.015.072-1.506.216l3.17 3.17c.344 1.589-1.959 3.918-3.566 3.567l-3.17-3.17c-.145.492-.217 1-.217 1.509 0 1.347.51 2.691 1.537 3.721 1.135 1.136 2.66 1.646 4.146 1.53.783-.06 1.557.226 2.113.783l11.947 11.944c.468.468 1.103.73 1.763.73 1.368 0 2.494-1.108 2.494-2.494 0-.638-.244-1.276-.73-1.763zm-1.77 2.757c-.553 0-1-.448-1-1s.447-1 1-1 1 .448 1 1-.447 1-1 1zm-8.375-15.753l6.723-6.747 4.152 4.128-6.722 6.771-1.012-1.012 5.488-5.533c.165-.165.165-.435-.001-.602-.166-.165-.436-.165-.601 0l-5.489 5.533-.935-.936 5.495-5.539c.166-.166.166-.437 0-.603-.168-.166-.436-.166-.603.001l-5.494 5.539-1.001-1zm-3.187 9.521l-5.308 5.35c-.166.166-.437.166-.603 0-.165-.166-.166-.436 0-.602l5.308-5.351-.936-.935-5.301 5.343c-.165.168-.435.167-.601.001-.166-.167-.166-.436 0-.602l5.3-5.343-1.004-1.004-5.745 5.787-1.048 5.088 5.203-.937 5.743-5.786-1.008-1.009z" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            Mission skill
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/admin-mission-application">
                        <div id="admin-mission-application" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path id="path" d="M11 5c-1.629 0-2.305-1.058-4-3h-7v20h24v-17h-13z" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            Mission Application
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/admin-story">
                        <div id="admin-story" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg width="17" height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            clip-rule="evenodd">
                            <path id="path"
                                d="M22 24h-17c-1.657 0-3-1.343-3-3v-18c0-1.657 1.343-3 3-3h17v24zm-2-4h-14.505c-1.375 0-1.375 2 0 2h14.505v-2zm-3-15h-10v3h10v-3z" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            Story
                        </span>
                    </div>
                </a>
                <a class="nav-link" href="/banner">
                        <div id="banner" class='container px-3 py-2 rounded'>
                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                            <path id="path"
                                d="M9 21h-2v-21h2v21zm10.968-17.467c-2.714 0-2.775-2.533-5.926-2.533-1.15 0-2.242.393-3.042.84v10.16c.789-.688 2.058-1.289 3.053-1.289 2.976 0 3.394 2.41 6.046 2.41 1.713 0 2.901-1.189 2.901-1.189v-9.65s-1.309 1.251-3.032 1.251zm-8.968 14.759v1.834c.644.129 1.177.303 1.496.528.273.192.274.498 0 .69-1.494 1.053-7.498 1.054-8.993 0-.272-.191-.271-.499 0-.69.319-.225.852-.399 1.497-.528v-1.833c-2.363.481-4 1.511-4 2.707 0 1.657 3.134 3 7 3s7-1.343 7-3c0-1.196-1.637-2.226-4-2.708z" />
                        </svg>
                        <span class="font-weight-light" style="color: inherit">
                            Banner Management
                        </span>
                    </div>
                </a>
    </nav>
</div>
