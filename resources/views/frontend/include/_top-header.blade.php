<div class="main-header">
    <div class="container">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{ route('home') }}"> <img width="115px" height="45px" src="{{ asset("assets/frontend/images/logo2.png") }}" alt="logo"> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
                <form method="POST" action="{{ route('search.product') }}">
                    @csrf
                    @method('POST')
                    
                    <div class="control-group">

                        {{-- <ul class="categories-filter animate-dropdown">
                            <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="#">Categories <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" >
                                <li class="menu-header">Computer</li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Clothing</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Electronics</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Shoes</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">- Watches</a></li>
                            </ul>
                            </li>
                        </ul> --}}

                        <input name="search" class="search-field" placeholder="Search here..." required autocomplete="off"/>
                        <button class="search-button" type="submit"></button>
                    </div>
                </form>
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            
            <div class="dropdown dropdown-cart"> 
            <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="c-cartQty">2</span></div>
                <div class="total-price-basket"> 
                    <span class="lbl">my cart</span> 
                    <span class="total-price"> 
                    {{-- <span class="sign">$</span>
                    <span class="value" id="c-cartTotal"></span>  --}}
                    </span> 
                </div>
            </div>
            </a>
            <ul class="dropdown-menu">
                <li>

                <!-- Start Mini Cart With AJAX -->

                <div id="loadMiniCart">

                </div>

                <!-- End Mini Cart With AJAX -->
                
                <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Sub Total : &#2547;</span><span class='price' id="c-cartSubTotal"></span> </div>
                    <div class="clearfix"></div>
                    <a href="{{ route('cart.index') }}" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
                    <a href="{{ route('checkoutPage') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> 
                </div>
                <!-- /.cart-total--> 
                
                </li>
            </ul>
            <!-- /.dropdown-menu--> 
            </div>
            <!-- /.dropdown-cart --> 
            
            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
        </div>
        <!-- /.row --> 
        
    </div>
    <!-- /.container --> 
</div>
<!-- /.main-header --> 