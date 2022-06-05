@extends('include.app')

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
                                    <td>{{ $order->order_number }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $order->username }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Email</th>
                                    <td>{{ $order->email }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Phone</th>
                                    <td>{{ $order->phone }}</td>
                                </tr>

                                <tr>
                                    <th>Customer Address</th>
                                    <td>{{ $order->address }}</td>
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
                                    <td>{{ $order->invoice_no }}</td>
                                </tr>

                                <tr>
                                    <th>Transaction No.</th>
                                    <td>{{ $order->transaction_id }}</td>
                                </tr>

                                <tr>
                                    <th>Payment Type</th>
                                    <td>{{ $order->payment_type }}</td>
                                </tr>

                                <tr>
                                    <th>Total Amount</th>
                                    <td><b>&#2547; {{ $order->amount }}</b></td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td><span class="badge badge-pill badge-secondary">{{ $order->order_status }}</span></td>
                                </tr>

                                <tr>
                                    <th>Action</th>
                                    <td> 
                                        <button id="" onclick="" class="btn btn-warning btn-sm">
                                            <i class="icon fa fa-download"></i> Invoice
                                        </button>
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
                                        <td>{{ $item->product->product_name }}</td>
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
                                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>





        </div>

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('include._brand-slider')
        <!-- /.brand-slider --> 
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

    </div><!-- /.container -->
</div><!-- /.body-content -->

<br>

@endsection