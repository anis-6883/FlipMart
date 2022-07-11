@extends('frontend.app')

@section('title', 'User Order Details')

@section('custom_css')
    <style>
        #user-order-details th{
            text-align: center !important;
        }

        #loadMyOrder td{
            text-align: center;
        }
    </style>
@endsection

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li>User</li>
          <li class="active">Order Details</li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 20px; font-weight: 600;">Shipping Details</div>
                    <div class="card-body" style="margin-top: 30px">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <th>Order No.</th>
                                    <td>{{ $order->order_detail->order_number }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $order->order_detail->username }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Email</th>
                                    <td>{{ $order->order_detail->email }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Phone</th>
                                    <td>{{ $order->order_detail->phone }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Address</th>
                                    <td>{{ $order->order_detail->address }}</td>
                                </tr>

                                <tr>
                                    <th>Order Date</th>
                                    <td>{{ date('d M, Y', strtotime($order->order_date))  }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-size: 20px; font-weight: 600;">Order Details</div>
                    <div class="card-body" style="margin-top: 30px">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <th>Invoice No.</th>
                                    <td>{{ $order->order_detail->invoice_no }}</td>
                                </tr>

                                <tr>
                                    <th>Transaction No.</th>
                                    <td>{{ $order->order_detail->transaction_id }}</td>
                                </tr>

                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ $order->order_detail->payment_method }}</td>
                                </tr>

                                @if ($order->discount_coupon != NULL)
                                    <tr>
                                        <th>Coupon Name</th>
                                        <td>{{ $order->order_detail->discount_coupon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Coupon Amount</th>
                                        <td>&#2547; {{ $order->order_detail->discount_amount }}</td>
                                    </tr>
                                @endif
                                
                                <tr>
                                    <th>Total Amount</th>
                                    <td><b>&#2547; {{ $order->order_detail->grand_total }}</b></td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($order->order_status != "Delivered")
                                            <span class="badge badge-pill" style="background-color: #0dcaf0; color: #000">{{ $order->order_status }}</span>
                                        @else
                                            <span class="badge badge-pill" style="background-color: #198754; color: #fff">{{ $order->order_status }}</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Action</th>
                                    <td> 
                                        <a href="{{ route('user.invoiceDownload', $order->id) }}" target="_blank" class="btn btn-warning btn-sm">
                                            <i class="icon fa fa-download"></i> Invoice
                                        </a>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="font-size: 20px; font-weight: 600;">Order Items</div>
                    <div class="card-body" style="margin-top: 30px">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Product Color</th>
                                    <th>Product Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                </tr>
                                

                                @foreach ($order_items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->product->product_detail->product_name }}</td>
                                        <td>
                                            @if ($item->product->product_detail->product_master_image != null)
                                                <img id="master_img" src="{{ asset('uploads/products/' . $item->product->product_detail->product_master_image) }}" alt="No Image" width="80px" height="80px">  
                                            @else
                                                <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                            @endif
                                        </td>
                                        <td>{{ $item->color ?: 'NULL' }}</td>
                                        <td>{{ $item->size ?: 'NULL' }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>&#2547; {{ $item->product->product_detail->product_regular_price }}</td>
                                        <td>{{ $item->product->product_detail->discounted_pct ?: '0' }}%</td>
                                    </tr>
                                @endforeach
                                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if ($order->order_status == 'Delivered')
                <div class="col-md-12">
                    <div class="card">
                        <form action="">
                            <div class="form-group">
                                <label for="return_order" class="form-label">Order Return Reason:</label>
                                <textarea class="form-control" name="return_order" id="return_order" cols="30" rows="10" placeholder="Write your complain..."></textarea>
                            </div>
                            <button class="btn btn-primary btn-sm" type="submit">Sent</button>
                        </form>
                    </div>
                </div>
            @endif
            

        </div>

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.include._brand-slider')
        <!-- /.brand-slider --> 
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

    </div><!-- /.container -->
</div><!-- /.body-content -->

<br>

@endsection