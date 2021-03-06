@extends('frontend.app')

@section('title', 'Product Details')

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="#">Clothing</a></li>
          <li class="active">{{ $product->product_detail->product_name }}</li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

  <div class="body-content outer-top-xs">
    <div class="container">
      <div class="row single-product">

        <!-- ============================================== SIDEBAR ============================================== -->

        <div class="col-xs-12 col-sm-12 col-md-3 sidebar">  
            
            @include('frontend.include.sidebarHotDeals')
  
            {{-- @include('include.sidebarProductTags') --}}
  
            @include('frontend.include.sidebarTestimonials')
  
            <div class="home-banner"> <img src="{{ asset("assets/frontend/images/banners/LHS-banner.jpg") }}" alt="Image"> </div>
  
          </div>
            <!-- /.sidemenu-holder --> 
  
        <!-- ============================================== SIDEBAR : END ============================================== --> 
        


        <div class="col-md-9">
            <div class="detail-block">
              <div class="row wow fadeInUp">
                <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                  <div class="product-item-holder size-big single-product-gallery small-gallery">
                    <div id="owl-single-product">

                        <div class="single-product-gallery-item" id="slideMaster">
                            <a
                            data-lightbox="image-1"
                            data-title="Gallery"
                            href="{{ asset('uploads/products/' . $product->product_detail->product_master_image) }}"
                            >
                            <img
                                class="img-responsive"
                                alt=""
                                src="assets/images/blank.gif"
                                data-echo="{{ asset('uploads/products/' . $product->product_detail->product_master_image) }}"
                            />
                            </a>
                        </div>
                        <!-- /.single-product-gallery-item -->

                        @foreach ($product->product_images as $img)
                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                <a
                                data-lightbox="image-1"
                                data-title="Gallery"
                                href="{{ asset('uploads/product-images/' . $img->product_image_filename) }}"
                                >
                                <img
                                    class="img-responsive"
                                    alt=""
                                    src="assets/images/blank.gif"
                                    data-echo="{{ asset('uploads/product-images/' . $img->product_image_filename) }}"
                                />
                                </a>
                            </div>
                            <!-- /.single-product-gallery-item -->
                        @endforeach

                      

                    </div>
                    <!-- /.single-product-slider -->
        
                    <div class="single-product-gallery-thumbs gallery-thumbs">
                        <div id="owl-single-product-thumbnails">

                            <div class="item">
                                <a
                                    class="horizontal-thumb active"
                                    data-target="#owl-single-product"
                                    data-slide="1"
                                    href="#slideMaster"
                                >
                                    <img
                                    class="img-responsive"
                                    width="85"
                                    alt=""
                                    src="{{ asset('uploads/products/' . $product->product_detail->product_master_image) }}"
                                    data-echo="{{ asset('uploads/products/' . $product->product_detail->product_master_image) }}"
                                    />
                                </a>
                            </div>

                                @foreach ($product->product_images as $img)
                                    <div class="item">
                                    <a
                                        class="horizontal-thumb active"
                                        data-target="#owl-single-product"
                                        data-slide="1"
                                        href="#slide{{ $img->id }}"
                                    >
                                        <img
                                        class="img-responsive"
                                        width="85"
                                        alt=""
                                        src="{{ asset('uploads/product-images/' . $img->product_image_filename) }}"
                                        data-echo="{{ asset('uploads/product-images/' . $img->product_image_filename) }}"
                                        />
                                    </a>
                                    </div>
                                @endforeach

                            </div>
                            <!-- /#owl-single-product-thumbnails -->
                    </div>
                    <!-- /.gallery-thumbs -->
                  </div>
                  <!-- /.single-product-gallery -->
                </div>
                <!-- /.gallery-holder -->

                
                <div class="col-sm-6 col-md-7 product-info-block">
                  <div class="product-info">
                    <h1 class="name" id="m-product-name">{{ $product->product_detail->product_name }}</h1>
        
                    <div class="ratings-reviews m-t-20">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="ratings rateit-small"></div>
                        </div>
                        <div class="col-sm-8">
                          <div class="reviews">
                            <a href="#" class="lnk">(13 Reviews)</a>
                          </div>
                        </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.ratings-reviews -->
        
                    <div class="stock-container info-container m-t-10">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="stock-box">
                            <span class="label">Availability :</span>
                          </div>
                        </div>
                        <div class="col-sm-9">
                          <div class="stock-box">
                            <span class="value">In Stock</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.stock-container -->
        
                    <div class="description-container m-t-20">
                      {!! $product->product_detail->product_summary !!}
                    </div>
                    <!-- /.description-container -->
        
                    <div class="price-container info-container m-t-20">

                      <div class="row">

                        <div class="col-sm-6">
                          <div class="price-box">

                            @if ($product->product_detail->discounted_pct == NULL)
                                <span class="price">&#2547;{{ $product->product_detail->product_regular_price }}</span>                          
                              @else

                                  @php
                                    $discount_price = ($product->product_detail->product_regular_price * $product->product_detail->discounted_pct) / 100;
                                    $product_amount = $product->product_detail->product_regular_price - $discount_price;
                                  @endphp
                                  <span class="price">&#2547;{{ round($product_amount) }}</span>
                                  <span class="price-strike">&#2547;{{ $product->product_detail->product_regular_price }}</span>
                              @endif

                          </div>
                        </div>
        
                        <div class="col-sm-6">
                          <div class="favorite-button m-t-10">
                            @if ($wishlist)
                              <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" onclick="addToWishList(this.id)" id="{{ $product->id }}">
                                  <i id="wishlist__icon" style="color: red" class="fa fa-heart"></i>
                              </button>
                            @else
                              <button class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" onclick="addToWishList(this.id)" id="{{ $product->id }}">
                                <i id="wishlist__icon" class="fa fa-heart"></i>
                              </button>
                            @endif
                          </div>
                        </div>

                      </div>
                      <!-- /.row -->

                      <div class="row">

                        @if ($product->product_detail->product_sizes != NULL)

                            @php
                              $product_sizes = explode(',', $product->product_detail->product_sizes);
                            @endphp

                            <div class="col-sm-6">

                              <div class="form-group">
                                <label for="m-product-size" class="info-title control-label">Choose Size</label>
                                <select id="m-product-size" class="form-control unicase-form-control selectpicker" required>

                                  {{-- <option value="" selected disabled>-- Choose Size --</option> --}}
                                  @foreach ($product_sizes as $size)
                                  <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                  @endforeach
                                
                                </select>
                              </div>

                            </div>

                        @endif

                        @if ($product->product_detail->product_colors != NULL)

                            @php
                              $product_colors = explode(',', $product->product_detail->product_colors);
                            @endphp

                          <div class="col-sm-6">
                          
                            <div class="form-group">
                              <label for="m-product-color" class="info-title control-label">Choose Color</label>
                              <select id="m-product-color" class="form-control unicase-form-control selectpicker" required>
                                {{-- <option value="" selected disabled>-- Choose Color --</option> --}}
                                  @foreach ($product_colors as $color)
                                  <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                  @endforeach
                              </select>
                            </div>

                          </div>

                        @endif

                      </div>
                      <!-- /.row -->


                    </div>
                    <!-- /.price-container -->
        
                    <div class="quantity-container info-container">

                      <div class="row">
                        
                        <div class="col-sm-2">
                          <span class="label">Qty :</span>
                        </div>

                        {{-- <div class="col-sm-2">
                          <div class="form-group">
                            <input style="padding: 6px 6px;" type="number" class="form-control" id="m-product-qty" min="1" max="10" value="1">
                          </div>
                        </div> --}}
        
                        <div class="col-sm-3">

                          <div style="display: flex; justify-content: center;">

                              <button id="qtyButton" onclick="qtyDecrement()" class="btn btn-danger btn-sm" type="submit">-</button>
                                    
                              <input type="number" id="m-product-qty" value="1" min="1" max="10" disabled style="width: 45px; padding: 4px;">

                              <button onclick="qtyIncrement()" class="btn btn-success btn-sm" type="submit">+</button>

                          </div>

                            {{-- <div class="cart-quantity">
                              <div class="quant-input">
                                <div class="arrows">
                                  <div class="arrow plus gradient">
                                    <span class="ir"
                                      ><i class="icon fa fa-sort-asc"></i
                                    ></span>
                                  </div>
                                  <div class="arrow minus gradient">
                                    <span class="ir"
                                      ><i class="icon fa fa-sort-desc"></i
                                    ></span>
                                  </div>
                                </div>
                                <input type="text" value="1" />
                              </div>
                            </div> --}}
                        </div>
        
                        <div class="col-sm-7">
                          <div style="display: flex; justify-content: center;">
                            <input type="hidden" id="m-product-id" value="{{ $product->id }}">
                            <button class="btn btn-primary" type="submit" onclick="addToCart()">
                              <i class="fa fa-shopping-cart inner-right-vs"></i>
                              ADD TO CART
                            </button>
                          </div>
                        </div>

                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.quantity-container -->
                  </div>
                  <!-- /.product-info -->
                </div>
                <!-- /.col-sm-7 -->
              </div>
              <!-- /.row -->
            </div>
        
            <div class="product-tabs inner-bottom-xs wow fadeInUp">
              <div class="row">
                <div class="col-sm-3">
                  <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                    <li class="active">
                      <a data-toggle="tab" href="#description">DESCRIPTION</a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#review">REVIEW</a>
                    </li>
                  </ul>
                  <!-- /.nav-tabs #product-tabs -->
                </div>

                <div class="col-sm-9">

                  <div class="tab-content">
                    <div id="description" class="tab-pane in active">
                      <div class="product-tab">
                        <p class="text">
                          {!! $product->product_detail->product_description !!}
                        </p>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
        
                  <div id="review" class="tab-pane">
                    <div class="product-tab">

                      <div class="product-reviews">
                        <h4 class="title">Customer Reviews</h4>

                        @php

                          $reviews = App\Models\Review::with('user')->where([ 
                            ['product_id', $product->id], 
                            ['review_status', 'Active'] 
                            ])->latest()->limit(5)->get();

                        @endphp
      
                        <div class="reviews">

                          @foreach ($reviews as $review)
                            <div class="review">
                              <div class="review-title">
                                <span class="summary">

                                  @for ($i=0; $i<$review->ratings; $i++)
                                      <i style="color: gold" class="fa fa-star"></i>
                                  @endfor
                                  
                                </span>
                                <br>
                                <span class="summary">{{ $review->user->username }}</span>
                                <span class="date">
                                  <i class="fa fa-calendar"></i>
                                  <span>{{ $review->created_at->diffForHumans() }}</span>
                                </span>
                              </div>
                              <div class="text">
                                {{ $review->review_text }}
                              </div>
                            </div>
                          @endforeach
                        
                        </div>
                        <!-- /.reviews -->
                        
                      </div>
                      <!-- /.product-reviews -->

                      @guest
                        <div class="product-add-review">
                          <p><b>For Add Product Review! You Need to Login First and Buy it! <a href="{{ route('user.login') }}">Login Here</a></b></p>
                        </div>
                      @else
                        <div class="product-add-review">
                          <h4 class="title">Write your own review...</h4>
                          <div class="review-table">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th class="cell-label">&nbsp;</th>
                                    <th>1 star</th>
                                    <th>2 stars</th>
                                    <th>3 stars</th>
                                    <th>4 stars</th>
                                    <th>5 stars</th>
                                  </tr>
                                </thead>

                                <form action="{{ route('review.store') }}" method="POST" class="cnt-form">
                                  @csrf
                                  @method('POST')
                                <tbody>
                                  <tr>
                                      <td class="cell-label">Ratings</td>
                                      <td>
                                        <input type="radio" name="ratings" class="radio" value="1" required/>
                                      </td>
                                      <td>
                                        <input type="radio" name="ratings" class="radio" value="2" required/>
                                      </td>
                                      <td>
                                        <input type="radio" name="ratings" class="radio" value="3" required/>
                                      </td>
                                      <td>
                                        <input type="radio" name="ratings" class="radio" value="4" required/>
                                      </td>
                                      <td>
                                        <input type="radio" name="ratings" class="radio" value="5" required/>
                                      </td>
                                  </tr>
                                </tbody>
                              </table>
                              <!-- /.table .table-bordered -->
                            </div>
                            <!-- /.table-responsive -->
                          </div>
                          <!-- /.review-table -->
        
                          <div class="review-form">
                            <div class="form-container">
                              
                                <div class="row">
                                  <div class="col-md-12">

                                    <div class="form-group">
                                      <label for="review">Review<span class="astk">*</span></label>
                                      <textarea name="review_text" class="form-control txt txt-review" id="review" rows="4" required></textarea>
                                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </div>

                                  </div>
                                </div>
                                <!-- /.row -->
        
                                <div class="action text-right">
                                  <button type="submit" class="btn btn-primary btn-upper">
                                    SUBMIT REVIEW
                                  </button>
                                </div>
                                <!-- /.action -->
                              </form>
                              <!-- /.cnt-form -->
                            </div>
                            <!-- /.form-container -->
                          </div>
                          <!-- /.review-form -->
                        </div>
                        <!-- /.product-add-review -->
                      @endguest
                      
                    </div>
                    <!-- /.product-tab -->
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.product-tabs -->
        
            <!-- ============================================== RELATED PRODUCTS ============================================== -->
            <section class="section featured-product wow fadeInUp">
              <h3 class="section-title">related products</h3>
              <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                @forelse ($related_product as $product)

                    <div class="item item-carousel">
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> 
                              <a href="{{ route('productDetails', $product->id) }}">
                                <img  src="{{ asset("uploads/products/" . $product->product_detail->product_master_image) }}" alt="product_image">
                              </a> 
                            </div>
                            <!-- /.image -->
        
                            @if ($product->product_detail->discounted_pct == NULL)
                              <div class="tag new"><span>new</span></div>                                
                            @else
                              <div class="tag hot"><span>{{ $product->product_detail->discounted_pct }}%</span></div>
                            @endif
                            
        
                          </div>
                          <!-- /.product-image -->
                          
                          <div class="product-info text-left">
                            <h3 class="name">
                              <a href="{{ route('productDetails', $product->id) }}">
                                {{ Str::of($product->product_detail->product_name)->limit(40)  }}
                              </a>
                            </h3>
                            <div class="ratings rateit-small"></div>
                            <div class="description"></div>
        
                            @if ($product->product_detail->discounted_pct == NULL)
                                <div class="product-price"> 
                                  <span class="price"> &#2547;{{ $product->product_detail->product_regular_price }} </span> 
                                </div>                              
                            @else
        
                                @php
                                  $discount_price = ($product->product_detail->product_regular_price * $product->product_detail->discounted_pct) / 100;
                                  $product_amount = $product->product_detail->product_regular_price - $discount_price;
                                @endphp
        
                                <div class="product-price"> 
                                  <span class="price"> &#2547;{{ $product_amount }} </span> 
                                  <span class="price-before-discount">&#2547;{{ $product->product_detail->product_regular_price }}</span> 
                                </div>
                            @endif
                            <!-- /.product-price --> 
                            
                          </div>
                          <!-- /.product-info -->
                          
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                  <button onclick="fetchProductData(this.id)" id="{{ $product->id }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button" title="Add Cart"> 
                                    <i class="fa fa-shopping-cart"></i> 
                                  </button>
                                  <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
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
                          <!-- /.cart --> 
                        </div>
                        <!-- /.product --> 
                        
                      </div>
                      <!-- /.products --> 
                    </div>
                    <!-- /.item -->
                @empty
                    <h5 style="color: red">No Related Product Is Available...</h5>
                @endforelse
                
        

              </div>
              <!-- /.home-owl-carousel -->
            </section>
            <!-- /.section -->
            <!-- ============================================== RELATED PRODUCTS : END ============================================== -->

            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.include._brand-slider')
    <!-- /.brand-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 
        </div>
          <!-- /.col -->


      </div>
    </div>
  </div>

@endsection

@section('custom_js')

    <script>

      function qtyIncrement(){
        var value = parseInt(document.querySelector('#m-product-qty').value, 10);
        document.querySelector('#qtyButton').disabled = false;
        value = isNaN(value) ? 0 : value;
        value++;
        document.querySelector('#m-product-qty').value = value;
      }

      function qtyDecrement(){
        var value = parseInt(document.querySelector('#m-product-qty').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value <= 1){
          document.querySelector('#qtyButton').disabled = true
        }else{
          value--;
        }
        document.querySelector('#m-product-qty').value = value;
      }

    </script>

@endsection