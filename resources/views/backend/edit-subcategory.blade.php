@extends('backend.master')

@section('title', 'Edit Subcategory')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">Manage Subcategory</a></li>
                <li class="breadcrumb-item active">Edit Subcategory</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Sucategory</h4>
                        <div class="basic-form">
                            <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="category_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($category->id == $subcategory->category_id) {{ "selected" }} @endif>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Subcategory</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="subcategory_name" 
                                            class="form-control @error('isExist') is-invalid @enderror" 
                                            placeholder="Enter Subategory Name..." 
                                            required autofocus autocomplete="off"
                                            value="{{ $subcategory->subcategory_name }}">

                                        <div class="invalid-feedback">
                                            @error('isExist')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Order</label>
                                    <div class="col-sm-10">
                                        <input 
                                            type="number" 
                                            name="subcategory_order" 
                                            class="form-control"
                                            value="{{ $subcategory->subcategory_order }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="edit_category" type="submit" class="btn btn-primary">Submit</button>
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