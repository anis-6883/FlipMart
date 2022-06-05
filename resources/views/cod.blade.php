@extends('include.app')

@section('title', 'Cash On Delivery')

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li>User</li>
          <li class="active">Cash On Delivery</li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Billing Information</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @if (Session::has('coupon'))
                                            <li><a>Subtotal({{ $cartQty }}): &nbsp&nbsp &#2547;{{ $cartTotal }}</a></li>
                                            <li><a>Coupon Title: &nbsp&nbsp {{ session()->get('coupon')['coupon_title'] }} ({{ session()->get('coupon')['discount_amount'] }}%)</a></li>
                                            <li><a>Shipping Fee: &nbsp&nbsp &#2547;50</a></li>
                                            <li><a>Grand Total: &nbsp&nbsp <b>&#2547;{{ session()->get('coupon')['total_price'] + 50 }}</b></a></li>
                                        @else
                                            <li><a>Subtotal({{ $cartQty }}): &nbsp&nbsp &#2547;{{ $cartTotal }}</a></li>
                                            <li><a>Shipping Fee: &nbsp&nbsp &#2547;50</a></li>
                                            <li><a>Grand Total: &nbsp&nbsp <b>&#2547;{{ $cartTotal + 50 }}</b></a></li>
                                        @endif
                                        
                                    </ul>		
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- checkout-progress-sidebar -->				
                </div>


                <div class="col-md-6">
					<!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Cash On Delivery</h4>
                                </div>

                                <form action="{{ route('checkout.codOrder') }}" method="POST" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                      <label for="card-element">
                                        <img width="120px" src="{{ asset('assets/frontend/images/payments/6.png') }}" alt="cod">
                                        <input name="username" type="hidden" value="{{ $arr['username'] }}">
                                        <input name="email" type="hidden" value="{{ $arr['email'] }}">
                                        <input name="phone" type="hidden" value="{{ $arr['phone'] }}">
                                        <input name="address" type="hidden" value="{{ $arr['address'] }}">
                                      </label>
                                    </div>
                                    <button style="margin-top: 15px" class="btn btn-primary" type="submit">
                                        Confirm Order Now
                                    </button>
                                </form>   

                            </div>
                        </div>
                    </div> 
                    <!-- checkout-progress-sidebar -->				
                </div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('include._brand-slider')
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection