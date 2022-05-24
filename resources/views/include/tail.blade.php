<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Contact Us</h4>
            </div>
            <!-- /.module-heading -->
            
            <div class="module-body">
              <ul class="toggle-footer" style="">
                <li class="media">
                  <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                  <div class="media-body">
                    <p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
                  </div>
                </li>
                <li class="media">
                  <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                  <div class="media-body">
                    <p>+(888) 123-4567<br>
                      +(888) 456-7890</p>
                  </div>
                </li>
                <li class="media">
                  <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                  <div class="media-body"> <span><a href="#">flipmart@themesground.com</a></span> </div>
                </li>
              </ul>
            </div>
            <!-- /.module-body --> 
          </div>
          <!-- /.col -->
          
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Customer Service</h4>
            </div>
            <!-- /.module-heading -->
            
            <div class="module-body">
              <ul class='list-unstyled'>
                <li class="first"><a href="#" title="Contact us">My Account</a></li>
                <li><a href="#" title="About us">Order History</a></li>
                <li><a href="#" title="faq">FAQ</a></li>
                <li><a href="#" title="Popular Searches">Specials</a></li>
                <li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
              </ul>
            </div>
            <!-- /.module-body --> 
          </div>
          <!-- /.col -->
          
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Corporation</h4>
            </div>
            <!-- /.module-heading -->
            
            <div class="module-body">
              <ul class='list-unstyled'>
                <li class="first"><a title="Your Account" href="#">About us</a></li>
                <li><a title="Information" href="#">Customer Service</a></li>
                <li><a title="Addresses" href="#">Company</a></li>
                <li><a title="Addresses" href="#">Investor Relations</a></li>
                <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
              </ul>
            </div>
            <!-- /.module-body --> 
          </div>
          <!-- /.col -->
          
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Why Choose Us</h4>
            </div>
            <!-- /.module-heading -->
            
            <div class="module-body">
              <ul class='list-unstyled'>
                <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                <li><a href="#" title="Blog">Blog</a></li>
                <li><a href="#" title="Company">Company</a></li>
                <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                <li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
              </ul>
            </div>
            <!-- /.module-body --> 
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-bar">
      <div class="container">
        <div class="col-xs-12 col-sm-6 no-padding social">
          <ul class="link">
            <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
            <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
            <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
            <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
            <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
            <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
            <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-6 no-padding">
          <div class="clearfix payment-methods">
            <ul>
              <li><img src="{{ asset("frontend_assets/images/payments/1.png") }}" alt=""></li>
              <li><img src="{{ asset("frontend_assets/images/payments/2.png") }}" alt=""></li>
              <li><img src="{{ asset("frontend_assets/images/payments/3.png") }}" alt=""></li>
              <li><img src="{{ asset("frontend_assets/images/payments/4.png") }}" alt=""></li>
              <li><img src="{{ asset("frontend_assets/images/payments/5.png") }}" alt=""></li>
            </ul>
          </div>
          <!-- /.payment-methods --> 
        </div>
      </div>
    </div>
  </footer>
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
                <li class="list-group-item">Product Code: <b id="m-product-code"></b></li>
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
  
  <!-- JavaScripts placed at the end of the document so the pages load faster --> 
  <script src="{{ asset("frontend_assets/js/jquery-1.11.1.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/bootstrap.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/bootstrap-hover-dropdown.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/owl.carousel.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/echo.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/jquery.easing-1.3.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/bootstrap-slider.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/jquery.rateit.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/lightbox.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/bootstrap-select.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/wow.min.js") }}"></script> 
  <script src="{{ asset("frontend_assets/js/sweetAlert.js") }}"></script>
  <script src="{{ asset("frontend_assets/js/scripts.js") }}"></script>

<!-- Start Add to Cart Model AJAX Script -->

<script>

      function fetchProductData(product_id) {
          $(function() {

              $.ajax({
                  url: "{{ route('fetchProductData') }}",
                  type: "POST",
                  data: {
                      product_id,
                      _token: "{{ csrf_token() }}"
                  },
                  success: function(result) {

                      $('#m-product-name').text(result.product.product_name);
                      $('#m-product-category').text(result.product.category.category_name);
                      $('#m-product-subcategory').text(result.product.subcategory.subcategory_name);

                      if(result.product.product_discounted_price)
                      {
                        $('#m-product-discount').text(result.product.product_discounted_price);
                      }else{
                        $('#m-product-discount').text(0);
                      }

                      $('#m-product-code').text(result.product.product_code);
                      $('#m-product-price').text(result.product_price);

                      // push image src
                      var img_path = "{{ asset('uploads/products/:img_name') }}";
                      img_path = img_path.replace(':img_name', result.product.product_master_image);
                      $('#m-product-image').attr('src', img_path);

                      // product color
                      $('#m-product-color').empty();
                      if(result.product_colors != "")
                      {
                        $.each(result.product_colors, function(key, value){
                          $('#m-product-color').append(`<option value=${value}>${value}</option>`);
                        });
                        $('#m-product-color-div').show();
                      }
                      else{
                        $('#m-product-color-div').hide();
                      }
                      
                      // product size
                      $('#m-product-size').empty();
                      if(result.product_sizes != "")
                      {
                        $.each(result.product_sizes, function(key, value){
                          $('#m-product-size').append(`<option value=${value}>${value}</option>`);
                        });
                        $('#m-product-size-div').show();
                      }
                      else{
                        $('#m-product-size-div').hide();
                      }

                      // push product id for submit it
                      $('#m-product-id').val(result.product.id); 
                      $('#m-product-qty').val(1); // push quantity default 1
                  }
              });
          });
      }

