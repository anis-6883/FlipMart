@extends('include.app')

@section('title', 'Checkout Page')

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li>User</li>
          <li class="active">Chechout</li>
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

				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">

                                    <div class="row">		

<!-- Start Cart Items -->			
<div class="col-md-12 col-sm-12">
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="loadMyCart">
                @foreach ($carts as $item)
                    <tr>
                        <td><img width="100px" height="100px" src="{{ asset('uploads/products/' . $item->options->image) }}" alt="Product Image"></td>
                        <td>
                            <div class="product-name">
                                <a href="#">
                                    {{ Str::of($item->name)->limit(40) }}
                                </a>
                            </div>

                            <div class="price"> 
                                    &#2547;{{ $item->price }}
                                    <span><del>&#2547;{{ $item->options->discounted_price }}</del></span>
                            </div>            
                            <!-- /.product-price --> 
                        </td>
                        <td>
                            {{ $item->options->color ?: "---"}}
                        </td>
                        <td>
                            {{ $item->options->size ?: "---"}}
                        </td>

                        <td>
                            <b>({{ $item->qty }})</b>
                        </td>

                        <td>
                            <b>&#2547;{{ $item->subtotal }}</b>
                        </td>
                        
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
        
</div>
<!-- Start Cart Items -->	


                                    </div>	
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->
					  	
					</div><!-- /.checkout-steps -->
				</div>

				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Billing Address</h4>
                            </div>

                            <form class="register-form" action="{{ route('checkout.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title" for="username">Shipping Name <span>*</span></label>
                                    <input name="username" type="text" value="{{ Auth::user()->username }}" class="form-control unicase-form-control text-input" id="username" required>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address <span>*</span></label>
                                    <input name="email" type="email" value="{{ Auth::user()->email }}" class="form-control unicase-form-control text-input" id="email" required>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone <span>*</span></label>
                                    <input name="phone" type="text" class="form-control unicase-form-control text-input" id="phone" required>
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="phone">District <span>*</span></label>
                                    <select id="select_district" class="form-control" aria-label="Default select example" required>
                                        <option selected value="">Select District</option>
                                        <option value="1">In Dhaka (Charge: &#2547;50)</option>
                                        <option value="2">Others (Charge: &#2547;70)</option>
                                    </select>
                                </div>
                        
                                <div class="form-group">
                                    <label class="info-title" for="address">Address <span>*</span></label>
                                    <textarea name="address" type="" class="form-control unicase-form-control text-input" id="address" required></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Stripe</label>
                                            <input type="radio" name="payment_method" value="stripe" required>
                                            <img src="{{ asset('assets/frontend/images/payments/4.png') }}" alt="">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Card</label>
                                            <input type="radio" name="payment_method" value="card" required>
                                            <img src="{{ asset('assets/frontend/images/payments/3.png') }}" alt="">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Cash</label>
                                            <input type="radio" name="payment_method" value="cash" required>
                                            <img width="36px" src="{{ asset('assets/frontend/images/payments/6.png') }}" alt="cod">
                                        </div>
                                    </div>     
                                </div>
                              
                            <hr>

                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Billing Information</h4>
                            </div>
                            <div class="">
                                <ul class="nav nav-checkout-progress list-unstyled">
                                    @if (Session::has('coupon'))
                                        <li><a>Subtotal({{ $cartQty }}): &nbsp&nbsp &#2547;{{ $cartTotal }}</a></li>
                                        <li><a>Coupon Title: &nbsp&nbsp {{ session()->get('coupon')['coupon_title'] }} ({{ session()->get('coupon')['discount_amount'] }}%)</a></li>
                                        {{-- <li><a>Shipping Fee: &nbsp&nbsp &#2547;50</a></li> --}}
                                        <li><a>Grand Total: &nbsp&nbsp <b>&#2547;{{ session()->get('coupon')['total_price'] + 50 }}</b></a></li>
                                    @else
                                        <li><a>Subtotal({{ $cartQty }}): &nbsp&nbsp &#2547;{{ $cartTotal }}</a></li>
                                        {{-- <li><a>Shipping Fee: &nbsp&nbsp &#2547;<span id="shipping_fee">50</span></a></li> --}}
                                        <li><a>Grand Total: &nbsp&nbsp <b>&#2547;{{ $cartTotal + 50 }}</b></a></li>
                                    @endif
                                    
                                </ul>	
                                
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button" style="margin-top: 15px;">
                                    Proceed To Pay
                                </button>
                            </form>
                            </div>

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

@section('javascript')
    <script>
        $(function(){

            $('#select_district').change(function(){

                let value = $(this).val();

                if(value){
                    if(value == 1){
                        {{ session()->forget('shipping_charge') }}
                        {{ session()->put('shipping_charge', 50) }}
                    }
                    if(value == 2){
                        {{ session()->forget('shipping_charge') }}
                        {{ session()->put('shipping_charge', 70) }}
                    }
                }
            });

        });
    </script>
@endsection