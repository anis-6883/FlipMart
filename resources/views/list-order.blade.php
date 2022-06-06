@extends('include.app')

@section('title', 'User Order List')

@section('custom_css')
    <style>
        .user-order-list th{
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
          <li class="active">Orders</li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="my-wishlist-page">
			<div class="row">

                @if (count($orders) > 0)

                    <div class="col-md-12 user-order-list">
                        <h4>My Order ({{ count($orders) }})</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Total Item</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="loadMyOrder">

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="col-md-2">{{ $order->order_number }}</td>
                                            <td class="col-md-2">{{ count($order->order_items) }}</td>
                                            <td class="col-md-2"><b>&#2547; {{ $order->amount }}</b></td>
                                            <td class="col-md-2">
                                                <span class="badge badge-pill badge-secondary">{{ $order->order_status }}</span>
                                            </td>
                                            <td class="col-md-1 close-btn">
                                                <div style="display: flex; justify-content: center;">
                                                    <a href="{{ route('user.orderDetails', $order->id) }}" class="btn btn-primary btn-sm" style="margin-right: 5px">
                                                        <i class="icon fa fa-eye"></i> Details </a>
                                                    <a target="_blank" href="{{ route('user.invoiceDownload', $order->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="icon fa fa-download"></i> Invoice
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>	

                @else

                    <div class="col-md-12">
                        <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No Order Processing Yet!</h1>
                            <p class="lead">There are no order yet. Add your products to cart and purchased...</p>
                            <p><a href="{{ route('home') }}">Go TO Home</a></p>
                        </div>
                        </div>
                    </div>

                @endif

            </div><!-- /.row -->
		</div><!-- /.my-wishlist-page-->

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('include._brand-slider')
        <!-- /.brand-slider --> 
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

    </div><!-- /.container -->
</div><!-- /.body-content -->

<br>

@endsection