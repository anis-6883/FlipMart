@extends('admin.include.app')

@section('title', 'Edit New Sub-Subcategory')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('subSubcategory.index') }}">Manage Sub-Subcategory</a></li>
                <li class="breadcrumb-item active">Edit Sub-Subcategory</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit Sub-Sucategory</h4>
                        <div class="basic-form">
                            <form action="{{ route('subSubcategory.update', $sub_subCat->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="category_id" class="custom-select mr-sm-2" id="select_category">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($category->id == $sub_subCat->category_id) {{ "selected" }} @endif>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Subcategory</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="subcategory_id" class="custom-select mr-sm-2" id="select_subcategory"></select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Sub-Subcategory</label>
                                    <div class="col-sm-10 mb-4">
                                        <input 
                                            type="text" 
                                            name="sub_subcategory_name" 
                                            class="form-control @error('isExist') is-invalid @enderror" 
                                            placeholder="Enter Sub-Subategory Name..." 
                                            required autofocus autocomplete="off"
                                            value="{{ $sub_subCat->sub_subcategory_name }}">

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
                                            name="sub_subcategory_order" 
                                            class="form-control"
                                            value="{{ $sub_subCat->sub_subcategory_order }}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_subSubcategory" type="submit" class="btn btn-primary">Submit</button>
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
        $(function() {
            // ------------ ON PAGE LOAD GET CATEGORY ID AND LOAD SELETED SUBCATEGORY ------------ //
            var cat_id = $("#select_category").val();

            if (cat_id != "") {
                $.ajax({
                    url: "{{ route('product.loadSeletedSubcategory') }}",
                    type: "post",
                    data: {
                        category_id: cat_id,
                        subcategory_id: "{{ $sub_subCat->subcategory_id }}",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response) {
                            $("#select_subcategory").html(response);
                        } else {
                            $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");
                        }
                    }
                })
            }

            // ------------ WHEN CHANGE THE CATEGORY | LOAD SUBCATEGORY ------------ //
            $("#select_category").change(function() {

                let cat_id = $(this).val();
                if (cat_id != "") {
                    $.ajax({
                        url: "{{ route('product.loadSubcategory') }}",
                        type: "post",
                        data: {
                            category_id: cat_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response) {
                                $("#select_subcategory").html(response);
                            } else {
                                $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");
                            }
                        }
                    })
                }
            })
        });
    </script>
@endsection