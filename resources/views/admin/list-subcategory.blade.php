
@extends('admin.include.app')

@section('title', 'List Subcategory')

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
                <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">Manage Subcategory</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('subcategory.index') }}">List Subcategory</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Subcategory</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('subcategory.create') }}">Add Subcategory</a>
                        <h5 class="ml-4 mt-4">Total Subcategory: <span class="badge bg-dark">{{ count($subcategories) }}</span></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category</th>
                                        <th>Subcategory Name</th>
                                        <th>Status</th>
                                        <th>Subcategory Order</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($subcategories as $subcategory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subcategory->category->category_name }}</td>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td>
                                                @if ($subcategory->subcategory_status == "Active")
                                                    <button id="status{{ $subcategory->id }}" onclick="chnageStatus({{ $subcategory->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $subcategory->id }}" onclick="chnageStatus({{ $subcategory->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{{ $subcategory->subcategory_order }}</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($subcategory->created_at)) }}
                                                {{-- {{ $subcategory->created_at->diffForHumans() }} --}}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('subcategory.edit', $subcategory->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $subcategory->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Subcategory</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ $subcategory->subcategory_name }}"</b> Sucategory? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST">
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
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $subcategory->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category</th>
                                        <th>Subcategory Name</th>
                                        <th>Status</th>
                                        <th>Subcategory Order</th>
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
    function chnageStatus(subcategory_id) {
        $(function() {
            var statusBtn = $(`#status${subcategory_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('subcategory.updateStatus') }}",
                type: "post",
                data: {
                    subcategory_id,
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