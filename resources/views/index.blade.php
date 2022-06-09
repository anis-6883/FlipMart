@extends('include.app')

@section('title', 'Home Page')

@section('content')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 

      <!-- ============================================== SIDEBAR ============================================== -->

        <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 

          @include('include.sidebarNavigation') 
          
          @include('include.sidebarHotDeals')
          
          @include('include.sidebarSpecialOffer')

          {{-- @include('include.sidebarProductTags') --}}

          @include('include.sidebarSpecialDelas')

          @include('include.sidebarNewsLetter')

          @include('include.sidebarTestimonials')

          <div class="home-banner"> <img src="{{ asset("assets/frontend/images/banners/LHS-banner.jpg") }}" alt="Image"> </div>

        </div>
          <!-- /.sidemenu-holder --> 

      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 

        <!-- ========================================== SECTION – HERO (SLIDER) ========================================= -->
        @include('include._slider')
        <!-- ========================================= SECTION – HERO (SLIDER) : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->
        @include('include._info-box')
        <!-- ============================================== INFO BOXES : END ============================================== --> 

        <!-- ============================================== SCROLL TABS [ NEW PRODUCTS ] ============================================== -->
        @include('include._scroll-tabs')
        <!-- ============================================== SCROLL TABS : END [ NEW PRODUCTS ] ============================================== -->

        <!-- ============================================== WIDE BANNERS ============================================== -->
        @include('include._wide-banner')
        <!-- ============================================== WIDE BANNERS : END ============================================== -->

        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        @include('include._featured-products')
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 

        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        @include('include._fullwide-banner')
        <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

        <!-- ============================================== Hot Deals PRODUCTS ============================================== -->
        @include('include._hotDeals-slider')
        <!-- ============================================== Hot Deals PRODUCTS : END ============================================== --> 

        <!-- ============================================== BEST SELLER ============================================== -->
        @include('include._best-selling')
        <!-- ============================================== BEST SELLER : END ============================================== --> 
        
        <!-- ============================================== BLOG SLIDER ============================================== -->
        @include('include._blog-slider')
        <!-- ============================================== BLOG SLIDER : END ============================================== --> 
        
        
      </div>
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 

    </div>
    <!-- /.row --> 

    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('include._brand-slider')
    <!-- /.brand-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 

  </div>
  <!-- /.container --> 
</div>
<!-- /#top-banner-and-menu --> 
@endsection


