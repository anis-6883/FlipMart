@php
$categories = App\Models\Category::where('category_status', 'Active')->orderBy('category_name')->get();
@endphp

<!-- ============================================== DROPDOWN SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-small">
    <h3 class="section-title">shop by</h3>
    <div class="widget-header">
      <h4 class="widget-title">Category</h4>
    </div>
    <div class="sidebar-widget-body">
      <div class="accordion">

        @foreach ($categories as $category)

          <div class="accordion-group">
            <div class="accordion-heading"> 
                <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                    {{ $category->category_name }}
                </a>
            </div>
            <!-- /.accordion-heading -->

            @php
              $subcategories = App\Models\Subcategory::where([
                ['category_id', $category->id], 
                ['subcategory_status', 'Active']
                ])->orderBy('subcategory_name')->get();
            @endphp

            <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
              <div class="accordion-inner">
                <ul>

                    @foreach ($subcategories as $subcategory)

                    <li>
                      <a href="{{ route('subCategoryWiseProducts', [$subcategory->id, $subcategory->subcategory_name]) }}">
                      {{ $subcategory->subcategory_name }}
                      </a>
                    </li>

                    @endforeach

                </ul>
              </div>
              <!-- /.accordion-inner --> 
            </div>
            <!-- /.accordion-body --> 
          </div>
          <!-- /.accordion-group -->

        @endforeach
        
      </div>
      <!-- /.accordion --> 
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
</div>