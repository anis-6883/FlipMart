<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.list-coupon', compact('coupons'));
    }

    public function create()
    {
        return view('admin.add-coupon');
    }

    public function store(Request $req)
    {
        $valid_data = $req->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'coupon_status' => 'required',
        ]);
        
        $valid_data['usable_per_person'] = $req->usable_per_person;
        $valid_data['usable_in_total'] = $req->usable_in_total;
        $valid_data['coupon_start_date'] = $req->coupon_start_date;
        $valid_data['coupon_end_date'] = $req->coupon_end_date;

        Coupon::create($valid_data);
        return redirect()->route('coupon.index')->with('success', 'Coupon is Created Successfully!');
    }

    public function edit($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        return view('admin.edit-coupon', compact('coupon'));
    }

    public function update(Request $req, $coupon_id)
    {
        $valid_data = $req->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'coupon_status' => 'required',
        ]);

        $valid_data['usable_per_person'] = $req->usable_per_person;
        $valid_data['usable_in_total'] = $req->usable_in_total;
        $valid_data['coupon_start_date'] = $req->coupon_start_date;
        $valid_data['coupon_end_date'] = $req->coupon_end_date;

        Coupon::find($coupon_id)->update($valid_data);
        return redirect()->route('coupon.index')->with('success', 'Coupon is Updated Successfully!');
    }

    public function destroy(Request $req, $coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon_title = $coupon->coupon_title;
        $coupon->delete();
        $req->session()->flash('success', "Coupon \"$coupon_title\" has Deleted Successfully...");
        return redirect()->route('coupon.index');
    }
}
