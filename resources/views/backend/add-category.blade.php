@extends('backend.master')

@section('title', 'Add New Category')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Manage Category</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('category.create') }}">Add Category</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Category</h4>
                        <div class="basic-form">
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="category_name" 
                                            class="form-control @error('category_name') is-invalid @enderror" 
                                            placeholder="Enter Category Name..." 
                                            required autofocus autocomplete="off" value="{{ old('category_name') }}">

                                        <div class="invalid-feedback">
                                            @error('category_name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Order</label>
                                    <div class="col-sm-10">
                                        <input 
                                            type="number" 
                                            name="category_order" 
                                            class="form-control"
                                            value="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_category" type="submit" class="btn btn-primary">Submit</button>
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