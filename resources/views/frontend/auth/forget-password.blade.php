@extends('frontend.app')

@section('title', 'Forget Password')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Forget Password</li>
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

                    <h4 class="">Forget Password</h4>
                    <p class="">Hi Buddy, Forget Your Password. Chill Bro!</p>

                    <form action="{{ route('user.forgetPassword') }}" method="POST" class="register-form outer-top-xs">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="forget_email"><b>Email Address </b><span>*</span></label>
                            <input 
                                name="forget_email" 
                                type="email" 
                                class="form-control unicase-form-control text-input" 
                                id="forget_email"
                                autofocus
                                autocomplete="off"
                                required
                            />
                        </div> 
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password Reset Link</button>
                    </form>	
                </div>
            </div>
		</div>
    </div>
</div>

@endsection
