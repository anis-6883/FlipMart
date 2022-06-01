@extends('admin.include.app')

@section('title', 'Add New Slider')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Manage Slider</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('slider.create') }}">Add Slider</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Slider</h4>
                        <div class="basic-form">
                            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                
                                    <label class="col-sm-2 col-form-label">Slider Name</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="slider_name" 
                                            class="form-control @error('slider_name') is-invalid @enderror" 
                                            required autofocus autocomplete="off"
                                            value="{{ old('slider_name') }}">

                                        <div class="invalid-feedback">
                                            @error('slider_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Preview</label>
                                    <div class="col-sm-10">
                                        <img id="slider_img" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="100px" height="100px">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="file" 
                                            onchange="loadFile(event)" 
                                            name="slider_image_filename"
                                            class="form-control input-default @error('slider_image_filename') is-invalid @enderror"
                                            required>

                                        <div class="invalid-feedback">
                                            @error('slider_image_filename')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Slider Order</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="number" 
                                            name="slider_order" 
                                            class="form-control" 
                                            autocomplete="off"
                                            value="0"
                                            value="{{ old('slider_order') }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="slider_status" class="custom-select mr-sm-2" id="slider_status">
                                            <option>Active</option>
                                            <option selected>Inactive</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_coupon" type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
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
    var loadFile = function(event) {
        var output = document.getElementById('slider_img');
        output.parentElement.classList.add("mb-4")
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

@endsection