@extends('admin.include.app')

@section('title', 'Edit A Product')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Manage Product</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Product</h4>
                        <div class="basic-form">
                            <form action="{{ route('product.destroy', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <label class="col-form-label">Category</label>
                                        <div class="mb-4">
                                            <select name="category_id" class="custom-select mr-sm-2" id="select_category">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if ($category->id == $product->category_id) {{ "selected" }} @endif>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Subcategory</label>
                                        <div class="mb-4">
                                            <select name="subcategory_id" class="custom-select mr-sm-2" id="select_subcategory"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Sub-Subategory</label>
                                        <div class="mb-4">
                                            <select name="sub_subcategory_id" class="custom-select mr-sm-2" id="select_sub_subcategory">
                                                @foreach ($sub_subcategories as $sub_subcategory)
                                                    <option value="{{ $sub_subcategory->id }}" @if ($sub_subcategory->id == $product->sub_subcategory_id) {{ "selected" }} @endif>
                                                        {{ $sub_subcategory->sub_subcategory_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="product_name" 
                                            class="form-control @error('product_name') is-invalid @enderror" 
                                            placeholder="Enter Product Name..." 
                                            required autocomplete="off"
                                            value="{{ $product->product_name }}"/>

                                        <div class="invalid-feedback">
                                            @error('product_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Code</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="product_code" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="{{ $product->product_code }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Summary</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="product_summary" id="richTextEditor1">{{ $product->product_summary }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Details</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="product_description" id="richTextEditor2">{{ $product->product_description }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Regular Price</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="product_regular_price" 
                                            class="form-control input-default" 
                                            required autocomplete="off" 
                                            value="{{ $product->product_regular_price }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discounted Price</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="product_discounted_price" 
                                            class="form-control input-default" 
                                            autocomplete="off"
                                            value="{{ $product->product_discounted_price }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discounted Start On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            class="form-control input-default jqdatepicker" 
                                            id="discount_start_date" 
                                            name="discount_start_date" 
                                            type="text" 
                                            autocomplete="off"
                                            value="{{ $product->discount_start_date }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discounted Ends On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            class="form-control input-default jqdatepicker" 
                                            id="discount_end_date" 
                                            name="discount_end_date" 
                                            type="text" 
                                            autocomplete="off" 
                                            value="{{ $product->discount_end_date }}"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Stock Quantity</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="product_quantity" 
                                            class="form-control input-default" 
                                            required autocomplete="off"
                                            value="{{ $product->product_quantity }}"/>
                                    </div>
                                                
                                    <label class="col-sm-2 col-form-label">Preview</label>
                                    <div class="col-sm-10 mb-4">
                                        <td>@if ($product->product_master_image != null)
                                            <img 
                                            id="master_img" 
                                            src="{{ asset('uploads/products/' . $product->product_master_image) }}" 
                                            alt="No Image" width="100px" height="100px">
                                        @else
                                            <img id="master_img" src="{{ asset('backend_assets/images/no-image.png') }}" 
                                            alt="No Image" width="100px" height="100px">
                                        @endif
                                        </td>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Master Image</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="file" 
                                            onchange="loadFile(event)" 
                                            name="product_master_image" 
                                            class="form-control input-default @error('product_master_image') is-invalid @enderror">

                                        <div class="invalid-feedback">
                                            @error('product_master_image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="product_status" class="custom-select mr-sm-2" id="product_status">
                                            <option @if ($product->product_status == 'Active') {{ "selected" }} @endif >Active</option>
                                            <option @if ($product->product_status == 'Inactive') {{ "selected" }} @endif >Inactive</option>
                                        </select>
                                    </div>

                                    
                                    <label class="col-sm-2 col-form-label">Product Offer</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="product_offer" class="custom-select mr-sm-2" id="product_offer">
                                            <option @if ($product->product_offer == 'Regular') {{ "selected" }} @endif>Regular</option>
                                            <option @if ($product->product_offer == 'Hot Deals') {{ "selected" }} @endif>Hot Deals</option>
                                            <option @if ($product->product_offer == 'Featured') {{ "selected" }} @endif>Featured</option>
                                            <option @if ($product->product_offer == 'Special Offer') {{ "selected" }} @endif>Special Offer</option>
                                            <option @if ($product->product_offer == 'Special Deals') {{ "selected" }} @endif>Special Deals</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Order</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="product_order" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="{{ $product->product_order }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Tags</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="product_tags"
                                            data-role="tagsinput"
                                            class="form-control"
                                            value="{{ $product->product_tags }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Colors</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="product_color"
                                            data-role="tagsinput"
                                            class="form-control"
                                            value="{{ $product->product_color }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Sizes</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="product_size"
                                            data-role="tagsinput"
                                            class="form-control"
                                            value="{{ $product->product_size }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_product" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection

@section('javascript')
    <script>
        $(function() {
            // ------------ ON PAGE LOAD GET CATEGORY ID AND LOAD SELETED SUBCATEGORY ------------ //
            var cat_id = $("#select_category").val();

            if (cat_id != "") {
                $.ajax({
                    url: "{{ route('product.loadSeletedSubcategory') }}",
                    type: "POST",
                    data: {
                        category_id: cat_id,
                        subcategory_id: "{{ $product->subcategory_id }}",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response) {
                            $("#select_subcategory").html(response);
                        } else {
                            $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");
                        }
                    }
                })
            }

            // ------------ WHEN CHANGE THE CATEGORY | LOAD SUBCATEGORY ------------ //
            $("#select_category").change(function() {

                let cat_id = $(this).val();
                if (cat_id != "") {
                    $.ajax({
                        url: "{{ route('product.loadSubcategory') }}",
                        type: "post",
                        data: {
                            category_id: cat_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response) {
                                $("#select_subcategory").html(response);
                                $("#select_sub_subcategory").html("<option value=''>Select Subcategory</option>");
                            }
                        }
                    })
                }
            })

            // ------------ WHEN CHANGE THE SUBCATEGORY | LOAD SUB-SUBCATEGORY ------------ //
            $("#select_subcategory").change(function() {

            let subcat_id = $(this).val();
            if (subcat_id != "") {
                $.ajax({
                    url: "{{ route('product.loadSubSubcategory') }}",
                    type: "POST",
                    data: {
                        subcategory_id: subcat_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response) {
                            $("#select_sub_subcategory").html(response);
                        } else {
                            $("#select_sub_subcategory").html("<option value=''>No Subcategory Found</option>");
                        }
                    }
                })
            }
            else{
                $("#select_sub_subcategory").html("<option value=''>Select Subcategory</option>");
            }
            })
        });

        var loadFile = function(event) {
            var output = document.getElementById('master_img');
            output.parentElement.classList.add("mb-4")
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection