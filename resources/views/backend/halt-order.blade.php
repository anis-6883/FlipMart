@extends('backend.master')

@section('title', 'All Halt Orders')

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
                <li class="breadcrumb-item"><a href="{{ route('admin.orderIndex') }}">Manage Order</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('order.halt') }}">Halt Order</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Halt Orders: <span class="badge bg-dark">{{ count($orders) }}</span></h4>
                        <table class="table table-striped table-bordered zero-configuration">

                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Order Date</th>
                                    <th>Invoice No.</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d M, Y', strtotime($order->order_detail->order_date)) }}</td>
                                        <td>{{ $order->order_detail->invoice_no }}</td>
                                        <td>&#2547;{{ number_format($order->order_detail->grand_total, 2, '.', ',')  }}</td>
                                        <td>{{ $order->order_detail->payment_method }}</td>
                                        <td><span class="label gradient-9 btn-rounded">{{ $order->order_status }}</span></td>
                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <a href="{{ route('admin.orderShow', $order->id) }}" class="btn btn-primary btn-xs mr-2">Details</a>
                                                <a class="btn btn-info btn-xs mr-2" href="{{ route('admin.orderEdit', $order->id) }}">Edit</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="basicModal{{ $order->id }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete order</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Are you sure to delete <b>"{{ $order->order_detail->invoice_no }}"</b> order? </div>
                                                            <div class="modal-footer">
                                                                <form action="#" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Never Mind!</button>
                                                                    <button type="submit" class="btn btn-primary" disabled>Confirm</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Button trigger modal -->
                                                <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $order->id }}">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Order Date</th>
                                    <th>Invoice No.</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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

