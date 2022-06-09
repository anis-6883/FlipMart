@extends('admin.include.app')

@section('title', 'Order Details')

@section('css')
<style>
    .table td,
    .table th {
        min-width: 80px;
        text-align: center;
    }
</style>
@endsection

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.orderIndex') }}">Manage Order</a></li>
                <li class="breadcrumb-item active">Order Details</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        
        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Shipping Details</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Attribute</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Order No.</td>
                                        <td><span>{{ $order->order_number }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <td>Order Date</td>
                                        <td>{{ date('d M, Y', strtotime($order->order_date))  }}</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Customer Name</td>
                                        <td><b>{{ $order->username }}</b></td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Customer Email</td>
                                        <td><b>{{ $order->email }}</b></td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>Customer Phone</td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <td>Customer Address</td>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Order Details</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Attribute</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Invoice No.</td>
                                        <td>{{ $order->invoice_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>Transaction No.</td>
                                        <td>{{ $order->transaction_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>Payment Type</td>
                                        <td>{{ strtoupper($order->payment_type) }}</td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>Payment Method</td>
                                        <td>{{ $order->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <td>Total Amount</td>
                                        <td><b>&#2547; {{ $order->grand_total }}</b></td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <td>Status</td>
                                        <td>
                                            @if ($order->order_status != "Delivered")
                                                <span class="label gradient-9 btn-rounded">{{ $order->order_status }}</span>
                                                <a class="btn btn-info btn-xs mr-2" href="{{ route('admin.orderEdit', $order->id) }}">Edit</a>
                                            @else
                                                <span class="label gradient-2 btn-rounded">{{ $order->order_status }}</span>
                                                <a class="btn btn-info btn-xs mr-2" href="{{ route('admin.orderEdit', $order->id) }}">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
        
        
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Order Items</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($order_items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td width="25%">{{ $item->product->product_name }}</td>
                                            <td>
                                                @if ($item->product->product_master_image != null)
                                                    <img id="master_img" src="{{ asset('uploads/products/' . $item->product->product_master_image) }}" alt="No Image" width="80px" height="80px">  
                                                @else
                                                    <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                                @endif
                                            </td>
                                            <td>{{ $item->product->product_color ?: 'NULL' }}</td>
                                            <td>{{ $item->product->product_size ?: 'NULL' }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>&#2547; {{ $item->product->product_regular_price }}</td>
                                            <td>{{ $item->product->product_discounted_price ?: '0' }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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