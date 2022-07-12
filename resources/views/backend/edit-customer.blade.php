@extends('backend.master')

@section('title', 'Edit A Customer')

@section('custom_css')

    <!-- jqueryui date picker -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery-ui.css') }}">

@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.list') }}">Manage Customer</a></li>
                <li class="breadcrumb-item active">Edit Customer</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Customer</h4>

                        <div class="basic-form">
                            <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="username" 
                                            class="form-control @error('username') is-invalid @enderror" 
                                            required autofocus autocomplete="off" value="{{ $customer->username }}">

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
                                            required autocomplete="off" value="{{ $customer->email }}">

                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea class="form-control" name="address">{{ $customer->address }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="mobile" 
                                            class="form-control" 
                                            autocomplete="off" value="{{ $customer->mobile }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Date Of Birth</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="dob" name="dob" type="text" autocomplete="off" value="{{ $customer->dob }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="gender" class="custom-select mr-sm-2" id="customer_gender">
                                            <option {{ $customer->gender == "Male" ? "selected" : "" }}>Male</option>
                                            <option {{ $customer->gender == "Female" ? "selected" : "" }}>Female</option>
                                            <option {{ $customer->gender == "Other" ? "selected" : "" }}>Other</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="status" class="custom-select mr-sm-2" id="customer_status">
                                            <option {{ $customer->status == "Active" ? "selected" : "" }}>Active</option>
                                            <option {{ $customer->status == "Inactive" ? "selected" : "" }}>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="edit_customer" type="submit" class="btn btn-primary">Submit</button>
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