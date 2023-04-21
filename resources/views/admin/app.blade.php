<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.head')
    <body class="sb-nav-fixed">

        @include('admin.layouts.header')
        <div id="layoutSidenav">
            @include('admin.layouts.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @yield('body')
                </main>
                {{-- //@include('admin.layouts.footer') --}}
            </div>
        </div>
        @include('admin.layouts.scripts')
        @stack('script')
    </body>
    <script>
        var currentpath = window.location.pathname.split('/')[1];
        $('#'+currentpath).addClass('active');
        $(window).on('resize', function() {
            var windowWidth = $(window).width();
            if(windowWidth >= 768){
                $('#sb-sidenav').show();
            }
            if(windowWidth >=992){
                $('.sb-nav-fixed').removeClass('sb-sidenav-toggled');
            }
        });
        $('.navbar-close').on('click', function(){
            $('.sb-nav-fixed').removeClass('sb-sidenav-toggled');
        });
    </script>

</html>
