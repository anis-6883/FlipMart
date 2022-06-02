<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">

        <div class="cnt-account">
          <ul class="list-unstyled">
            
            @auth
              <li>
                <a href="{{ route('wishlist.index') }}">
                  Wishlist 
                  <span 
                    style="padding: 1px 7px; color:#000; background-color:#fff" 
                    class="badge badge-secondary" 
                    id="wishlist-count">
                    
                  </span>
                </a>
              </li> 
            @endauth
            <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
            <li><a href="{{ route('cart.index') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
            @guest
              <li><a href="{{ route('user.login') }}"><i class="icon fa fa-lock"></i>Login</a></li>
            @endguest

          </ul>
        </div>
        
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">USD</a></li>
                <li><a href="#">INR</a></li>
                <li><a href="#">GBP</a></li>
              </ul>
            </li>
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">English</a></li>
                <li><a href="#">French</a></li>
                <li><a href="#">German</a></li>
              </ul>
            </li>

            @auth
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value"><i class="icon fa fa-user"></i> {{ auth()->user()->username }} </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('user.profile') }}">Profile</a></li>
                <li><a href="{{ route('user.changePassword') }}">Change Password</a></li>
                <li><a href="#" 
                  onclick="event.preventDefault(); 
                  document.querySelector('#logout-form').submit();">
                  Logout</a>
                </li>
                  <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                      @csrf
                  </form> 
              </ul>
            </li>
            @endauth
          </ul>
          <!-- /.list-unstyled --> 
        </div>

        
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->