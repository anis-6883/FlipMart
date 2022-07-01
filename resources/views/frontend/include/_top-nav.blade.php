<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
                <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="{{ route('home') }}">Home</a></li>

                @php
                    $categories = App\Models\Category::where('category_status', 'Active')->orderBy('category_order')->get();
                @endphp

                @foreach ($categories as $category)

                    <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name }}</a>
                    <ul class="dropdown-menu container">
                        <li>
                        <div class="yamm-content ">
                            <div class="row">

                            @php
                                $subcategories = App\Models\Subcategory::where('category_id', $category->id)->orderBy('subcategory_name')->get();
                            @endphp

                            @foreach ($subcategories as $subcategory)
                                <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                <h2 class="title">{{ $subcategory->subcategory_name }}</h2>
                                <ul class="links">
                                    @php
                                    $sub_subcategories = App\Models\Sub_Subcategory::where('subcategory_id', $subcategory->id)->get();
                                    @endphp

                                    @foreach ($sub_subcategories as $sub_subcategory)
                                    <li><a href="#">{{ $sub_subcategory->sub_subcategory_name }}</a></li>
                                    @endforeach

                                </ul>
                                </div>
                            @endforeach
                            <!-- /.col -->
                            
                            <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset("frontend_assets/images/banners/top-menu-banner.jpg") }}" alt=""> </div>
                            <!-- /.yamm-content --> 
                            </div>
                        </div>
                        </li>
                    </ul>
                    </li>

                @endforeach

                {{-- <li class="dropdown mega-menu"> 
                <a href="category.html"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Electronics <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                    <ul class="dropdown-menu container">
                    <li>
                        <div class="yamm-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Laptops</h2>
                            <ul class="links">
                                <li><a href="#">Gaming</a></li>
                                <li><a href="#">Laptop Skins</a></li>
                                <li><a href="#">Apple</a></li>
                                <li><a href="#">Dell</a></li>
                                <li><a href="#">Lenovo</a></li>
                                <li><a href="#">Microsoft</a></li>
                                <li><a href="#">Asus</a></li>
                                <li><a href="#">Adapters</a></li>
                                <li><a href="#">Batteries</a></li>
                                <li><a href="#">Cooling Pads</a></li>
                            </ul>
                            </div>
                            <!-- /.col -->
                            
                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Desktops</h2>
                            <ul class="links">
                                <li><a href="#">Routers & Modems</a></li>
                                <li><a href="#">CPUs, Processors</a></li>
                                <li><a href="#">PC Gaming Store</a></li>
                                <li><a href="#">Graphics Cards</a></li>
                                <li><a href="#">Components</a></li>
                                <li><a href="#">Webcam</a></li>
                                <li><a href="#">Memory (RAM)</a></li>
                                <li><a href="#">Motherboards</a></li>
                                <li><a href="#">Keyboards</a></li>
                                <li><a href="#">Headphones</a></li>
                            </ul>
                            </div>
                            <!-- /.col -->
                            
                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Cameras</h2>
                            <ul class="links">
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Binoculars</a></li>
                                <li><a href="#">Telescopes</a></li>
                                <li><a href="#">Camcorders</a></li>
                                <li><a href="#">Digital</a></li>
                                <li><a href="#">Film Cameras</a></li>
                                <li><a href="#">Flashes</a></li>
                                <li><a href="#">Lenses</a></li>
                                <li><a href="#">Surveillance</a></li>
                                <li><a href="#">Tripods</a></li>
                            </ul>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                            <h2 class="title">Mobile Phones</h2>
                            <ul class="links">
                                <li><a href="#">Apple</a></li>
                                <li><a href="#">Samsung</a></li>
                                <li><a href="#">Lenovo</a></li>
                                <li><a href="#">Motorola</a></li>
                                <li><a href="#">LeEco</a></li>
                                <li><a href="#">Asus</a></li>
                                <li><a href="#">Acer</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Headphones</a></li>
                                <li><a href="#">Memory Cards</a></li>
                            </ul>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner"> <a href="#"><img alt="" src="{{ asset("frontend_assets/images/banners/banner-side.png") }}"></a> </div>
                        </div>
                        <!-- /.row --> 
                        </div>
                        <!-- /.yamm-content --> </li>
                    </ul>
                </li>
                <li class="dropdown hidden-sm"> <a href="category.html">Health & Beauty <span class="menu-label new-menu hidden-xs">new</span> </a> </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                    <ul class="dropdown-menu pages">
                    <li>
                        <div class="yamm-content">
                        <div class="row">
                            <div class="col-xs-12 col-menu">
                            <ul class="links">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="category.html">Category</a></li>
                                <li><a href="detail.html">Detail</a></li>
                                <li><a href="shopping-cart.html">Shopping Cart Summary</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-details.html">Blog Detail</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li>< a href="sign-in.html">Sign In</a></li>
                                <li><a href="my-wishlist.html">Wishlist</a></li>
                                <li><a href="terms-conditions.html">Terms and Condition</a></li>
                                <li><a href="track-orders.html">Track Orders</a></li>
                                <li><a href="product-comparison.html">Product-Comparison</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="404.html">404</a></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </li>
                    </ul>
                </li> --}}


                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
            </div>
            <!-- /.navbar-collapse --> 
            
        </div>
        <!-- /.nav-bg-class --> 
        </div>
        <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
</div>
<!-- /.header-nav --> 