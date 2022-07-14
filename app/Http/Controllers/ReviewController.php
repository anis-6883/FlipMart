<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Review List
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('backend.list-review', compact('reviews'));
    }

    // Store Review
    public function store(Request $req)
    {
        $product_id = $req->product_id;

        $req->validate([
            'ratings' => 'required',
            'review_text' => 'required',
        ]);

        // check for ordered or not by user
        $order_exists = DB::table('orders as o')
                        ->join('order_items as oi', 'o.id', '=', 'oi.order_id', 'inner')
                        ->where([
                            ['o.user_id', Auth::user()->id],
                            ['oi.product_id', $product_id]
                        ])->exists();

        if(!$order_exists)
        {
            session()->flash('warning', 'You Have to Buy it For Doing Reviews!');
            return redirect()->back();
        }
        else
        {
            $obj = new Review;
            $obj->product_id = $product_id;
            $obj->user_id = Auth::user()->id;
            $obj->review_text = $req->review_text;
            $obj->ratings = $req->ratings;
            $obj->save();

            session()->flash('success', 'Thanks for your valuable reviews! We will Active it a Few Moment Later...');
            return redirect()->back();
        }
    }

    // Update Review
    public function update(Request $req, $id)
    {
        if(!$req->isMethod('PUT'))
        {
            $review = Review::with('user', 'product')->findOrFail($id);
            return view('backend.edit-review', compact('review'));
        }
        else
        {
            $req->validate([
                'review_text' => 'required',
                'ratings' => 'required',
                'review_status' => 'required',
            ]);
            
            $review = Review::findOrFail($id);
            $review->review_text = $req->review_text;
            $review->ratings = $req->ratings;
            $review->review_status = $req->review_status;
            $review->save();

            session()->flash('success', 'Review is Updated Successfully!');
            return redirect()->route('review.index');
        }
    }

    // Delete Review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        session()->flash('success', 'Review is Deleted Successfully!');
        return redirect()->back();
    }
}
