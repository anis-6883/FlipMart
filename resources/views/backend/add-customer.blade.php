@extends('backend.master')

@section('title', 'Add New Customer')

@section('custom_css')

    <!-- jqueryui date picker -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery-ui.css') }}">

@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.list') }}">Manage Customer</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('customer.create') }}">Add Customer</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Customer</h4>
                        <div class="basic-form">
                            <form action="{{ route('customer.create') }}" method="POST">
                                @csrf
                                @method('POST')
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="username" 
                                            class="form-control @error('username') is-invalid @enderror" 
                                            required autofocus autocomplete="off" value="{{ old('username') }}">

                                        <div class="invalid-feedback">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="email" 
                                            name="email" 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            required autocomplete="off" value="{{ old('email') }}">

                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="password" 
                                            name="password" 
                                            class="form-control @error('password') is-invalid @enderror" 
                                            required autocomplete="off" value="{{ old('password') }}">

                                        <div class="invalid-feedback">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Password Confirmation</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            class="form-control" 
                                            required autocomplete="off">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea class="form-control" name="address">{{ old('address') }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="mobile" 
                                            class="form-control" 
                                            autocomplete="off" value="{{ old('mobile') }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Date Of Birth</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="dob" name="dob" type="text" autocomplete="off" value="{{ old('dob') }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="gender" class="custom-select mr-sm-2" id="customer_gender">
                                            <option selected>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="status" class="custom-select mr-sm-2" id="customer_status">
                                            <option>Active</option>
                                            <option selected>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_customer" type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')

    <!-- jqueryui date picker -->
    <script src="{{ asset('assets/backend/js/jQuery/jquery-ui.js') }}"></script>

    <!-- jqueryui date picker -->
    <script>
    $( function() {
    $( ".jqdatepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: '2000:2025'
        });
    });
    </script>

@endsection