@extends('frontend.app')

@section('title', 'Product Wishlist')

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li>User</li>
          <li class="active">Wishlist</li>
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

                @if (count($wishlists) > 0)
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="heading-title">My Wishlist ({{ count($wishlists) }})</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlists as $wishlist)
                                        <tr>
                                            <td class="col-md-2"><img src="{{ asset('uploads/products/' . $wishlist->product->product_detail->product_master_image) }}" alt="Product Image"></td>
                                            <td class="col-md-7">
                                                <div class="product-name">
                                                    <a href="{{ route('productDetails', $wishlist->product->id) }}">
                                                        {{ $wishlist->product->product_detail->product_name }}
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

                                                @if ($wishlist->product->product_detail->product_discounted_price == NULL)
                                                    <div class="price"> 
                                                        &#2547;{{ $wishlist->product->product_detail->product_regular_price }}
                                                    </div>                              
                                                @else

                                                    @php
                                                    $discount_price = ($wishlist->product->product_detail->product_regular_price * $wishlist->product->product_detail->product_discounted_price) / 100;
                                                    $product_amount = $wishlist->product->product_detail->product_regular_price - $discount_price;
                                                    @endphp

                                                    <div class="price"> 
                                                        &#2547;{{ $product_amount }}
                                                        <span> &#2547;{{ $wishlist->product->product_detail->product_regular_price }}</span> 
                                                    </div>
                                                @endif
                                                <!-- /.product-price --> 
                                            </td>
                                            <td class="col-md-2">
                                                <button onclick="fetchProductData(this.id)" id="{{ $wishlist->product->id }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                 </button>
                                            </td>
                                            <td class="col-md-1 close-btn">

                                                <button onclick="document.querySelector('#delete_wishlist{{ $wishlist->id }}').submit();"><i class="fa fa-times"></i></button>

                                                <form method="POST" id="delete_wishlist{{ $wishlist->id }}" action="{{ route('wishlist.destroy', $wishlist->product->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

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
                            <h1 class="display-4">No Wishlist Added Yet!</h1>
                            <p class="lead">There are no favorites yet. Add your favorites to wishlist and they will show here.</p>
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

@endsection