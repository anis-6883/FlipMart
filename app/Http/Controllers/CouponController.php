<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    // Coupon List
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.list-coupon', compact('coupons'));
    }

    // Create Coupon Page
    public function create()
    {
        return view('backend.add-coupon');
    }

    // Store Coupon
    public function store(Request $req)
    {
        $valid_data = $req->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'discount_pct' => 'required',
            'usable_per_person' => 'required',
            'usable_in_total' => 'required',
            'coupon_start_date' => 'required',
            'coupon_end_date' => 'required',
            'coupon_status' => 'required',
        ]);

        Coupon::create($valid_data);

        session()->flash('success', 'Coupon is Created Successfully!');
        return redirect()->route('coupon.index');
    }

    // Edit Coupon Page
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.edit-coupon', compact('coupon'));
    }

    // Update Coupon
    public function update(Request $req, $id)
    {
        $valid_data = $req->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required',
            'discount_pct' => 'required',
            'usable_per_person' => 'required',
            'usable_in_total' => 'required',
            'coupon_start_date' => 'required',
            'coupon_end_date' => 'required',
            'coupon_status' => 'required',
        ]);

        Coupon::findOrFail($id)->update($valid_data);

        session()->flash('success', 'Coupon is Updated Successfully!');
        return redirect()->route('coupon.index');
    }

    // Delete Coupon
    public function destroy(Request $req, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon_title = $coupon->coupon_title;
        $coupon->delete();
        $req->session()->flash('success', "Coupon \"$coupon_title\" has Deleted Successfully...");
        return redirect()->route('coupon.index');
    }

    // Apply Coupon
    public function applyCoupon(Request $req)
    {
        $coupon = Coupon::where(DB::raw('BINARY `coupon_code`'), $req->coupon_code)
                    ->where('coupon_end_date', '>=', Carbon::now()->format('Y-m-d H:i:s'))
                    ->where('coupon_status', 'Active')
                    ->first();
        if($coupon)
        {
            Session::put('coupon', [
                'coupon_title' => $coupon->coupon_title,
                'coupon_code' => $coupon->coupon_code,
                'discount_amount' => $coupon->discount_amount,
                'discount_price' => round((Cart::total() * $coupon->discount_amount) / 100),
                'total_price' => round(Cart::total() - (Cart::total() * $coupon->discount_amount) / 100),
            ]);
            return response()->json(['success' => "Your Coupon is Implemented!"]);
        }
        else{
            return response()->json(['error' => "Your Coupon is Invalid!"]);
        }
    }

    // Calculate Coupon
    public function couponCalculate()
    {
        if(Session::has('coupon'))
        {
            return response()->json([
                'subtotal' => Cart::total(),
                'coupon_title' => session()->get('coupon')['coupon_title'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'discount_price' => session()->get('coupon')['discount_price'],
                'total_price' => session()->get('coupon')['total_price']
            ]);
        }
        else
            return response()->json(['total' => Cart::total()]);
    }

    // Remove Coupon
    public function couponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => "Your Coupon is Removed!"]);
    }
}
