@extends('backend.master')

@section('title', 'List Product Images')

@section('custom_css')

<!-- DataTable -->
<link href="{{asset('assets/backend/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<style>
    .table td,
    .table th {
        min-width: 60px;
        text-align: center;
    }
</style>

@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('product-images.index') }}">Manage Product Images</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('product-images.index') }}">List Product Images</a></li>
            </ol>
        </div>
    </div>

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
                                            <td>{{ $product->subcategory ? $product->subcategory->subcategory_name : "NULL" }}</td>
                                            <td>{{ Str::of($product->product_detail->product_name)->limit(50)  }}</td>
                                            <td>
                                                @forelse ($product->product_images as $image)
                                                    <img id="master_img" src="{{ asset('uploads/product-images/' . $image->product_image_filename) }}" alt="Product Image" width="80px" height="80px">              
                                                @empty
                                                    <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
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

@endsection

@section('custom_js')
    
<!-- DataTable -->
<script src="{{ asset('assets/backend/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

@endsection
