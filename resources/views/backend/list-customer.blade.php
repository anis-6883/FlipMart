@extends('backend.master')

@section('title', 'List Customer')

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
                <li class="breadcrumb-item"><a href="#">Manage Customer</a></li>
                <li class="breadcrumb-item active"><a href="#">List Customer</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Customer</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('customer.create') }}">Add Customer</a>
                        <h5 class="ml-4 mt-4">Total Customer: <span class="badge bg-dark">{{ count($customers) }}</span></h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Mobile</th>
                                        <th>DOB</th>
                                        <th>Gneder</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $customer->username }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>
                                                @if ($customer->status == "Active")
                                                    <button id="status{{ $customer->id }}" onclick="changeStatus({{ $customer->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $customer->id }}" onclick="changeStatus({{ $customer->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{{ $customer->mobile ?: "NULL" }}</td>
                                            <td>{{ $customer->dob ?: "NULL" }}</td>
                                            <td>{{ $customer->gender ?: "NULL" }}</td>
                                            <td>{{ $customer->address ?: "NULL" }}</td>
                                            <td>{{ date('d-m-Y', strtotime($customer->created_at)) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('customer.update', $customer->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $customer->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete brand</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ $customer->username }}"</b> admin? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
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
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $customer->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Mobile</th>
                                        <th>DOB</th>
                                        <th>Gneder</th>
                                        <th>Address</th>
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
    function changeStatus(customer_id) {
        $(function() {
            var statusBtn = $(`#status${customer_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('customer.updateStatus') }}",
                type: "POST",
                data: {
                    customer_id,
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