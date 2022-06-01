@extends('admin.include.app')

@section('title', 'Edit A Coupon')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Manage Coupon</a></li>
                <li class="breadcrumb-item active">Edit Coupon</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Coupon</h4>
                        <div class="basic-form">
                            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                
                                    <label class="col-sm-2 col-form-label">Coupon Title</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="coupon_title" 
                                            class="form-control @error('coupon_title') is-invalid @enderror" 
                                            placeholder="Enter Coupon Title..." 
                                            required autofocus autocomplete="off"
                                            value="{{ $coupon->coupon_title }}">

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
                                            required autocomplete="off"
                                            value="{{ $coupon->coupon_code }}">

                                        <div class="invalid-feedback">
                                            @error('coupon_code')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Type</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="discount_type" class="custom-select mr-sm-2" id="discount_type">
                                            <option {{ $coupon->discount_type == 'Percentage' ? "selected" : "" }}>Percentage</option>
                                            <option {{ $coupon->discount_type == 'Fixed' ? "selected" : "" }}>Fixed</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Amount</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="discount_amount" 
                                            class="form-control @error('discount_amount') is-invalid @enderror" 
                                            required autocomplete="off"
                                            value="{{ $coupon->discount_amount }}">

                                        <div class="invalid-feedback">
                                            @error('discount_amount')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Usable Per Person</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="usable_per_person" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="{{ $coupon->usable_per_person ?: "0" }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Usable In Total</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="usable_in_total" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="{{ $coupon->usable_in_total ?: "0" }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Coupon Start On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="coupon_start_date" name="coupon_start_date" type="text" autocomplete="off" value="{{ $coupon->coupon_start_date }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Coupon Ends On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="coupon_end_date" name="coupon_end_date" type="text" autocomplete="off" value="{{ $coupon->coupon_end_date }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="coupon_status" class="custom-select mr-sm-2" id="coupon_status">
                                            <option {{ $coupon->coupon_status == 'Active' ? "selected" : "" }}>Active</option>
                                            <option {{ $coupon->coupon_status == 'Inactive' ? "selected" : "" }}>Inactive</option>
                                        </select>
                                    </div>
                                        
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="edit_coupon" type="submit" class="btn btn-primary">Submit</button>
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