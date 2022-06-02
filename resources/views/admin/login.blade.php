<!DOCTYPE html>
<html class="h-100" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/backend/icons/admin-icon.png') }}">
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                @if (session()->has('error') or session()->has('logout'))
                                    <div class="alert alert-{{ (session()->has('error')) ? "danger" : "success" }} alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ session('error') ?: session('logout')}}</strong> 
                                    </div>
                                @endif

                                <h4>Admin Login</h4>
                                <form action="{{ route('admin.auth') }}" method="post" class="mt-5 mb-5 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input name="admin_email" type="email" class="form-control" placeholder="Email" autofocus autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="admin_password" type="password" class="form-control" placeholder="Password" autocomplete="off" required>
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/backend/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/settings.js') }}"></script>
    <script src="{{ asset('assets/backend/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/backend/js/styleSwitcher.js') }}"></script>
</body>
</html>