@extends('include.auth-app')
@section('title', 'User Registration')
@section('content')

<div style="height: 100vh" class="row w-100 d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-center">
                <h3 class="text-light">User Registration</h3>
            </div>
            <div class="card-body">
                <form accept="{{ route('user.store') }}" method="POST">
                @csrf
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Please!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input
                    name="username"
                    type="text"
                    class="form-control @error('username') {{ "is-invalid" }} @enderror"
                    id="username"
                    required
                    autofocus
                    autocomplete="off"
                    value="{{ old('username') }}"
                    />
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input
                    name="email"
                    type="email"
                    class="form-control @error('email') {{ "is-invalid" }} @enderror"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input
                    name="password"
                    type="password"
                    class="form-control @error('password') {{ "is-invalid" }} @enderror"
                    id="password"
                    required
                    />
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label"
                    >Confirm Password</label
                    >
                    <input
                    name="password_confirmation"
                    type="password"
                    class="form-control"
                    id="password"
                    required
                    />
                </div>

                <button type="submit" class="btn btn-dark btn-sm">
                    <i style="font-size: 16px" class="far">&#xf1d8;</i> Submit
                </button>
                </form>
                <p class="mt-3">Have an account? <a href="{{ route('user.login') }}" class="text-primary text-decoration-none">Sign In </a> now</p>
            </div>
        </div>
    </div>
</div>

@endsection


