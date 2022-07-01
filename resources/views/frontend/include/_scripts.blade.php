<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{ asset("assets/frontend/js/jquery-1.11.1.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/bootstrap.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/bootstrap-hover-dropdown.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/owl.carousel.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/echo.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/jquery.easing-1.3.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/bootstrap-slider.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/jquery.rateit.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/lightbox.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/bootstrap-select.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/wow.min.js") }}"></script> 
<script src="{{ asset("assets/frontend/js/sweetAlert.js") }}"></script>
<script src="{{ asset("assets/frontend/js/scripts.js") }}"></script>

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

                      if(result.product.product_quantity > 0)
                      {
                        $('#m-product-stock-avail').text("Available");
                        $('#m-product-stock-out').text("");
                      }else{
                        $('#m-product-stock-out').text("Stock Out");
                        $('#m-product-stock-avail').text("");
                      }

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
                // $('span[ id="c-cartTotal" ]').text(res.cartTotal);
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
                            <h3 class="name"><a href="#">${value.name.slice(0, 30) + "..."}</a></h3>

                            <div class="price">&#2547;${value.price} * ${value.qty}</div>
                            
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
            loadMyCart();
            couponCalculation();
            $('#closeModel').click();

            // start sweet alert

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              icon: 'success',
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
                $(".shopping-cart").hide();
                $('#no-cart-alert').html(`
                <div class="col-md-12">
                        <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No Cart Added Yet!</h1>
                            <p class="lead">There are no cart yet. Add your products to cart and they will show here.</p>
                            <p><a href="{{ route('home') }}">Go TO Home</a></p>
                        </div>
                        </div>
                </div>`
                );
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
            
            @if (Auth::check())
              countWishlist();
            @endif

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

    function countWishlist(){
      
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

    @if (Auth::check())
      countWishlist();
    @endif

</script>

<!-- End Add TO Wishlist -->

<!-- Sweet Alert For All -->
<script>
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4500,
      timerProgressBar: true,
      didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
  })

  @error('error')
      Toast.fire({
          icon: 'error',
          title: '{{ $message }}'
      })
  @enderror

  @if (session()->has('success'))
      Toast.fire({
          icon: 'success',
          title: '{{ session('success') }}'
      })
  @endif
  
</script>

<!-- End Sweet Alert For All -->

@yield('javascript')
