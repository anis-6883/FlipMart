@extends('frontend.app')

@section('title', 'Reset Your Password')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Reset Password</li>
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

                    <h4 class="">Reset Password</h4>
                    <p class="">Hi Buddy, Reset Your Password!</p>

                    <form action="{{ route('user.resetConfirm') }}" method="POST" class="register-form outer-top-xs">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label class="info-title" for="email"><b>Email Address </b><span>*</span></label>
                            <input 
                                name="email" 
                                type="email" 
                                class="form-control unicase-form-control text-input" 
                                id="email"
                                required
                                readonly
                                value="{{ $arr['email'] }}"
                            />
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password"><b>New Password </b><span>*</span></label>
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
                                name="password_confirmation" 
                                type="password" 
                                class="form-control unicase-form-control text-input" 
                                id="password_confirmation"
                                autocomplete="off"
                                required
                            />
                        </div>  
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
                    </form>	
                </div>
            </div>
		</div>
    </div>
</div>

@endsection
