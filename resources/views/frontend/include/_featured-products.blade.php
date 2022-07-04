<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Featured products</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

      @foreach ($featured as $product)
      
      <div class="item item-carousel">
        <div class="products">
          <div class="product">
            <div class="product-image">
              <div class="image"> 
                <a href="{{ route('productDetails', [$product->id, $product->product_slug]) }}">
                  <img  src="{{ asset("uploads/products/" . $product->product_master_image) }}" alt="product_image">
                </a> 
              </div>
              <!-- /.image -->

              @if ($product->product_discounted_price == NULL)
                <div class="tag new"><span>new</span></div>                                
              @else
                <div class="tag hot"><span>{{ $product->product_discounted_price }}%</span></div>
              @endif
              

            </div>
            <!-- /.product-image -->
            
            <div class="product-info text-left">
              <h3 class="name">
                <a href="{{ route('productDetails', [$product->id, $product->product_slug]) }}">
                  {{ Str::of($product->product_name)->limit(40)  }}
                </a>
              </h3>
              <div class="rating rateit-small"></div>
              <div class="description"></div>

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
      
    </div>
    <!-- /.home-owl-carousel --> 
</section>
<!-- /.section --> 