<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = DB::table('coupons')->orderBy('created_at', 'desc')->get();
        return view('admin.list-coupon', compact('coupons'));
    }

    public function create()
    {
        return view('admin.add-coupon');
    }

    public function store(Request $req)
    {
        $cat_obj = new Coupon;

        $req->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'discount_amount' => 'required'
        ]);
        
        $cat_obj->coupon_title = $req->post('coupon_title');
        $cat_obj->coupon_code = $req->post('coupon_code');
        $cat_obj->discount_amount = $req->post('discount_amount');
        $cat_obj->created_at = date("Y-m-d H:i:s");
        $cat_obj->save();

        $req->session()->flash('success', 'Coupon is Created Successfully!');
        return redirect()->route('coupon.index');
    }

    public function edit($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        return view('admin.edit-coupon', compact('coupon'));
    }

    public function update(Request $req, $coupon_id)
    {
        $req->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'discount_amount' => 'required'
        ]);

        $cat_obj = Coupon::find($coupon_id);
        $cat_obj->coupon_title = $req->post('coupon_title');
        $cat_obj->coupon_code = $req->post('coupon_code');
        $cat_obj->discount_amount = $req->post('discount_amount');
        $cat_obj->updated_at = date("Y-m-d H:i:s");
        $cat_obj->save();

        $req->session()->flash('success', 'Coupon is Updated Successfully!');
        return redirect()->route('coupon.index');
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
