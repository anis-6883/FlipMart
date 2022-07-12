@extends('backend.master')

@section('title', 'Add New Admin')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.list') }}">Manage Admin</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.create') }}">Add Admin</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Admin</h4>
                        <div class="basic-form">
                            <form action="{{ route('admin.create') }}" method="POST">
                                @csrf
                                @method('POST')
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Admin Fullname</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="admin_fullname" 
                                            class="form-control @error('admin_fullname') is-invalid @enderror" 
                                            required autofocus autocomplete="off" value="{{ old('admin_fullname') }}">

                                        <div class="invalid-feedback">
                                            @error('admin_fullname')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Admin Email</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="email" 
                                            name="admin_username" 
                                            class="form-control @error('admin_username') is-invalid @enderror" 
                                            required autocomplete="off" value="{{ old('admin_username') }}">

                                        <div class="invalid-feedback">
                                            @error('admin_username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Admin Password</label>
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

                                    <label class="col-sm-2 col-form-label">Admin Type</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="admin_type_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            @foreach ($admin_types as $type)
                                                <option value="{{ $type->id }}">{{ $type->admin_typename }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Admin Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="admin_status" class="custom-select mr-sm-2" id="admin_status">
                                            <option>Active</option>
                                            <option selected>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_admin" type="submit" class="btn btn-primary">Submit</button>
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
