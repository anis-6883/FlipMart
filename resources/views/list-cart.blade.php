@extends('include.app')

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
        @include('include._brand-slider')
        <!-- /.brand-slider --> 
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

    </div><!-- /.container -->
</div><!-- /.body-content -->

<br>

@endsection

@section('javascript')
    <script>

        function loadMyCart()
        {
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
                                    <a href="#">
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
                                ${value.options.color == null ? "---" : value.options.color}
                            </td>
                            <td class="col-md-2">
                                ${value.options.size == null ? "---" : value.options.size}
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
        function cartIncrement(rowId)
        {
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
        function cartDecrement(rowId)
        {
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
@endsection