
@extends('admin.include.app')

@section('title', 'List Product')

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
                <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">List Product</a></li>
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
                        <h4 class="card-title">List Product</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('product.create') }}">Add Product</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Reg. Price</th>
                                        <th>Status</th>
                                        <th>Stock Qty</th>
                                        <th>Created</th>
                                        <th>Dis. Price</th>
                                        <th>Dis. Start</th>
                                        <th>Dis. End</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>{{ $product->subcategory_name }}</td>
                                            <td>{{ Str::of($product->product_name)->limit(50)  }}</td>
                                            <td>
                                                @if ($product->product_master_image != null)
                                                    <img id="master_img" src="{{ asset('uploads/products/' . $product->product_master_image) }}" alt="No Image" width="80px" height="80px">  
                                                @else
                                                    <img id="master_img" src="{{ asset('admin_asset/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                                @endif
                                            </td>
                                            <td>{{ $product->product_regular_price }}</td>
                                            <td>
                                                @if ($product->product_status == "Active")
                                                    <button id="status{{ $product->id }}" onclick="chnageStatus({{ $product->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $product->id }}" onclick="chnageStatus({{ $product->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{{ $product->product_quantity }}</td>
                                            <td>
                                                @php
                                                    $date = date_parse($product->created_at);
                                                    echo $date['day'] . " - " . $date['month'] . " - " . $date['year'];
                                                @endphp
                                            </td>
                                            <td>{{ $product->product_discounted_price ?? 0 }}</td>
                                            <td>
                                                @php
                                                    $date = date_parse($product->discount_start_date);
                                                    echo $date['day'] . " - " . $date['month'] . " - " . $date['year'];
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $date = date_parse($product->discount_end_date);
                                                    echo $date['day'] . " - " . $date['month'] . " - " . $date['year'];
                                                @endphp
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('product.edit', $product->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $product->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Product</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ Str::of($product->product_name)->limit(20) }}"</b> Product? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $product->id }}">Delete</button>
                                                </div>
                                            </td>
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
                                        <th>Reg. Price</th>
                                        <th>Status</th>
                                        <th>Stock Qty</th>
                                        <th>Created</th>
                                        <th>Dis. Price</th>
                                        <th>Dis. Start</th>
                                        <th>Dis. End</th>
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

@section('javascript')

<script>
    function chnageStatus(product_id) {
        $(function() {
            var statusBtn = $(`#status${product_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('product.updateStatus') }}",
                type: "post",
                data: {
                    product_id,
                    statusText: statusText === "Active" ? "Inactive" : "Active",
                    _token: "{{ csrf_token() }}"
                },
                success: function(result) {
                    if (result) {
                        if (statusText === "Active") {
                            statusBtn.text("Inactive");
                            statusBtn.removeClass("badge-success");
                            statusBtn.addClass("badge-danger");
                        } else {
                            statusBtn.text("Active");
                            statusBtn.removeClass("badge-danger");
                            statusBtn.addClass("badge-success");
                        }
                    }
                }
            });
        });
    }
</script>

@endsection