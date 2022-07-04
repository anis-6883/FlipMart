@extends('backend.master')

@section('title', 'List Slider')

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
                <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Manage Slider</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('slider.index') }}">List Slider</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Slider</h4>
                        <a class="btn btn-info ml-4 mt-4" href="{{ route('slider.create') }}">Add Slider</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Slider Name</th>
                                        <th>Image</th>
                                        <th>Slider Order</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $slider->slider_name }}</td>
                                            <td>
                                                @if ($slider->slider_image_filename != null)
                                                    <img id="master_img" src="{{ asset('uploads/sliders/' . $slider->slider_image_filename) }}" alt="Slider Image" width="80px" height="80px">  
                                                @else
                                                    <img id="master_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="80px" height="80px">
                                                @endif
                                            </td>
                                            <td>{{ $slider->slider_order }}</td>
                                            <td>
                                                @if ($slider->slider_status == "Active")
                                                    <button id="status{{ $slider->id }}" onclick="changeStatus({{ $slider->id }})" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                @else
                                                    <button id="status{{ $slider->id }}" onclick="changeStatus({{ $slider->id }})" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <a class="btn btn-info btn-xs mr-2" href="{{ route('slider.edit', $slider->id) }}">Edit</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal{{ $slider->id }}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete slider</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"{{ Str::of($slider->slider_name)->limit(20) }}"</b> slider? </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Yet</button>
                                                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal{{ $slider->id }}">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Slider Name</th>
                                        <th>Image</th>
                                        <th>Slider Order</th>
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

@endsection

@section('custom_js')
    
<!-- DataTable -->
<script src="{{ asset('assets/backend/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

<script>
    function changeStatus(slider_id) {
        $(function() {
            var statusBtn = $(`#status${slider_id}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "{{ route('slider.updateStatus') }}",
                type: "POST",
                data: {
                    slider_id,
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
