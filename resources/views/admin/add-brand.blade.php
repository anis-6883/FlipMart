@extends('admin.include.app')

@section('title', 'Add New Brand')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Manage Brand</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('brand.create') }}">Add Brand</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Brand</h4>
                        <div class="basic-form">
                            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Brand</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="brand_name" 
                                            class="form-control @error('brand_name') is-invalid @enderror" 
                                            placeholder="Enter Brand Name..." 
                                            required autofocus autocomplete="off" value="{{ old('brand_name') }}">

                                        <div class="invalid-feedback">
                                            @error('brand_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Preview</label>
                                    <div class="col-sm-10 mb-4">
                                        <img id="brand_logo" src="{{ asset('assets/backend/images/no-image.png') }}" alt="No Image" width="100px" height="100px">
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
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection

@section('javascript')

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