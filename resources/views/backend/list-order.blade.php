@extends('admin.include.app')

@section('title', 'All Order List')

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
                <li class="breadcrumb-item"><a href="">Manage Order</a></li>
                <li class="breadcrumb-item active"><a href="">List Coupon</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Orders:</h4>
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
                                        <td>{{ date('d M, Y', strtotime($order->order_date)) }}</td>
                                        <td>{{ $order->invoice_no }}</td>
                                        <td>&#2547;{{ $order->grand_total }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            @if ($order->order_status != "Delivered")
                                                <span class="label gradient-9 btn-rounded">{{ $order->order_status }}</span>
                                            @else
                                                <span class="label gradient-2 btn-rounded">{{ $order->order_status }}</span>
                                            @endif
                                        </td>
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
                                                            <div class="modal-body">Are you sure to delete <b>"{{ $order->invoice_no }}"</b> order? </div>
                                                            <div class="modal-footer">
                                                                <form action="#" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Never Mind</button>
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
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection

