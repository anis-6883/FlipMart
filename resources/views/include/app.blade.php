<!DOCTYPE html>
<html lang="en-US">

  @include('include._head')

<body class="cnt-home">
  
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 

  <!-- ============================================== TOP MENU ============================================== -->
  @include('include._top-menu')
  <!-- ============================================== TOP MENU : END ============================================== -->

  <!-- ============================================== TOP HEADER ============================================== -->
  @include('include._top-header')
  <!-- ============================================== TOP HEADER : END ============================================== -->
  
  <!-- ============================================== NAVBAR ============================================== -->
  @include('include._top-nav')
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>
<!-- ============================================== HEADER : END ============================================== -->


<!-- ============================================== MAIN CONTENT START ============================================== -->

@yield('content')

<!-- ============================================== MAIN CONTENT END ============================================== -->


<!-- ============================================================= FOOTER ============================================================= -->
@include('include._footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!--  Start Add to Cart Product Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="m-product-name"></h5>
        <button id="closeModel" style="margin-top: -21px" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">

          <div class="col-md-4">
              <img id="m-product-image" src="" class="img-thumbnail" alt="Product Images">
          </div>

          <div class="col-md-4">

              <ul class="list-group">
                <li class="list-group-item">Category: <b id="m-product-category"></b></li>
                <li class="list-group-item">Subcategory: <b id="m-product-subcategory"></b></li>
                <li class="list-group-item">Price: &#2547;<b id="m-product-price"></b></li>
                <li class="list-group-item">Discount: <b id="m-product-discount"></b>%</li>
                <li class="list-group-item">Stock: 
                  <b style="color: green" id="m-product-stock-avail"></b>
                  <b style="color: red" id="m-product-stock-out"></b>
                </li>
              </ul>

          </div>

          <div class="col-md-4">

              <div class="form-group" id="m-product-size-div">
                <label for="m-product-size">Choose Size</label>
                <select class="form-control" id="m-product-size"></select>
              </div>

              <div class="form-group" id="m-product-color-div">
                <label for="m-product-color">Choose Color</label>
                <select class="form-control" id="m-product-color"></select>
              </div>

              <div class="form-group">
                <label for="m-product-qty">Quantity</label>
                <input type="number" class="form-control" id="m-product-qty" min="1" max="10" value="1">
              </div>

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" id="m-product-id">
        <button type="submit" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
      </div>
    </div>
  </div>
</div>
<!--  End Add to Cart Product Modal --> 
  
  @include('include._scripts')

</body>
</html>