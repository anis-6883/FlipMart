@php
  $hot_deals = App\Models\Product::where([
            ['product_status', 'Active'],
            ['hot_deals', '1'],
            ['product_discounted_price', '!=', NULL]
        ])->limit(3)->get();
@endphp 
    
    <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
        <h3 class="section-title">hot deals</h3>
        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">


          @foreach ($hot_deals as $product)

              <div class="item">
                <div class="products">
                  <div class="hot-deal-wrapper">
                    <div class="image"> 
                      <img src="{{ asset("uploads/products/" . $product->product_master_image) }}" alt="hot_deals_image"> 
                    </div>
                    <div class="sale-offer-tag"><span>{{ $product->product_discounted_price }}%<br>
                      off</span></div>

                    <div class="timing-wrapper">
                      <div class="box-wrapper">
                        <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                      </div>
                      <div class="box-wrapper">
                        <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                      </div>
                      <div class="box-wrapper">
                        <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                      </div>
                      <div class="box-wrapper hidden-md">
                        <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.hot-deal-wrapper -->
                  
                  <div class="product-info text-left m-t-20">
                    <h3 class="name">
                      <a href="{{ route('productDetails', [$product->id, $product->product_slug]) }}">
                          {{ Str::of($product->product_name)->limit(40)  }}
                      </a>
                    </h3>
                    <div class="rating rateit-small"></div>

                    @if ($product->product_discounted_price == NULL)
                        <div class="product-price"> 
                          <span class="price"> &#2547;{{ $product->product_regular_price }} </span> 
                        </div>                              
                    @else

                        @php
                          $discount_price = ($product->product_regular_price * $product->product_discounted_price) / 100;
                          $product_amount = $product->product_regular_price - $discount_price;
                        @endphp

                        <div class="product-price"> 
                          <span class="price"> &#2547;{{ $product_amount }} </span> 
                          <span class="price-before-discount">&#2547;{{ $product->product_regular_price }}</span> 
                        </div>
                    @endif
                    <!-- /.product-price --> 
                    
                  </div>
                  <!-- /.product-info -->
                  
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <div class="add-cart-button btn-group">
                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                      </div>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
              </div>

          @endforeach

          


        </div>
        <!-- /.sidebar-widget --> 
      </div>
      <!-- ============================================== HOT DEALS: END ============================================== --> 