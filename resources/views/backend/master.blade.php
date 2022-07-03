<!DOCTYPE html>
<html lang="en-US">

    @include('backend.include._head')

    <body>

        @include('backend.include._preloader')

        <!--**********************************
            Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

            @include('backend.include._nav-logo')

            @include('backend.include._top-nav')

            @include('backend.include._side-nav')

            <div class="content-body">
                @yield('content')
            </div>

            @include('backend.include._footer')

        </div>
        <!--**********************************
        Main wrapper end
        ***********************************-->

        @include('backend.include._scripts')
        
    </body>
</html>