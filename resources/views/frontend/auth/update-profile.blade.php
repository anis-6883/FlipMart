@extends('frontend.app')

@section('title', 'Update Profile')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Update Profile</li>
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

                    <h4 class="">Update Profile</h4>
                    <p class="">Hi Buddy, Update Your Personal Information!</p>

                    <form action="{{ route('user.manageProfile') }}" method="POST" class="register-form outer-top-xs">
                        @csrf
                        @method('POST')
                        
                        <div class="form-group">
                            <label class="info-title" for="mobile"><b>Mobile Number</b></label>
                            <input 
                                name="mobile" 
                                type="text" 
                                class="form-control unicase-form-control text-input @error('mobile') {{ "is-invalid" }} @enderror" 
                                id="mobile"
                                required
                                autofocus
                                value="{{ $arr['mobile'] }}"
                            />
                            @error('mobile')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="address"><b>Address</b></label>
                            <input 
                                name="address" 
                                type="text" 
                                class="form-control unicase-form-control text-input @error('address') {{ "is-invalid" }} @enderror" 
                                id="address"
                                required
                                value="{{ $arr['address'] }}"
                            />
                            @error('address')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="dob"><b>Date of Birth</b></label>
                            <input 
                                name="dob" 
                                type="date" 
                                class="form-control unicase-form-control text-input @error('dob') {{ "is-invalid" }} @enderror" 
                                id="dob"
                                required
                                value="{{ $arr['dob'] }}"
                            />
                            @error('dob')
                                <div class="invalid-feedback" style="color: red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="gneder"><b>Gender</b></label>
                            <select class="form-control" name="gender" id="gender">
                                <option @if ($arr['gender'] == 'Male') {{ "selected" }} @endif>Male</option>
                                <option @if ($arr['gender'] == 'Female') {{ "selected" }} @endif>Female</option>
                                <option @if ($arr['gender'] == 'Other') {{ "selected" }} @endif>Other</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update Profile</button>
                    </form>	
                </div>
            </div>
		</div>
    </div>
</div>

@endsection
