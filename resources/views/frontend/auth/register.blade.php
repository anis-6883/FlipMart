@extends('frontend.include.app')

@section('title', 'Register')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Register</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content" style="margin-bottom: 30px">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">			

                <div class="col-md-6 col-sm-6 create-new-account">

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Please!</strong> {{ session('success') }}
                        </div>
                    @endif

                    <h4 class="checkout-subtitle">Sign Up Here</h4>
                    {{-- <p class="text title-tag-line">Create your new account.</p> --}}

                    <form action="{{ route('user.register') }}" method="POST" class="register-form outer-top-xs" role="form">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label class="info-title" for="email"><b>Email Address </b><span>*</span></label>
                            <input 
                                type="email" 
                                name="email"
                                class="form-control unicase-form-control text-input @error('email') {{ "is-invalid" }} @enderror" 
                                id="email" 
                                required
                                autofocus
                                autocomplete="off"
                                value="{{ old('email') }}"
                            />
                            @error('email')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="username"><b>Name </b><span>*</span></label>
                            <input 
                                type="text" 
                                name="username"
                                class="form-control unicase-form-control text-input @error('username') {{ "is-invalid" }} @enderror" 
                                id="username" 
                                required
                                autocomplete="off"
                                value="{{ old('username') }}"
                            />
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password"><b>Password </b><span>*</span></label>
                            <input 
                                type="password" 
                                name="password"
                                class="form-control unicase-form-control text-input @error('password') {{ "is-invalid" }} @enderror" 
                                id="password" 
                                required
                                autocomplete="off"
                                
                            />
                            @error('password')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password_confirmation"><b>Confirm Password </b><span>*</span></label>
                            <input 
                                type="password" 
                                name="password_confirmation"
                                class="form-control unicase-form-control text-input" 
                                id="password_confirmation" 
                                required
                                autocomplete="off"
                            />
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                    </form> 
                    <p style="margin-top: 15px">Have an account? <a href="{{ route('user.login') }}" class="text-primary text-decoration-none">Sign In </a> now</p>			
                </div>				
            </div><!-- /.row -->
		</div><!-- /.sigin-in-->
    </div>
</div>

@endsection