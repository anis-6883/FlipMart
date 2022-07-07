@extends('frontend.app')

@section('title', 'Product Cart')

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li>User</li>
          <li class="active">Cart Products</li>
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

                @if ($cartQty > 0)
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="heading-title">My Cart (<span id="cartQuantity"></span>)</th>
                                        <th class="heading-title">Name</th>
                                        <th class="heading-title">Color</th>
                                        <th class="heading-title">Size</th>
                                        <th class="heading-title">Qty</th>
                                        <th class="heading-title">Subtotal</th>
                                        <th class="heading-title">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="loadMyCart">
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>	


                    @if (Auth::check())

                        <div class="shopping-cart">

                            <div class="col-md-6 col-sm-12 estimate-ship-tax">

                                    <table class="table" id="coupon_input" @if(Session::has('coupon')) style="display: none" @endif>
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span class="estimate-title">Discount Code</span>
                                                    <p>Enter your coupon code if you have one..</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <input id="apply-coupon-code" type="text" class="form-control unicase-form-control text-input" placeholder="Write Coupon Code...">
                                                        </div>
                                                        <div class="clearfix pull-right">
                                                            <button onclick="applyCoupon()" type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                        </tbody><!-- /tbody -->
                                    </table><!-- /table -->

                            </div><!-- /.estimate-ship-tax -->
            
                            <div class="col-md-6 col-sm-12 cart-shopping-total">

                                <table class="table">
                                    <thead id="couponCalculateArea">
                                        
                                    </thead><!-- /thead -->

                                    <tbody>
                                            <tr>
                                                <td>
                                                    <div class="cart-checkout-btn pull-right">
                                                        <a href="{{ route('checkoutPage') }}" class="btn btn-primary checkout-btn">PROCEED TO CHEKOUT</a>
                                                    </div>
                                                </td>
                                            </tr>
                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->
                            </div><!-- /.cart-shopping-total -->
                        </div>

                        <div id="no-cart-alert"></div>
                    @else
                        <div class="col-md-12">
                            <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4">Message!</h1>
                                <p class="lead">For Procceding To Chechkout, You Have To Login In First! Thank You.</p>
                                <p><a href="{{ route('user.login') }}">Login Here</a></p>
                            </div>
                            </div>
                        </div>
                    @endif

                @else

                    <div class="col-md-12">
                        <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No Cart Added Yet!</h1>
                            <p class="lead">There are no cart yet. Add your products to cart and they will show here.</p>
                            <p><a href="{{ route('home') }}">Go TO Home</a></p>
                        </div>
                        </div>
                    </div>

                @endif

            </div><!-- /.row -->
		</div><!-- /.my-wishlist-page-->

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.include._brand-slider')
        <!-- /.brand-slider --> 
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

    </div><!-- /.container -->
</div><!-- /.body-content -->

<br>

@endsection

