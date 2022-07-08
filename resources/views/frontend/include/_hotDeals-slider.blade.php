@php
  $hot_deals = Illuminate\Support\Facades\DB::table('products as p')
        ->join('product_details as pd', 'pd.product_id', '=', 'p.id')
        ->select('p.*', 'pd.*')
        ->orderByDesc('p.created_at')
        ->where([ ['p.product_status', 'Active'], ['pd.hot_deals', '1'] ])
        ->limit(6)
        ->get();
@endphp

<section class="section wow fadeInUp new-arriavls">
    <h3 class="section-title">Hot Deals</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

      @foreach ($hot_deals as $product)
      
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
              
              <div class="cart clearfix animate-effect m-auto">
                <div class="action">
                  <ul class="list-unstyled">

                    <li class="add-cart-button btn-group">
                      <button onclick="fetchProductData(this.id)" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart">
                        <i class="fa fa-shopping-cart"></i> 
                      </button>
                    </li>
                    
                    <li class="wishlist btn-group"> 
                      <button onclick="addToWishList(this.id)" id="{{ $product->id }}" data-toggle="tooltip" class="btn btn-primary icon" title="Wishlist" type="button"> 
                        <i class="icon fa fa-heart"></i> 
                      </button> 
                    </li>

                    <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                  </ul>
                </div>
                <!-- /.action --> 
              </div>
              <!-- /.cart animate-effect --> 


            </div>
            <!-- /.product --> 
            
          </div>
          <!-- /.products --> 
        </div>
        <!-- /.item -->
      
      @endforeach
      {{-- <div class="item item-carousel">
        <div class="products">
          <div class="product">
            <div class="product-image">
              <div class="image"> <a href="detail.html"><img  src="{{ asset("assets/frontend/images/products/p19.jpg") }}" alt=""></a> </div>
              <!-- /.image -->
              
              <div class="tag new"><span>new</span></div>
            </div>
            <!-- /.product-image -->
            
            <div class="product-info text-left">
              <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
              <div class="rating rateit-small"></div>
              <div class="description"></div>
              <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
              <!-- /.product-price --> 
              
            </div>
            <!-- /.product-info -->
            <div class="cart clearfix animate-effect">
              <div class="action">
                <ul class="list-unstyled">
                  <li class="add-cart-button btn-group">
                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                  </li>
                  <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                  <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
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
      <!-- /.item --> --}}
      
    </div>
    <!-- /.home-owl-carousel --> 
</section>
<!-- /.section --> 