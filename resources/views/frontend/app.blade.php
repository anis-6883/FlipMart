<!DOCTYPE html>
<html lang="en-US">

  @include('frontend.include._head')

<body class="cnt-home">
  
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 

  <!-- ============================================== TOP MENU ============================================== -->
  @include('frontend.include._top-menu')
  <!-- ============================================== TOP MENU : END ============================================== -->

  <!-- ============================================== TOP HEADER ============================================== -->
  @include('frontend.include._top-header')
  <!-- ============================================== TOP HEADER : END ============================================== -->
  
  <!-- ============================================== NAVBAR ============================================== -->
  @include('frontend.include._top-nav')
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>
<!-- ============================================== HEADER : END ============================================== -->


<!-- ============================================== MAIN CONTENT START ============================================== -->

  @yield('content')

<!-- ============================================== MAIN CONTENT END ============================================== -->


<!-- ============================================================= FOOTER ============================================================= -->
  @include('frontend.include._footer')
<!-- ============================================================= FOOTER : END============================================================= -->  
  
  @include('frontend.include._scripts')
  
  <!--  Start Add to Cart Product Modal -->
  @include('frontend.include._cart-modal')
  <!--  End Add to Cart Product Modal -->

</body>
</html>