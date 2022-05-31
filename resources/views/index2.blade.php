<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Muhammad Anisuzzaman">
    <title>E-commerce</title>
    <link rel="icon" href="{{ asset('front_assets/images/shopping-cart.png') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
    <script src="https://kit.fontawesome.com/fbcd216f09.js" crossorigin="anonymous"></script>
    <style>
        

    </style>
</head>
<body>

<!-- Start Top Navigation Bar -->

<section id="top__navbar">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="padding: 0.2rem 0; background-color: #293B5F;">
            <div class="container">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul id="left__side" class="navbar-nav me-auto" style="font-size: 14px; font-weight: 500;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i style="font-size: 15px" class='fas'>&#xf658;</i> admin@ogani.com
                            </a>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 15px" class='fas'>&#xf879;</i> 00-62-658-658
                            </a>
                        </li>
                    </ul>


                    <ul id="middle__side" class="navbar-nav m-auto" style="font-size: 14px; font-weight: 500;">
                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 18px" class='fab'>&#xf09a;</i>
                            </a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 18px" class='fab'>&#xf16d;</i>
                            </a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 18px" class='fab'>&#xf0d2;</i>
                            </a>
                        </li>
                    </ul>


                    <ul id="right__side" class="navbar-nav ms-auto" style="font-size: 14px; font-weight: 500;">
                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 15px" class='fas'>&#xf004;</i> Wishlist <span class="badge bg-secondary">1</span>
                            </a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 15px" class='fas'>&#xf218;</i> My Cart
                            </a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link active" href="#">
                                <i style="font-size: 15px" class='fas'>&#xf3c1;</i> Login
                            </a>
                        </li>

                        <li class="nav-item me-2 dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i style="font-size: 15px" class='fas'>&#xf2bd;</i> My Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Change Password</a></li>
                            <li><a class="dropdown-item" href="#"><i style="font-size: 15px" class='fas'>&#xf023;</i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</section>

<!-- End Top Navigation Bar -->
        

<!-- Start Icon, Search Input, and Cart Icon Bar-->

<section id="top__search">
    <div class="container mt-2">

        <div class="row justify-content-center align-items-center">

            <div class="col-md-2 mb-1 mt-3 d-flex justify-content-center">
                <img src="{{ asset('front_assets/images/logo.png') }}" alt="logo" width="90px" height="40px">
            </div>

            <div class="col-md-8 mb-1 mt-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Product Name..." aria-label="Product Name..." aria-describedby="search-btn">
                    <button class="btn btn-outline-secondary" type="button" id="search-btn">
                        <i style="font-size: 15px" class='fas'>&#xf002;</i> Search
                    </button>
                </div>
            </div>

            <div class="col-md-2 mb-1 mt-3 d-flex justify-content-center">
                <a href="#" class="btn btn-light position-relative">
                    <img src="{{ asset('front_assets/images/shopping-cart.png') }}" alt="cart" width="40px" height="40px">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      10+
                    </span>
                </a>
            </div>

        </div>

    </div>
</section>

<!-- End Icon, Search Input, and Cart Icon Bar-->

<!-- Start Side Navbar and Slider -->

