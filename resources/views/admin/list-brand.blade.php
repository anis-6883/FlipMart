@extends('admin.include.app')

@section('title', 'List Brand')

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
                <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Manage Brand</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('brand.index') }}">List Brand</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Brand</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('brand.create') }}">Add Brand</a>
                        <h5 class="ml-4 mt-4">Total Brand: <span class="badge bg-dark">{{ count($brands) }}</span></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td>
                                                @if ($brand->brand_status == "Active")
                                                    <button id="status{{ $brand->id }}" onclick="chnageStatus({{ $brand->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $brand->id }}" onclick="chnageStatus({{ $brand->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($brand->brand_image != null)
                                                    <img id="brand_img" src="{{ asset('uploads/brands/' . $brand->brand_image) }}" alt="Brand Image" width="80px" height="80px">  
                                                @else
                                                    <img id="brand_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                                @endif
                                            </td>
                                            <td>
                                                {{-- @php
                                                    $date = date_parse($brand->created_at);
                                                    echo $date['day'] . " - " . $date['month'] . " - " . $date['year'];
                                                @endphp --}}
                                                {{ $brand->created_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('brand.edit', $brand->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $brand->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete brand</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ $brand->brand_name }}"</b> brand? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Never Mind</button>
                                                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $brand->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
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
    function chnageStatus(brand_id) {
        $(function() {
            var statusBtn = $(`#status${brand_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('brand.updateStatus') }}",
                type: "POST",
                data: {
                    brand_id,
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

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    @if (session()->has('success'))
        Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
        })
    @endif
    
</script>

@endsection