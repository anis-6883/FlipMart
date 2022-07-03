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
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                
                                    <label class="col-sm-2 col-form-label">Coupon Title</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="coupon_title" 
                                            class="form-control @error('coupon_title') is-invalid @enderror" 
                                            placeholder="Enter Coupon Title..." 
                                            required autofocus autocomplete="off" value="{{ old('coupon_title') }}">

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

                                    <label class="col-sm-2 col-form-label">Discount Type</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="discount_type" class="custom-select mr-sm-2" id="discount_type">
                                            <option selected>Percentage</option>
                                            <option>Fixed</option>
                                        </select>
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

                                    <label class="col-sm-2 col-form-label">Usable Per Person</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="usable_per_person" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="0">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Usable In Total</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="usable_in_total" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="0">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Coupon Start On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control jqdatepicker" id="coupon_start_date" name="coupon_start_date" type="text" autocomplete="off" value=""/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Coupon Ends On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control jqdatepicker" id="coupon_end_date" name="coupon_end_date" type="text" autocomplete="off" value=""/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="coupon_status" class="custom-select mr-sm-2" id="coupon_status">
                                            <option>Active</option>
                                            <option selected>Inactive</option>
                                        </select>
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