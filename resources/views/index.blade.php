@extends('frontend.include.app')

@section('title', 'Home Page')

@section('content')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 

      <!-- ============================================== SIDEBAR ============================================== -->

        <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 

          @include('frontend.include.sidebarNavigation') 
          
          {{-- @include('frontend.include.sidebarHotDeals') --}}
          
          {{-- @include('frontend.include.sidebarSpecialOffer') --}}

          {{-- @include('frontend.include.sidebarProductTags') --}}

          {{-- @include('frontend.include.sidebarSpecialDelas') --}}

          @include('frontend.include.sidebarNewsLetter')

          @include('frontend.include.sidebarTestimonials')

          <div class="home-banner"> <img src="{{ asset("assets/frontend/images/banners/LHS-banner.jpg") }}" alt="Image"> </div>

        </div>
          <!-- /.sidemenu-holder --> 

      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 

        <!-- ========================================== SECTION – HERO (SLIDER) ========================================= -->
        @include('frontend.include._slider')
        <!-- ========================================= SECTION – HERO (SLIDER) : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->
        @include('frontend.include._info-box')
        <!-- ============================================== INFO BOXES : END ============================================== --> 

        <!-- ============================================== SCROLL TABS [ NEW PRODUCTS ] ============================================== -->
        {{-- @include('frontend.include._scroll-tabs') --}}
        <!-- ============================================== SCROLL TABS : END [ NEW PRODUCTS ] ============================================== -->

        <!-- ============================================== WIDE BANNERS ============================================== -->
        @include('frontend.include._wide-banner')
        <!-- ============================================== WIDE BANNERS : END ============================================== -->

        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        {{-- @include('frontend.include._featured-products') --}}
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 

        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        @include('frontend.include._fullwide-banner')
        <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

        <!-- ============================================== Hot Deals PRODUCTS ============================================== -->
        {{-- @include('frontend.include._hotDeals-slider') --}}
        <!-- ============================================== Hot Deals PRODUCTS : END ============================================== --> 

        <!-- ============================================== BEST SELLER ============================================== -->
        @include('frontend.include._best-selling')
        <!-- ============================================== BEST SELLER : END ============================================== --> 
        
        <!-- ============================================== BLOG SLIDER ============================================== -->
        @include('frontend.include._blog-slider')
        <!-- ============================================== BLOG SLIDER : END ============================================== --> 
        
        
      </div>
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 

    </div>
    <!-- /.row --> 

    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('frontend.include._brand-slider')
    <!-- /.brand-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

  </div>
  <!-- /.container --> 
</div>
<!-- /#top-banner-and-menu --> 
@endsection


