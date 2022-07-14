<!--**********************************
    Sidebar start
***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">

            {{-- <li class="nav-label">Dashboard</li> --}}
            <li>
                <a href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            @if (session()->get('flipmart_admin_login')['admin_typename'] == 'Root Admin')

                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class='fas menu-icon'>&#xf500;</i> <span class="nav-text">Admins</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.create') }}">Add Admin</a></li>
                        <li><a href="{{ route('admin.list') }}">List Admins</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class='fas menu-icon'>&#xf500;</i> <span class="nav-text">Customers</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('customer.create') }}">Add Customer</a></li>
                        <li><a href="{{ route('customer.list') }}">List Customers</a></li>
                    </ul>
                </li>

            @endif
            

            {{-- <li class="nav-label">Manage Category</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf46d;</i> <span class="nav-text">Categories</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('category.create') }}">Add Category</a></li>
                    <li><a href="{{ route('category.index') }}">List Categories</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">Manage Subcategory</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf0cb;</i> <span class="nav-text">Subcategories</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('subcategory.create') }}">Add Subcategory</a></li>
                    <li><a href="{{ route('subcategory.index') }}">List Subcategories</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">Manage Sub-Subcategory</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf0ca;</i> <span class="nav-text">Sub-Subcategories</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('subSubcategory.create') }}">Add Sub-Subcategory</a></li>
                    <li><a href="{{ route('subSubcategory.index') }}">List Sub-Subcategories</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">Manage Brand</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf57d;</i> <span class="nav-text">Brands</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('brand.create') }}">Add Brand</a></li>
                    <li><a href="{{ route('brand.index') }}">List Brands</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">Manage Product</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf54e;</i> <span class="nav-text">Products</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('product.create') }}">Add Product</a></li>
                    <li><a href="{{ route('product.index') }}">List Products</a></li>
                </ul>
            </li>
            
            {{-- <li class="nav-label">Manage Product Image</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf302;</i> <span class="nav-text">Product Images</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('product-images.create') }}">Add Product Images</a></li>
                    <li><a href="{{ route('product-images.index') }}">List Product Images</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">Manage Coupon</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf3ff;</i> <span class="nav-text">Coupons</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('coupon.create') }}">Add Coupon</a></li>
                    <li><a href="{{ route('coupon.index') }}">List Coupons</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">Manage Slider</li> --}}
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf1de;</i> <span class="nav-text">Sliders</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('slider.create') }}">Add Slider</a></li>
                    <li><a href="{{ route('slider.index') }}">List Sliders</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas menu-icon'>&#xf291;</i> <span class="nav-text">Orders</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.orderIndex') }}">All Orders</a></li>
                    <li><a href="{{ route('order.pending') }}">Pending Orders</a></li>
                    <li><a href="{{ route('order.processing') }}">Processing Orders</a></li>
                    <li><a href="{{ route('order.halt') }}">Halt Orders</a></li>
                    <li><a href="{{ route('order.shipping') }}">Shipping Orders</a></li>
                    <li><a href="{{ route('order.delivered') }}">Delivered Orders</a></li>
                    <li><a href="{{ route('order.completed') }}">Completed Orders</a></li>
                    <li><a href="{{ route('order.cancelled') }}">Cancelled Orders</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class='fas fa-star-half-alt'></i> <span class="nav-text">Reviews</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('review.index') }}">List Reviews</a></li>
                </ul>
            </li>

            {{-- <li class="nav-label">End Nav</li> --}}

            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->