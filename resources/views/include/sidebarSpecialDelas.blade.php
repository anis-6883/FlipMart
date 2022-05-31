
@php
  $special_deals = App\Models\Product::where([
            ['product_status', 'Active'],
            ['special_offer', '1']
        ])->limit(3)->get();
@endphp
    
    <!-- ============================================== SPECIAL DEALS ============================================== -->
    
    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
        <h3 class="section-title">Special Deals</h3>
        <div class="sidebar-widget-body outer-top-xs">
          <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">


            @foreach ($special_deals as $product)
              
                <div class="item">
                  <div class="products special-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> 
                                <a href="{{ route('productDetails', [$product->id, $product->product_slug]) }}"> 
                                  <img src="{{ asset("uploads/products/" . $product->product_master_image) }}" alt="special_deals_img"> 
                                </a> 
                              </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col col-xs-7">
                            <div class="product-info">
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
                          </div>
                          <!-- /.col -->

                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                  </div>
                </div>

            @endforeach
          </div>
        </div>
        <!-- /.sidebar-widget-body --> 
      </div>
      <!-- /.sidebar-widget --> 
      <!-- ============================================== SPECIAL DEALS : END ============================================== --> 