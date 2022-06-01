<!DOCTYPE html>
<html lang="en-US">

    @include('admin.include._head')

    <body>

        @include('admin.include._preloader')

        <!--**********************************
            Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

            @include('admin.include._nav-logo')

            @include('admin.include._top-nav')

            @include('admin.include._side-nav')

            @yield('content')

            @include('admin.include._footer')

        </div>
        <!--**********************************
        Main wrapper end
        ***********************************-->

        @include('admin.include._scripts')
        
    </body>
</html>