</script>

<!-- End Add to Cart Model AJAX Script -->

<!-- Start Add to Cart Function -->

<script>

      function addToCart(){

          $(function(){

              var product_id = $('#m-product-id').val();
              var product_color = $('#m-product-color option:selected').text();
              var product_size = $('#m-product-size option:selected').text();
              var product_qty = $('#m-product-qty').val();

              var url = "{{ route('cart.addToCart', ':product_id') }}";
              url = url.replace(':product_id', product_id);

              $.ajax({
                url,
                type: "POST",
                data:{
                  product_color,
                  product_size,
                  product_qty,
                  _token: "{{ csrf_token() }}",
                },
                success: function(result)
                {
                  miniCart();
                  $('#closeModel').click();

                  // start sweet alert

                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                  })

                  Toast.fire({
                    // type: 'success',
                    title: result.success
                  })

                  // end sweet alert
                }
              });
          });
          
      }

</script>

<!-- End Add to Cart Function -->

<!-- Start Get data from Cart -->

<script>

    function miniCart(){

      $(function(){

          $.ajax({
              type: "GET",
              url: "{{ route('cart.getFromCart') }}",
              dataType: "json",
              success: function(res)
              {
                var miniCart = "";
                $('#c-cartQty').text(res.cartQty);
                $('span[ id="c-cartTotal" ]').text(res.cartTotal);
                $('span[ id="c-cartSubTotal" ]').text(res.cartTotal);

                $.each(res.carts, function(key, value){

                    miniCart += `
                    <div class="cart-item product-summary">
                      <div class="row">
                        <div class="col-xs-4">
                            <div class="image"> 
                              <a href="#">
                                <img src="{{ asset('uploads/products/${value.options.image}') }}" alt="product image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <h3 class="name"><a href="#">${value.name}</a></h3>
                            <div class="price">$${value.price} * ${value.qty}</div>
                        </div>
                              <div class="col-xs-1 action"> 
                                <button type="submit" id="${value.rowId}" onclick="removeFromCart(this.id)">
                                  <i class="fa fa-trash"></i>
                                </button> 
                              </div>
                        </div>
                    </div>
                    <!-- /.cart-item -->
                    <div class="clearfix"></div>
                    <hr>`;

                });

                $('#loadMiniCart').html(miniCart);
              }
          });
      })
    }

    miniCart();

</script>

<!-- End Get Data From Cart -->

<!-- Start Remove From Cart -->

<script>

    function removeFromCart(rowId){

      var url = "{{ route('cart.removeFromCart', ':rowId') }}";
      url = url.replace(':rowId', rowId);

      $(function(){
        $.ajax({
          type: "POST",
          url,
          data:{
            _token: "{{ csrf_token() }}"
          },
          success: function(res){

            miniCart();
            $('#closeModel').click();

            // start sweet alert

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              icon: 'success',
              showConfirmButton: false,
              timer: 3000
            })

            Toast.fire({
              // type: 'success',
              title: res.success
            })

            // end sweet alert
          }
        });
      });
    }

</script>

<!-- End Remove From Cart -->

<!-- Start Add TO Wishlist -->

<script>

    function addToWishList(product_id){

      $(function(){
        $.ajax({
          type: "POST",
          url: "{{ route('wishlist.addToWishlist') }}",
          data:{
            _token: "{{ csrf_token() }}",
            product_id
          },
          success: function(res){
            
            countWishlist();
            // start sweet alert

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            })

            if($.isEmptyObject(res.error)){

              Toast.fire({
                title: res.success,
                icon: 'success',
              })
            }
            else{
              Toast.fire({
                title: res.error,
                icon: 'error',
              })
            }

            // end sweet alert
          }
        });
      });
    }

    function countWishlist()
    {
      $(function(){
        $.ajax({
          type: "GET",
          url: "{{ route('wishlist.countWishlist') }}",
          success: function(res){
            $('#wishlist-count').text(res.count);
          }
        });
      });
    }

    countWishlist();

</script>

<!-- End Add TO Wishlist -->

@yield('javascript')

  </body>
</html>