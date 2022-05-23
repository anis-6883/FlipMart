@php
$categories = App\Models\Category::where('category_status', 'Active')->orderBy('category_name')->get();
@endphp

<!-- ================================== SIDEBAR NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
<div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
<nav class="yamm megamenu-horizontal">
  <ul class="nav">

    @foreach ($categories as $category)
    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name }}</a>
      <ul class="dropdown-menu mega-menu">
        <li class="yamm-content">
          <div class="row">

            @php
              $subcategories = App\Models\Subcategory::where([
                ['category_id', $category->id], 
                ['subcategory_status', 'Active']
                ])->orderBy('subcategory_name')->get();
            @endphp

            <!-- /.col -->
            @foreach ($subcategories as $subcategory)
              <div class="col-sm-12 col-md-3">

                <h2 class="title">
                  <a href="{{ route('subCategoryWiseProducts', [$subcategory->id, $subcategory->subcategory_name]) }}">
                    {{ $subcategory->subcategory_name }}
                  </a>
                </h2>

                <ul class="links list-unstyled">
                    @php
                      $sub_subcategories = App\Models\Sub_Subcategory::where([
                        ['subcategory_id', $subcategory->id],
                        ['sub_subcategory_status', 'Active'],
                        ])->get();
                    @endphp

                    @foreach ($sub_subcategories as $sub_subcategory)
                      <li>
                        <a href="{{ route('sub_subCategoryWiseProducts', [$sub_subcategory->id, $sub_subcategory->sub_subcategory_name]) }}">
                        {{ $sub_subcategory->sub_subcategory_name }}
                        </a>
                      </li>
                    @endforeach

                </ul>
              </div>
              <!-- /.col -->
            @endforeach

          </div>
          <!-- /.row --> 
        </li>
        <!-- /.yamm-content -->
      </ul>
      <!-- /.dropdown-menu --> </li>
    <!-- /.menu-item -->
    
    @endforeach
    
  </ul>
  <!-- /.nav --> 
</nav>
<!-- /.megamenu-horizontal --> 
</div>
<!-- /.side-menu -->

    <!-- ================================== SIDEBAR NAVIGATION : END ================================== -->