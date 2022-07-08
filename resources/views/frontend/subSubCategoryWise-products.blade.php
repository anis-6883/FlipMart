@extends('frontend.app')

@section('title', 'Sub-SubCategory Wise Products')

@section('content')

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li>Sub_SubCategories</li>
          <li class="active">{{ last(request()->segments(2)) }}</li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
      <div class="row"> 

            <!-- ============================================== SIDEBAR ============================================== -->

            <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 

                @include('frontend.include.sidebarNavigation') 

                <div class="sidebar-module-container">
                    <div class="sidebar-filter">

                        <!-- ============================================== DROPDOWN SIDEBAR CATEGORY ============================================== -->
                        @include('frontend.include.sidebarDropdown')

                        <!-- ============================================== PRICE SILDER============================================== -->
                        <div class="sidebar-widget wow fadeInUp outer-bottom-small">
                            <div class="widget-header">
                              <h4 class="widget-title">Price Slider</h4>
                            </div>
                            <div class="sidebar-widget-body m-t-10">
                              <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                                <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                                <input type="text" class="price-slider" value="" >
                              </div>
                              <!-- /.price-range-holder --> 
                              <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
                            <!-- /.sidebar-widget-body --> 
                        </div>

                        <!-- ============================================== MANUFACTURES============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp outer-bottom-small">
                            <div class="widget-header">
                              <h4 class="widget-title">Manufactures</h4>
                            </div>
                            <div class="sidebar-widget-body">
                              <ul class="list">
                                <li><a href="#">Forever 18</a></li>
                                <li><a href="#">Nike</a></li>
                                <li><a href="#">Dolce & Gabbana</a></li>
                                <li><a href="#">Alluare</a></li>
                                <li><a href="#">Chanel</a></li>
                                <li><a href="#">Other Brand</a></li>
                              </ul>
                              <!--<a href="#" class="lnk btn btn-primary">Show Now</a>--> 
                            </div>
                            <!-- /.sidebar-widget-body --> 
                        </div>     --}}

                        <!-- ============================================== COLOR============================================== -->
                        <div class="sidebar-widget wow fadeInUp outer-bottom-small">
                            <div class="widget-header">
                            <h4 class="widget-title">Colors</h4>
                            </div>
                            <div class="sidebar-widget-body">
                            <ul class="list">
                                <li><a href="#">Red</a></li>
                                <li><a href="#">Blue</a></li>
                                <li><a href="#">Yellow</a></li>
                                <li><a href="#">Pink</a></li>
                                <li><a href="#">Brown</a></li>
                                <li><a href="#">Teal</a></li>
                            </ul>
                            </div>
                            <!-- /.sidebar-widget-body --> 
                        </div>

                        
                </div>


                {{-- @include('include.sidebarProductTags') --}}

                @include('frontend.include.sidebarNewsLetter')

                @include('frontend.include.sidebarTestimonials')

                <div class="home-banner"> <img src="{{ asset("assets/frontend/images/banners/LHS-banner.jpg") }}" alt="Image"> </div>

            </div>
                <!-- /.sidemenu-holder --> 

            <!-- ============================================== SIDEBAR : END ============================================== -->    


            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 

                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                    <div class="image"> <img src="{{ asset('assets/frontend/images/banners/cat-banner-1.jpg') }}" alt="" class="img-responsive"> </div>
                    <div class="container-fluid">
                        <div class="caption vertical-top text-left">
                        <div class="big-text"> Big Sale </div>
                        <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                        <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>
                        </div>
                        <!-- /.caption --> 
                    </div>
                    <!-- /.container-fluid --> 
                    </div>
                </div>

                <div class="clearfix filters-container m-t-10">
                    <div class="row">

                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                                <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                <div class="fld inline">
                                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                    <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li role="presentation"><a href="#">position</a></li>
                                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <!-- /.fld --> 
                                </div>
                                <!-- /.lbl-cnt --> 
                            </div>
                             <!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                <div class="fld inline">
                                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                    <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li role="presentation"><a href="#">1</a></li>
                                        <li role="presentation"><a href="#">2</a></li>
                                        <li role="presentation"><a href="#">3</a></li>
                                        <li role="presentation"><a href="#">4</a></li>
                                        <li role="presentation"><a href="#">5</a></li>
                                        <li role="presentation"><a href="#">6</a></li>
                                        <li role="presentation"><a href="#">7</a></li>
                                        <li role="presentation"><a href="#">8</a></li>
                                        <li role="presentation"><a href="#">9</a></li>
                                        <li role="presentation"><a href="#">10</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <!-- /.fld --> 
                                </div>
                                <!-- /.lbl-cnt --> 
                            </div>
                            <!-- /.col --> 
                        </div>
                        <!-- /.col --> 
                    </div>
                    <!-- /.row --> 

                </div>

                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">

                      <div class="tab-pane active" id="grid-container">

                        <div class="category-product">
                          <div class="row">

                            @foreach ($sub_subCategoryWiseProducts as $product)

                                <div class="col-sm-6 col-md-4 wow fadeInUp">
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
                                            <div class="rating rateit-small"></div>
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
                                                  <span class="price"> &#2547;{{ round($product_amount) }} </span> 
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
                                              </li>
                                              
                                              <li class="wishlist btn-group"> 
                                                <button onclick="addToWishList(this.id)" id="{{ $product->id }}" data-toggle="tooltip" class="btn btn-primary icon" title="Wishlist" type="button"> 
                                                  <i class="icon fa fa-heart"></i> 
                                                </button> 
                                              </li>
                                              <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
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
                          <!-- /.row --> 
                        </div>
                        <!-- /.category-product --> 
                        
                      </div>
                      <!-- /.tab-pane -->
                      
                      <div class="tab-pane"  id="list-container">
                        <div class="category-product">

                            @foreach ($sub_subCategoryWiseProducts as $product)

                                <div class="category-product-inner wow fadeInUp">
                                    <div class="products">
                                    <div class="product-list product">
                                        <div class="row product-list-row">
                                        <div class="col col-sm-4 col-lg-4">
                                            <div class="product-image">
                                                <div class="image"> 
                                                    <a href="{{ route('productDetails', $product->id) }}">
                                                        <img  src="{{ asset("uploads/products/" . $product->product_detail->product_master_image) }}" alt="product_image">
                                                    </a> 
                                                </div>
                                            </div>
                                            <!-- /.product-image --> 
                                        </div>
                                        <!-- /.col -->
                                        <div class="col col-sm-8 col-lg-8">
                                            <div class="product-info">
                                                <h3 class="name">
                                                    <a href="{{ route('productDetails', $product->id) }}">
                                                      {{ Str::of($product->product_detail->product_name)->limit(40)  }}
                                                    </a>
                                                </h3>
                                            <div class="rating rateit-small"></div>
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
                                                  <span class="price"> &#2547;{{ round($product_amount) }} </span> 
                                                  <span class="price-before-discount">&#2547;{{ $product->product_detail->product_regular_price }}</span> 
                                                </div>
                                            @endif
                                            <!-- /.product-price --> 

                                            <div class="description m-t-10">{!! Str::of($product->product_detail->product_summary)->limit(100) !!}</div>
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                </ul>
                                                </div>
                                                <!-- /.action --> 
                                            </div>
                                            <!-- /.cart --> 
                                            
                                            </div>
                                            <!-- /.product-info --> 
                                        </div>
                                        <!-- /.col --> 
                                        </div>
                                        <!-- /.product-list-row -->
                                        @if ($product->product_detail->discounted_pct == NULL)
                                                <div class="tag new"><span>new</span></div>                                
                                        @else
                                            <div class="tag hot"><span>{{ $product->product_detail->discounted_pct }}%</span></div>
                                        @endif
                                    </div>
                                    <!-- /.product-list --> 
                                    </div>
                                    <!-- /.products --> 
                                </div>
                                <!-- /.category-product-inner --> 
                                
                            @endforeach

                        </div>
                        <!-- /.category-product --> 
                      </div>
                      <!-- /.tab-pane #list-container --> 
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container">
                      <div class="text-right">
                        <div class="pagination-container">
                          <ul class="list-inline list-unstyled">
                            {{ $sub_subCategoryWiseProducts->links() }}
                          </ul>
                          <!-- /.list-inline --> 
                        </div>
                        <!-- /.pagination-container --> </div>
                      <!-- /.text-right --> 
                      
                    </div>
                    <!-- /.filters-container --> 
                    
                  </div>
                  <!-- /.search-result-container --> 
            </div>
      </div>
    </div>
</div>

@endsection