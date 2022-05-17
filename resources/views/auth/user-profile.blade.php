@extends('include.app')

@section('title', 'My Profile')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>My Profile</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content" style="margin-bottom: 30px">
	<div class="container">
        <div class="row">

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has($msg))
                        <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session($msg) }}
                        </div>
                        @endif
            @endforeach 

            <div class="col-md-4">
                <h4>My Profile</h4>
                <p>Hi <b>{{ auth()->user()->username }}</b>, Welcome to your Profile!</p>
                <div class="thumbnail">
                    <img 
                        src="{{ url('/frontend_assets/images/testimonials/member1.png') }}" 
                        width="200px" 
                        height="100%" 
                        style="border-radius: 50%; margin-top: 15px"  
                        alt="profile"
                    >
                    <div class="caption">
                        <h3>Personal Info</h3>
                        <hr>
                        <p><b>Name:</b> {{ auth()->user()->username ?: "NULL" }}</p>
                        <p><b>Email:</b> {{ auth()->user()->email ?: "NULL" }}</p>
                        <p><b>Mobile:</b> {{ auth()->user()->mobile ?: "NULL" }}</p>
                        <p><b>Address:</b> {{ auth()->user()->address ?: "NULL" }}</p>
                        <p><b>Date Of Birth:</b> {{ auth()->user()->dob ?: "NULL" }}</p>
                        <p><b>Gneder:</b> {{ auth()->user()->gender ?: "NULL" }}</p>
                        <p>
                            <a href="{{ route('user.manageProfile') }}" class="btn btn-primary" role="button">Update Profile</a> 
                        </p>
                    </div>
                
                </div>

            </div>

        </div>
</div>

@endsection
