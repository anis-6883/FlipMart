@extends('include.app')

@section('title', 'Update Password')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Update Password</li>
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

                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has($msg))
                            <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session($msg) }}
                            </div>
                          @endif
                    @endforeach     

                    <h4>Change Password</h4>
                    <p>Hi Buddy, Update Your Password!</p>

                    <form action="{{ route('user.changePassword') }}" method="POST" class="register-form outer-top-xs">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="curr_password"><b>Current Password </b><span>*</span></label>
                            <input 
                                type="password" 
                                name="curr_password"
                                class="form-control unicase-form-control text-input @error('curr_password') {{ "is-invalid" }} @enderror" 
                                id="curr_password" 
                                required
                                autocomplete="off"
                                autofocus
                            />
                            @error('curr_password')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
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
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Change Password</button>
                    </form>	
                </div>
            </div>
		</div>
    </div>
</div>

@endsection
