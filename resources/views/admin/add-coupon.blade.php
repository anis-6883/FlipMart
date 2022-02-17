@extends('admin.include.app')

@section('title', 'Add New Coupon')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Manage Coupon</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('coupon.create') }}">Add Coupon</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Coupon</h4>
                        <div class="basic-form">
                            <form action="{{ route('coupon.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                
                                    <label class="col-sm-2 col-form-label">Coupon Title</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="coupon_title" 
                                            class="form-control @error('coupon_title') is-invalid @enderror" 
                                            placeholder="Enter Coupon Title..." 
                                            required autofocus autocomplete="off">

                                        <div class="invalid-feedback">
                                            @error('coupon_title')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Coupon Code</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="coupon_code" 
                                            class="form-control @error('coupon_code') is-invalid @enderror" 
                                            placeholder="Enter Coupon Code..." 
                                            required autocomplete="off">

                                        <div class="invalid-feedback">
                                            @error('coupon_code')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Amount</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="discount_amount" 
                                            class="form-control @error('discount_amount') is-invalid @enderror" 
                                            required autocomplete="off">

                                        <div class="invalid-feedback">
                                            @error('discount_amount')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_coupon" type="submit" class="btn btn-primary">Submit</button>
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
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection