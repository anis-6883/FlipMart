@extends('admin.include.app')

@section('title', 'Edit A Order')

@section('content')

<!--**********************************
        Content body start
    ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.orderIndex') }}">Manage Order</a></li>
                <li class="breadcrumb-item active">Edit A Order</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Order</h4>
                        <div class="basic-form">
                            <form action="{{ route('admin.orderUpdate', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Order Date</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" class="form-control" value="{{ date('d M, Y', strtotime($order->order_date)) }}" disabled>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Invoice No.</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" class="form-control" value="{{ $order->invoice_no }}" disabled>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Order Amount</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" class="form-control" value="&#2547;{{ $order->grand_total }}" disabled>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Order Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="order_status" class="custom-select mr-sm-2" id="order_status">
                                            <option {{ $order->order_status == 'Pending' ? 'selected' : '' }} >Pending</option>
                                            <option {{ $order->order_status == 'Processing' ? 'selected' : '' }} >Processing</option>
                                            <option {{ $order->order_status == 'Halt' ? 'selected' : '' }} >Halt</option>
                                            <option {{ $order->order_status == 'Shipping' ? 'selected' : '' }} >Shipping</option>
                                            <option {{ $order->order_status == 'Delivered' ? 'selected' : '' }} >Delivered</option>
                                            <option {{ $order->order_status == 'Completed' ? 'selected' : '' }} >Completed</option>
                                            <option {{ $order->order_status == 'Cancelled' ? 'selected' : '' }} >Cancelled</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="edit_order" type="submit" class="btn btn-primary">Submit</button>
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

