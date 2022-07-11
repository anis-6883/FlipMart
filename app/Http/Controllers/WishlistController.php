<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('frontend.list-wishlist', compact('wishlists'));
    }

    public function store(Request $request)
    {
        if(Auth::check())
        {
            $exists = Wishlist::where([
                ['user_id', Auth::id()],
                ['product_id', $request->product_id],
            ])->exists();

            if(!$exists)
            {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                ]);
                return response()->json(['success' => 'Successfully Add To Wishlist!']);
            }

            return response()->json(['error' => 'This Product Already Exists!']);
        }
        else
            return response()->json(['error' => 'At First Login Your Account!']);
    }

    // Count Wishlist
    public function countWishlist()
    {
        $countWishlist = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $countWishlist]);
    }

    // Destroy Wishlist
    public function destroy($product_id)
    {
        $wishlist = Wishlist::where([
            ['user_id', Auth::id()],
            ['product_id', $product_id],
        ])->first();

        $wishlist->delete();
        session()->flash('success', 'Wishlist Deleted Successfully!');
        return redirect()->back();
    }
}