@section('custom_js')
    <script>

        function loadMyCart(){
            $(function(){

                $.ajax({
                    type: "GET",
                    url: "{{ route('cart.getFromCart') }}",
                    dataType: "json",
                    success: function(res)
                    {
                    var row = "";
                    $('#cartQuantity').text(res.cartQty);

                    $.each(res.carts, function(key, value){

                        row += `<tr>
                            <td class="col-md-2"><img width="190px" height="140px" src="{{ asset('uploads/products/${value.options.image}') }}" alt="Product Image"></td>
                            <td class="col-md-2">
                                <div class="product-name">
                                    <a href="{{ url('/productDetails/${value.id}') }}">
                                        ${value.name.slice(0, 30) + "..."}
                                    </a>
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star rate"></i>
                                    <i class="fa fa-star non-rate"></i>
                                    <span class="review">( 06 Reviews )</span>
                                </div>

                                <div class="price"> 
                                        &#2547;${value.price}
                                        <span> &#2547;${value.options.discounted_price}</span> 
                                    </div>            
                                <!-- /.product-price --> 
                            </td>
                            <td class="col-md-2">
                                ${value.options.color == null ? "NULL" : value.options.color}
                            </td>
                            <td class="col-md-2">
                                ${value.options.size == null ? "NULL" : value.options.size}
                            </td>

                            <td class="col-md-2">
                                ${value.qty > 1 ? 
                                    `<button id="${value.rowId}" onclick="cartDecrement(this.id)" class="btn btn-danger btn-sm" type="submit">-</button>`
                                    :
                                    `<button disabled class="btn btn-danger btn-sm" type="submit">-</button>`
                                }
                                
                                <input type="number" id="qty_number" value="${value.qty}" min="1" max="10" disabled style="width: 45px; padding: 4px;">

                                ${value.qty < 10 ? 
                                    `<button id="${value.rowId}" onclick="cartIncrement(this.id)" class="btn btn-success btn-sm" type="submit">+</button>`
                                    :
                                    `<button disabled class="btn btn-success btn-sm" type="submit">+</button>`
                                }
                                
                            </td>

                            <td class="col-md-2">
                                <b>&#2547;${value.subtotal}</b>
                            </td>
                            
                            <td class="col-md-1 close-btn">

                                <button id="${value.rowId}" onclick="removeFromCart(this.id)"><i class="fa fa-times"></i></button>

                            </td>
                        </tr>`;

                        });

                        $('#loadMyCart').html(row);
                    }
                });
            })
        }

        loadMyCart();

    </script>


    <script>

        function cartIncrement(rowId){
            $(function(){

                var url = "{{ route('cart.cartIncrement', ':rowId') }}";
                url = url.replace(':rowId', rowId);

                $.ajax({
                    type: "POST",
                    url,
                    dataType: "json",
                    data:{
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res)
                    {
                        miniCart();
                        loadMyCart();
                        couponCalculation();
                        
                        // start sweet alert

                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                        })

                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })

                        // end sweet alert
                    }
                });
            });
        }

    </script>

    <script>

        function cartDecrement(rowId){
            $(function(){

                var url = "{{ route('cart.cartDecrement', ':rowId') }}";
                url = url.replace(':rowId', rowId);

                $.ajax({
                    type: "POST",
                    url,
                    dataType: "json",
                    data:{
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res)
                    {
                        miniCart();
                        loadMyCart();
                        couponCalculation();

                        // start sweet alert

                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                        })

                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })

                        // end sweet alert
                    }
                });
            });
        }

    </script>

    <script>

        function applyCoupon(){

            $(function(){

                var coupon_code = $('#apply-coupon-code').val();

                $.ajax({
                        type: "POST",
                        url: "{{ route('coupon.applyCoupon') }}",
                        dataType: "json",
                        data:{
                            _token: "{{ csrf_token() }}",
                            coupon_code
                        },
                        success: function(res)
                        {
                            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000
                            })

                            if($.isEmptyObject(res.error))
                            {
                                $('#coupon_input').hide();
                                couponCalculation();

                                Toast.fire({
                                    icon: 'success',
                                    title: res.success
                                })
                            }
                            else{
                                Toast.fire({
                                    icon: 'error',
                                    title: res.error
                                })
                            }

                        }
                });
                
            });
        }

    </script>

    <script>
        
        function couponCalculation()
        {
            $(function(){

                $.ajax({
                    type: "GET",
                    url: "{{ route('coupon.calculate') }}",
                    // dataType: "json",
                    success: function(res){

                        console.log(res);

                        if(res.total){
                            $('#couponCalculateArea').html(`
                            <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">&#2547;${res.total}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">&#2547;${res.total}</span>
                                    </div>
                                </th>
                            </tr>`);
                        }
                        else{
                            $('#couponCalculateArea').html(`
                            <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">&#2547;${res.subtotal}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i></button>
                                        Coupon<span class="inner-left-md" style="color: #0f6cb2 !important">${res.coupon_title}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        Dis. Amount<span class="inner-left-md">${res.discount_pct}%</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">&#2547;${res.total_price.toFixed(2)}</span>
                                    </div>
                                </th>
                            </tr>`);
                        }
                    }
                });
            })
        }

        couponCalculation();

        function couponRemove(){

            $(function(){

                $.ajax({
                    type: "POST",
                    url: "{{ route('coupon.remove') }}",
                    dataType: "json",
                    data:{
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res){

                        couponCalculation();
                        $('#coupon_input').show();

                        // start sweet alert

                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                        })

                        Toast.fire({
                            icon: 'success',
                            title: res.success
                        })

                        // end sweet alert
                        
                    }
                });
            })

        }
        
    </script>
@endsection