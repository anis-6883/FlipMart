@extends('admin.include.app')

@section('title', 'Add New Product Images')

@section('css')
<style>
    .table td,
    .table th {
        min-width: 60px;
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
                <li class="breadcrumb-item"><a href="{{ route('product-images.index') }}">Manage Product Images</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('product-images.create') }}">Add Product Images</a></li>
            </ol>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="container-fluid mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong> 
                @endforeach
            </div>
        </div>
    @endif

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

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Product Images</h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Choose Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->subcategory->subcategory_name }}</td>
                                            <td>{{ Str::of($product->product_name)->limit(50)  }}</td>
                                            <td>
                                                @if ($product->product_master_image != null)
                                                    <img id="master_img" src="{{ asset('uploads/products/' . $product->product_master_image) }}" alt="Product Image" width="80px" height="80px">              
                                                @else
                                                    <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                                @endif
                                            </td>
                                            <form action="{{ route('product-images.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <td>
                                                    <input 
                                                        style="padding:20px 0 0 0" 
                                                        type="file" 
                                                        name="product_images[]" 
                                                        class="form-control input-default" 
                                                        multiple required>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </td>
                                                <td>
                                                    <button name="save_product_images" type="submit" class="btn btn-primary m-2">Submit</button>
                                                    <button type="reset" class="btn btn-warning">Cancel</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Choose Images</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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