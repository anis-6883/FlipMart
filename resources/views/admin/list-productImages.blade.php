@extends('admin.include.app')

@section('title', 'List Product Images')

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
                <li class="breadcrumb-item active"><a href="{{ route('product-images.index') }}">List Product Images</a></li>
            </ol>
        </div>
    </div>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has($msg))
        <div class="container-fluid mt-3">
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session($msg) }}</strong> 
            </div>
        </div>
        @endif
    @endforeach  


    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">List Product Images</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('product-images.create') }}">Add Product Images</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Product</th>
                                        <th>Images</th>
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
                                                @forelse ($product->product_image as $image)
                                                    <img id="master_img" src="{{ asset('uploads/product-images/' . $image->product_image_filename) }}" alt="Product Image" width="80px" height="80px">              
                                                @empty
                                                    <img id="master_img" src="{{ asset('backend_assets/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                                @endforelse
                                            </td>
                                            <td>
                                                <a href="{{ route('product-images.edit', $product->id) }}" name="update_product_images" class="btn btn-primary m-2">Update</a>
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