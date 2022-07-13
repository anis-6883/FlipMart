@php
  $hot_deals = Illuminate\Support\Facades\DB::table('products as p')
        ->join('product_details as pd', 'pd.product_id', '=', 'p.id')
        ->select('p.*', 'pd.*')
        ->orderByDesc('p.created_at')
        ->where([ ['p.product_status', 'Active'], ['pd.hot_deals', '1'] ])
        ->limit(6)
        ->get();
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
                <div class="sale-offer-tag"><span>{{ $product->discounted_pct }}%<br>
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
                  <a href="{{ route('productDetails', $product->product_id) }}">
                      {{ Str::of($product->product_name)->limit(40)  }}
                  </a>
                </h3>
                <div class="rating rateit-small"></div>

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
                    <button onclick="fetchProductData(this.id)" id="{{ $product->product_id }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart">
                      <i class="fa fa-shopping-cart"></i> Add to cart
                    </button>
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