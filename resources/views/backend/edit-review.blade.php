@extends('backend.master')

@section('title', 'Edit A Review')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('review.index') }}">Manage Review</a></li>
                <li class="breadcrumb-item active">Edit Review</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Review</h4>
                        <div class="basic-form">
                            <form action="{{ route('review.update', $review->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" name="user_id" class="form-control" value="{{ $review->user->username }}" readonly>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" name="product_id" class="form-control" value="{{ $review->product->product_detail->product_name }}" readonly>
                                    </div>
                
                                    <label class="col-sm-2 col-form-label">Review Text</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="review_text" class="form-control" required>{{ $review->review_text }}</textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Ratings</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="ratings" class="custom-select mr-sm-2" id="ratings" required>
                                            <option {{ $review->ratings == '1' ? "selected" : "" }}>1</option>
                                            <option {{ $review->ratings == '2' ? "selected" : "" }}>2</option>
                                            <option {{ $review->ratings == '3' ? "selected" : "" }}>3</option>
                                            <option {{ $review->ratings == '4' ? "selected" : "" }}>4</option>
                                            <option {{ $review->ratings == '5' ? "selected" : "" }}>5</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="review_status" class="custom-select mr-sm-2" id="review_status" required>
                                            <option {{ $review->review_status == 'Active' ? "selected" : "" }}>Active</option>
                                            <option {{ $review->review_status == 'Inactive' ? "selected" : "" }}>Inactive</option>
                                        </select>
                                    </div>
                                        
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="edit_review" type="submit" class="btn btn-primary">Submit</button>
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
