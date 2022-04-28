@extends('include.auth-app')
@section('title', 'User Login')
@section('content')

<div style="height: 100vh" class="row w-100 d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-center">
                <h3 class="text-light">User Login</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.authenticate') }}" method="POST">
                @csrf
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input
                    name="email"
                    type="email"
                    class="form-control @error('email') {{ "is-invalid" }} @enderror"
                    id="email"
                    value="{{ $arr['user_login_email'] }}"
                    required
                    />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                    name="password"
                    type="password"
                    class="form-control @error('password') {{ "is-invalid" }} @enderror"
                    id="password"
                    value="{{ $arr['user_login_pass'] }}"
                    required
                    />
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      id="remember_me"
                      name="remember_me"
                      {{ $arr['is_remember'] }}
                    />
                    <label class="form-check-label" for="remember_me"
                      >Remember Me</label
                    >
                </div>

                <button type="submit" class="btn btn-dark btn-sm">
                    <i style="font-size: 16px" class="far">&#xf1d8;</i> Login
                </button>
                </form>
                <p class="mt-3">Need an Account? <a href="{{ route('user.create') }}" class="text-primary text-decoration-none">Sign Up </a> now</p>
            </div>
        </div>
    </div>
</div>

@endsection


