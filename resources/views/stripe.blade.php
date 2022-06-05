@extends('include.app')

@section('title', 'Stripe Payment Page')

@section('custom_css')
    <style>
        .StripeElement{
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus{
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid{
            border-color: #fa755a
        }

        .StripeElement--webkit-autofill{
            background-color: #fefde5 !important;
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
          <li class="active">Stripe Payment</li>
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
                                    <h4 class="unicase-checkout-title">Stripe Account</h4>
                                </div>

                                <form action="{{ route('checkout.stripeOrder') }}" method="POST" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                      <label for="card-element">
                                        Credit or Debit Card <br>
                                        <input name="username" type="hidden" value="{{ $arr['username'] }}">
                                        <input name="email" type="hidden" value="{{ $arr['email'] }}">
                                        <input name="phone" type="hidden" value="{{ $arr['phone'] }}">
                                        <input name="address" type="hidden" value="{{ $arr['address'] }}">
                                      </label>
                                      <div id="card-element">
                                        
                                      </div>
                                  
                                      <!-- Used to display Element errors. -->
                                      <div id="card-errors" role="alert"></div>
                                    </div>
                                  
                                    <button style="margin-top: 15px" class="btn btn-primary" type="submit">
                                        Submit Payment
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

@section('javascript')

<script>

    var stripe = Stripe('pk_test_51It11HBUiGp7cYCILKuApsc9dWlX7AtayWFyxyZTNbTCpZZMHP7uZqBs9xXD06SQTaZvoqq7P8fMSEJgDOGj46nN00OSXOwD2o');
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
    base: {
        // Add your base input styles here. For example:
        fontSize: '16px',
        color: '#32325d',
    },
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
        // Inform the customer that there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
    });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

</script>
@endsection