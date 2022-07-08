<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    
    <div class="more-info-tab clearfix ">
        <h3 class="new-product-title pull-left mb-2">New Products</h3>
        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">

        <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>

        @foreach ($categories as $category)
            <li style="margin-bottom: 10px"><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">{{ $category->category_name }}</a></li>
        @endforeach

        </ul>
        <!-- /.nav-tabs --> 

    </div>

    <div class="tab-content outer-top-xs">

        <div class="tab-pane in active" id="all">
        <div class="product-slider">
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
            
            @foreach ($products as $product)

                <div class="item item-carousel">
                    <div class="products">
                    <div class="product">
                        <div class="product-image">
                        <div class="image"> 
                            
                            @if ($product->product_master_image != null)
                                <a href="{{ route('productDetails', $product->product_id) }}">
                                    <img  src="{{ asset("uploads/products/" . $product->product_master_image) }}" alt="product_image">
                                </a> 
                            @else
                                <a href="{{ route('productDetails', $product->product_id) }}">
                                    <img  src="{{ asset('assets/backend/images/no-image.png') }}" alt="product_image">
                                </a>
                            @endif
                            
                        </div>
                        <!-- /.image -->

                        @if ($product->discounted_pct == NULL)
                            <div class="tag new"><span>new</span></div>                                
                        @else
                            <div class="tag hot"><span>{{ $product->discounted_pct }}%</span></div>
                        @endif
                        

                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                        <h3 class="name">
                            <a href="{{ route('productDetails', $product->product_id) }}">
                            {{ Str::of($product->product_name)->limit(40)  }}
                            </a>
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>

                        @if ($product->discounted_pct == NULL)
                            <div class="product-price"> 
                                <span class="price"> &#2547;{{ $product->product_regular_price }} </span> 
                            </div>                              
                        @else

                            @php
                                $discount_price = ($product->product_regular_price * $product->discounted_pct) / 100;
                                $product_amount = $product->product_regular_price - $discount_price;
                            @endphp

                            <div class="product-price"> 
                                <span class="price"> &#2547;{{ round($product_amount) }} </span> 
                                <span class="price-before-discount">&#2547;{{ $product->product_regular_price }}</span> 
                            </div>
                        @endif
                        <!-- /.product-price --> 
                        
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button onclick="fetchProductData(this.id)" id="{{ $product->product_id }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart">
                                    <i class="fa fa-shopping-cart"></i> 
                                    </button>
                                </li>
                                
                                <li class="wishlist btn-group"> 
                                    <button onclick="addToWishList(this.id)" id="{{ $product->product_id }}" data-toggle="tooltip" class="btn btn-primary icon" title="Wishlist" type="button"> 
                                    <i class="icon fa fa-heart"></i> 
                                    </button> 
                                </li>
                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                        </div>
                        <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                    </div>
                    <!-- /.product --> 
                    
                    </div>
                    <!-- /.products --> 
                </div>
                <!-- /.item -->

            @endforeach

            </div>
            <!-- /.home-owl-carousel --> 
        </div>
        <!-- /.product-slider --> 
        </div>
        <!-- /.tab-pane -->

        @foreach ($categories as $category)

        <div class="tab-pane in" id="category{{  $category->id }}">
        <div class="product-slider">
            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

            @php

                $cat_products = Illuminate\Support\Facades\DB::table('products as p')
                ->join('product_details as pd', 'pd.product_id', '=', 'p.id')
                ->select('p.*', 'pd.*')
                ->orderByDesc('p.created_at')
                ->where([['category_id', $category->id], ['product_status', 'Active']])
                ->get();

            @endphp
            
            @forelse ($cat_products as $product)

                <div class="item item-carousel">
                    <div class="products">
                    <div class="product">
                        <div class="product-image">
                        <div class="image"> 
                            <a href="{{ route('productDetails', $product->product_id) }}">
                            <img  src="{{ asset("uploads/products/" . $product->product_master_image) }}" alt="product_image">
                            </a> 
                        </div>
                        <!-- /.image -->
                        
                        @if ($product->discounted_pct == NULL)
                            <div class="tag new"><span>new</span></div>                                
                        @else
                            <div class="tag hot"><span>{{ $product->discounted_pct }}%</span></div>
                        @endif

                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                        <h3 class="name">
                            <a href="#">
                            {{ Str::of($product->product_name)->limit(40) }}
                            </a>
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>

                        @if ($product->discounted_pct == NULL)
                            <div class="product-price"> 
                                <span class="price"> &#2547;{{ $product->product_regular_price }} </span> 
                            </div>                              
                        @else

                            @php
                                $discount_price = ($product->product_regular_price * $product->discounted_pct) / 100;
                                $product_amount = $product->product_regular_price - $discount_price;
                            @endphp

                            <div class="product-price"> 
                                <span class="price"> &#2547;{{ round($product_amount) }} </span> 
                                <span class="price-before-discount">&#2547;{{ $product->product_regular_price }}</span> 
                            </div>
                        @endif
                        <!-- /.product-price --> 
                        
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button onclick="fetchProductData(this.id)" id="{{ $product->product_id }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart">
                                       <i class="fa fa-shopping-cart"></i> 
                                    </button>
                                </li>
                                  
                                <li class="wishlist btn-group"> 
                                    <button onclick="addToWishList(this.id)" id="{{ $product->product_id }}" data-toggle="tooltip" class="btn btn-primary icon" title="Wishlist" type="button"> 
                                      <i class="icon fa fa-heart"></i> 
                                    </button> 
                                </li>
                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                        </div>
                        <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                    </div>
                    <!-- /.product --> 
                    
                    </div>
                    <!-- /.products --> 
                </div>
                <!-- /.item -->

            @empty
                <h5 style="color: red">No Product Is Available...</h5>
            @endforelse

            </div>
            <!-- /.home-owl-carousel --> 
        </div>
        <!-- /.product-slider --> 
        </div>
        <!-- /.tab-pane -->
        @endforeach
        
    </div>
    <!-- /.tab-content --> 
</div>
<!-- /.scroll-tabs --> 