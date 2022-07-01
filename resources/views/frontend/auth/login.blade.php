@extends('frontend.include.app')

@section('title', 'Login')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content" style="margin-bottom: 30px">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
                <!-- Sign-in -->	

                <div class="col-md-6 col-sm-6 sign-in">

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <h4 class="">Sign in Now</h4>
                    {{-- <p class="">Hello, Welcome To Your Account...❤️</p> --}}

                    <div class="social-sign-in outer-top-xs">
                        <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                        <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                    </div>

                    <form action="{{ route('user.authenticate') }}" method="POST" class="register-form outer-top-xs">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="login_email"><b>Email Address </b><span>*</span></label>
                            <input 
                                name="login_email" 
                                type="email" 
                                class="form-control unicase-form-control text-input @error('login_email') {{ "is-invalid" }} @enderror" 
                                id="login_email"
                                value="{{ $arr['user_login_email'] ?: old('login_email') }}"
                                autofocus
                                autocomplete="off"
                            />
                            @error('login_email')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label class="info-title" for="login_pass"><b>Password </b><span>*</span></label>
                            <input 
                                type="password"
                                name="login_pass" 
                                class="form-control unicase-form-control text-input @error('login_pass') {{ "is-invalid" }} @enderror" 
                                id="login_pass"
                                value="{{ $arr['user_login_pass'] ?: "" }}"
                            />
                            @error('login_pass')
                                <div class="invalid-feedback" style="color: red">
                                        {{ $messages }}
                                </div>
                            @enderror
                        </div>
                        <div class="radio outer-xs">
                            <label>
                                <input 
                                    type="checkbox" 
                                    name="remember_me" 
                                    id="remember_me"
                                    {{ $arr['is_remember'] }}
                                /> Remember me!
                            </label>
                            <a href="{{ route('user.forgetPassword') }}" class="forgot-password pull-right">Forgot your Password?</a>
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                    </form>	
                    <p style="margin-top: 15px">Need an Account? <a href="{{ route('user.register') }}" class="text-primary text-decoration-none">Sign Up </a> now</p>				
                </div>
            </div>
		</div>
    </div>
</div>

@endsection
