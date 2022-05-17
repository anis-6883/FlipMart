@extends('admin.include.app')

@section('title', 'Delete Product Images')

{{-- @section('css')
<style>
    .table td,
    .table th {
        min-width: 60px;
        text-align: center;
    }
</style>
@endsection --}}

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('product-images.index') }}">Manage Product Images</a></li>
                <li class="breadcrumb-item active">Delete Product Images</li>
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

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Delete Product Images</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <tbody>
                                    
                                    <tr>
                                        <th>Product Name</th>
                                        <td>{{ Str::of($product->product_name)->limit(50)  }}</td>

                                    </tr>
                                    <tr>
                                        <th>Product Images</th>
                                        <td>
                                            <div class="row">
                                                @foreach ($product->product_image as $image)
                                                <div class="col-md-3">
                                                    <div class="card" style="width: 200px">
                                                        <img width="100%" src="{{ asset('uploads/product-images/' . $image->product_image_filename) }}" class="card-img-top" alt="product_image">
                                                        <div class="card-body text-center">
                                                            <button name="delete_product_images" class="btn btn-danger m-2" 
                                                            onclick="document.querySelector('#delete_image{{ $image->id }}').submit();">
                                                                Delete
                                                            </button>
                                                            @if ($image->image_status == "Active")
                                                                <button id="status{{ $image->id }}" onclick="changeStatus({{ $image->id }})" class="badge badge-success px-2">
                                                                    Active
                                                                </button>
                                                            @else
                                                                <button id="status{{ $image->id }}" onclick="changeStatus({{ $image->id }})" class="badge badge-danger px-2">
                                                                    Inactive
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <form method="POST" id="delete_image{{ $image->id }}" action="{{ route('product-images.destroy', $image->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Action</th>
                                        <td>
                                            <div class="modal fade" id="basicModal">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Product Images</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Are You Sure To Delete All Product Images?</div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('product-images.destroyAll', $product->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Yet</button>
                                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#basicModal">Delete All</button>
                                        </td>
                                    </tr>
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product</th>
                                        <th>Images</th>
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
    function changeStatus(image_id) {
        $(function() {
            var statusBtn = $(`#status${image_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('productImage.updateStatus') }}",
                type: "POST",
                data: {
                    image_id,
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