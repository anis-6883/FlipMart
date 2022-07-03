@extends('backend.master')

@section('title', 'Edit A Brand')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Manage Brand</a></li>
                <li class="breadcrumb-item active">Edit Brand</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Brand</h4>
                        <div class="basic-form">
                            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Brand</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="brand_name" 
                                            class="form-control @error('brand_name') is-invalid @enderror" 
                                            value="{{ $brand->brand_name }}"
                                            required autofocus autocomplete="off">

                                        <div class="invalid-feedback">
                                            @error('brand_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Preview</label>
                                    <div class="col-sm-10 mb-4">
                                        <td>@if ($brand->brand_image != null)
                                            <img 
                                            id="brand_logo" 
                                            src="{{ asset('uploads/brands/' . $brand->brand_image) }}" 
                                            alt="Brand Image" width="100px" height="100px">
                                        @else
                                            <img id="brand_logo" src="{{ asset('assets/backend/images/no-image.png') }}" 
                                            alt="No Image" width="100px" height="100px">
                                        @endif
                                        </td>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Brand Logo</label>
                                    <div class="col-sm-10">
                                        <input 
                                            type="file" 
                                            onchange="loadFile(event)" 
                                            name="brand_image" 
                                            class="form-control input-default @error('brand_image') is-invalid @enderror">

                                        <div class="invalid-feedback">
                                            @error('brand_image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_brand" type="submit" class="btn btn-primary">Submit</button>
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

@endsection

@section('custom_js')

<script>
    var loadFile = function(event) {
        var output = document.getElementById('brand_logo');
        output.parentElement.classList.add("mb-4")
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

@endsection