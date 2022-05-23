@php
    $product_tags = App\Models\Product::groupBy('product_tags')->select('product_tags')->get();
@endphp


<!-- ============================================== PRODUCT TAGS ============================================== -->
<div class="sidebar-widget outer-bottom-small product-tag wow fadeInUp">
    <h3 class="section-title">Product Tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list"> 

            @foreach ($product_tags as $tag)
                <a class="item" href="{{ route('tagWiseProducts', $tag->product_tags) }}">
                    {{ $tag->product_tags }}
                </a>
            @endforeach
            
        </div>
        <!-- /.tag-list --> 
    </div>
    <!-- /.sidebar-widget-body --> 
</div>
<!-- /.sidebar-widget --> 
<!-- ============================================== PRODUCT TAGS : END ============================================== --> 
  