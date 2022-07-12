@extends('backend.master')

@section('title', 'List Admin')

@section('custom_css')

<!-- DataTable -->
<link href="{{asset('assets/backend/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<style>
    .table td,
    .table th {
        min-width: 80px;
        text-align: center;
    }
</style>

@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.list') }}">Manage Admin</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.list') }}">List Admin</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Admin</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('admin.create') }}">Add Admin</a>
                        <h5 class="ml-4 mt-4">Total Admin: <span class="badge bg-dark">{{ count($admins) }}</span></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Admin Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Admin Type</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->admin_fullname }}</td>
                                            <td>{{ $admin->admin_username }}</td>
                                            <td>
                                                @if ($admin->admin_status == "Active")
                                                    <button id="status{{ $admin->id }}" onclick="changeStatus({{ $admin->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $admin->id }}" onclick="changeStatus({{ $admin->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{{ $admin->admin_type->admin_typename }}</td>
                                            <td>{{ date('d-m-Y', strtotime($admin->created_at)) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('admin.update', $admin->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $admin->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete brand</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ $admin->admin_fullname }}"</b> admin? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
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
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $admin->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Admin Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Admin Type</th>
                                        <th>Created At</th>
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

<script>
    function changeStatus(admin_id) {
        $(function() {
            var statusBtn = $(`#status${admin_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('admin.updateStatus') }}",
                type: "POST",
                data: {
                    admin_id,
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