
@extends('admin.include.app')

@section('title', 'Show Product')

@section('css')
<style>
    .table td,
    .table th {
        min-width: 80px;
        text-align: center;
    }
</style>
@endsection

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Manage Product</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Show Product</a></li>
            </ol>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="container-fluid mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('success') }}</strong> 
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Show Product</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('product.edit', $product->id) }}">Edit Product</a>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered zero-configuration">

                                <tbody>
                                    
                                    <tr>
                                        <th style="color: blue">Attribute</th>
                                        <th style="color: blue">Value</th>
                                    </tr>
                                    <tr>
                                        <th>Product ID</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $product->category->category_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subcategory</th>
                                        <td>{{ $product->subcategory->subcategory_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub-Subcategory</th>
                                        <td>{{ $product->sub_subcategory->sub_subcategory_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td>{{ $product->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Slug</th>
                                        <td>{{ $product->product_slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Code</th>
                                        <td>{{ $product->product_code ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Tags</th>
                                        <td>{{ $product->product_tags ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Size</th>
                                        <td>{{ $product->product_size ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Color</th>
                                        <td>{{ $product->product_color ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Order</th>
                                        <td>{{ $product->product_order ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Summary</th>
                                        <td>{!! $product->product_summary ?: 'NULL' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Description</th>
                                        <td>{!! $product->product_description ?: 'NULL' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Master Image</th>
                                        <td>
                                            @if ($product->product_master_image != null)
                                                <img id="master_img" src="{{ asset('uploads/products/' . $product->product_master_image) }}" alt="No Image" width="80px" height="80px">  
                                            @else
                                                <img id="master_img" src="{{ asset('backend_assets/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product Regular Price</th>
                                        <td>{{ $product->product_regular_price }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Discount Price</th>
                                        <td>{{ $product->product_discounted_price ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount Start Date</th>
                                        <td>{{ $product->discount_start_date ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount End Date</th>
                                        <td>{{ $product->discount_end_date ?: 'NULL' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Quantity</th>
                                        <td>{{ $product->product_quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Offer</th>
                                        <td>{{ $product->product_offer }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Status</th>
                                        <td>{{ $product->product_status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>
                                            {{ date('d-m-Y', strtotime($product->created_at)) }}
                                            {{-- {{ $product->created_at->diffForHumans() }} --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ date('d-m-Y', strtotime($product->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
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