<section id="side__navbar__slider">
    <div class="container mt-3 mb-4">
        <div class="row">

            <div class="col-md-3 mb-2">

                <div class="card">
                    <div class="card-header text-center" style="background-color: #293B5F; color: #fff; font-weight: 500;">
                        <i style="font-size: 15px" class='fas'>	&#xf474;</i> Category
                    </div>
                    <div class="accordion" id="accordionExample">

                        @foreach ($categories as $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                <button class="accordion-button @if ($loop->iteration != 1) collapsed @endif fw-bold " type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="true" aria-controls="collapse{{ $category->id }}">
                                    {{ $category->category_name }}
                                </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse @if ($loop->iteration == 1) show @endif" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ol>
                                        @if (!empty($category->subcategories))
                                            @foreach ($category->subcategories as $subcategory)
                                                <li>
                                                    {{-- <a href="#">{{ $subcategory->subcategory_name }}</a> --}}
                                                    {{-- <ul style="list-style-type:disc;">
                                                        
                                                    </ul> --}}
                                                    <!-- Default dropend button -->
                                                    <div class="btn-group dropdown__sidenav dropend">
                                                        <a href="#" class="mb-1">
                                                        {{ $subcategory->subcategory_name }}
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="#">T-shirt</a></li>
                                                            <li><a class="dropdown-item" href="#">Pants</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ol>
                                </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="card-footer text-center" style="background-color: #293B5F; color: #fff; font-weight: 500;">
                        <i style="font-size: 15px" class='fas'>	&#xf474;</i> Category
                    </div>
                </div>

                

            </div>

            <div class="col-md-9 mb-2">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" style="height: 423px;">

                        @foreach ($sliders as $slider)
                            <div class="carousel-item @if ($loop->iteration == 1) active @endif">
                                <img src="{{ asset('uploads/sliders/'. $slider->slider_image_filename) }}" class="d-block w-100" alt="slider_img">
                            </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- End Side Navbar and Slider -->
  
<!-- Start New Product Tab -->

<scetion id="new__product">
    <div class="container mb-4">
        <div class="card">
            <div class="card-header" style="background-color: #293B5F; color: #fff; font-weight: 500;">
    
                <h5 class="card-title"><i style="font-size: 18px" class='fas'>&#xf553;</i> New Products</h5>
    
                <ul class="nav justify-content-center nav-tabs card-header-tabs" data-bs-tabs="tabs">
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#electornic1">Electronic Devise</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link" data-bs-toggle="tab" href="#mens1">Men's Fashion</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link" data-bs-toggle="tab" href="#womens1">Women's Fashion</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link" data-bs-toggle="tab" href="#home-beauty1">Home Beauty</a>
                    </li>
                </ul>
    
            </div>
    
            <form class="card-body tab-content">
    
                <div class="tab-pane active" id="electornic1">
                    
                    <div class="row justify-content-around" id="new-product__tab-content">
    
                        <div class="col-md-2">
                            <div class="card">
                                <img src="{{ asset('front_assets/images/product-1.jpg') }}" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <img src="{{ asset('front_assets/images/product-1.jpg') }}" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <img src="{{ asset('front_assets/images/product-1.jpg') }}" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <img src="{{ asset('front_assets/images/product-1.jpg') }}" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <img src="{{ asset('front_assets/images/product-1.jpg') }}" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <img src="{{ asset('front_assets/images/product-1.jpg') }}" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    
                <div class="tab-pane" id="mens1">
    
                    <div class="row" id="new-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-2.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-6.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-3.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
    
                <div class="tab-pane" id="womens1">
    
                    <div class="row" id="new-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-9.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-6.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-3.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
    
                <div class="tab-pane" id="home-beauty1">
    
                    <div class="row" id="new-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-9.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-6.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</scetion>

<!-- End New Product Tab -->

<!-- Start Featured & Hot Deals Product Tab -->

<section id="featured__product">
    <div class="container mb-4">
    
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #293B5F; color: #fff; font-weight: 500;">
                        <h5 class="card-title text-center"><i style="font-size: 18px" class='fas'>&#xf52d;</i> Featured Products</h5>
                    </div>
            
                    <div class="card-body" >
                            
                        <div class="row" id="featured-product__content">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                    <div class="card-body">
                                        <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                        <h5 style="color: #219fed;">&#2547; 299</h5>
                                        <del class="text-muted"><span>&#2547; 350</span></del> 
                                        <span class="fw-bold" style="font-size: 12px;">50%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                    <div class="card-body">
                                        <a href="#"><p class="card-text fw-light mb-1">M4 Plus Smarts Band Waterproof Fitness Tracker Watch...</p></a>
                                        <h5 style="color: #219fed;">&#2547; 299</h5>
                                        <del class="text-muted"><span>&#2547; 350</span></del> 
                                        <span class="fw-bold" style="font-size: 12px;">50%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                    <div class="card-body">
                                        <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                        <h5 style="color: #219fed;">&#2547; 299</h5>
                                        <del class="text-muted"><span>&#2547; 350</span></del> 
                                        <span class="fw-bold" style="font-size: 12px;">50%</span>
                                    </div>
                                </div>
                            </div>
                           
                            
                        </div>
                            
                    </div>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #293B5F; color: #fff; font-weight: 500;">
                        <h5 class="card-title text-center"><i style="font-size: 18px" class='fab'>&#xf3ac;</i> Hot Deals Products</h5>
                    </div>
            
                    <div class="card-body">
                            
                        <div class="row" id="hotDeals-product__content">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                    <div class="card-body">
                                        <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                        <h5 style="color: #219fed;">&#2547; 299</h5>
                                        <del class="text-muted"><span>&#2547; 350</span></del> 
                                        <span class="fw-bold" style="font-size: 12px;">50%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                    <div class="card-body">
                                        <a href="#"><p class="card-text fw-light mb-1">M4 Plus Smarts Band Waterproof Fitness Tracker Watch...</p></a>
                                        <h5 style="color: #219fed;">&#2547; 299</h5>
                                        <del class="text-muted"><span>&#2547; 350</span></del> 
                                        <span class="fw-bold" style="font-size: 12px;">50%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                    <div class="card-body">
                                        <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                        <h5 style="color: #219fed;">&#2547; 299</h5>
                                        <del class="text-muted"><span>&#2547; 350</span></del> 
                                        <span class="fw-bold" style="font-size: 12px;">50%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Featured & Hot Deals Product Tab -->

<!-- Start Best Selling Product Tab -->

<section id="bestSelling__product">
    <div class="container mb-4">
        <div class="card">
    
            <div class="card-header" style="background-color: #293B5F; color: #fff; font-weight: 500;">
    
                <h5 class="card-title"><i style="font-size: 18px" class='fas'>&#xf1e2;</i> Best Selling Products</h5>
    
                <ul class="nav justify-content-center nav-tabs card-header-tabs" data-bs-tabs="tabs">
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#electornic3">Electronic Devise</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link" data-bs-toggle="tab" href="#mens3">Men's Fashion</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link" data-bs-toggle="tab" href="#womens3">Women's Fashion</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #219fed;" class="nav-link" data-bs-toggle="tab" href="#home-beauty3">Home Beauty</a>
                    </li>
                </ul>
    
            </div>
    
            <form class="card-body tab-content">
    
                <div class="tab-pane active" id="electornic3">
                    
                    <div class="row" id="best-selling-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">M4 Plus Smarts Band Waterproof Fitness Tracker Watch...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-5.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-2.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
    
                <div class="tab-pane" id="mens3">
    
                    <div class="row" id="best-selling-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-2.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-6.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-3.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
    
                <div class="tab-pane" id="womens3">
    
                    <div class="row" id="best-selling-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-9.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-6.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-3.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
    
                <div class="tab-pane" id="home-beauty3">
    
                    <div class="row" id="best-selling-product__tab-content">
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-9.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-6.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="./images/product-1.jpg" class="card-img-top" alt="product image" width="100%">
                                <div class="card-body">
                                    <a href="#"><p class="card-text fw-light mb-1">Smart Led Remote Control Bluetooth Speaker Music Bulb...</p></a>
                                    <h5 style="color: #219fed;">&#2547; 299</h5>
                                    <del class="text-muted"><span>&#2547; 350</span></del> 
                                    <span class="fw-bold" style="font-size: 12px;">50%</span>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</section>

<!-- End Best Selling Product Tab -->

<!-- Start Footer Design -->


<section id="footer__section" style="background-color: #293B5F; color: #fff;">
    <footer>
        <div class="container">
            <div class="row p-5">

                <div class="col-md-4">
                    <div class="footer__about">
                        <a href="/"><img src="./images/logo.png" alt="logo" width="90px" height="40px"></a>
                        <p class="mt-2">Address: 60-49 Road 11378 New York</p>
                        <p>Phone: +65 11.188.888</p>
                        <p>Email: hello@colorlib.com</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer__widget">
                        <h5>Useful Links</h5>
                        <ul style="list-style-type: none;">
                            <li>About Us</li>
                            <li>About Our Shop</li>
                            <li>Secure Shopping</li>
                            <li>Delivery infomation</li>
                            <li>Privacy Policy</li>
                            <li>Our Sitemap</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer__widget">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input class="form-control" type="text" placeholder="Enter your mail">
                            <button type="submit" class="btn btn-info mt-2">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <i style="font-size: 18px" class='fab me-2 mt-3'>&#xf09a;</i>
                            <i style="font-size: 18px" class='fab me-2 mt-3'>&#xf16d;</i>
                            <i style="font-size: 18px" class='fab me-2 mt-3'>&#xf0d2;</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pb-3">
                Copyright ©2022 All rights reserved | This template is made with  by ❤️ Anisuzzaman
            </div>
        </div>
    </footer>
    
</section>

<!-- End Footer Design -->

    <script src="{{ asset('front_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/script.js') }}"></script>
</body>
</html>