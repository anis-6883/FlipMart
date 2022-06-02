<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // cart list
    public function index()
    {
        $cartQty = Cart::count();
        return view('list-cart', compact('cartQty'));
    }

    // addToCart
    public function addToCart(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if($product->product_discounted_price != NULL){

            $discount_price = ($product->product_regular_price * $product->product_discounted_price) / 100;
            $product_price = $product->product_regular_price - $discount_price;

            Cart::add([
                'id' => $product_id, 
                'name' => $product->product_name, 
                'slug' => $product->product_slug, 
                'qty' => $request->product_qty, 
                'price' => round($product_price),
                'weight' => 1, 
                'options' => [
                    'size' => $request->product_size,
                    'color' => $request->product_color,
                    'image' => $product->product_master_image,
                    'discounted_price' => $product->product_regular_price
                    ]
            ]);

            return response()->json(['success' => "Successfully Added On Your Cart!"]);
        }
        else{

            Cart::add([
                'id' => $product_id, 
                'name' => $product->product_name,
                'slug' => $product->product_slug,
                'qty' => $request->product_qty, 
                'price' => $product->product_regular_price,
                'weight' => 1, 
                'options' => [
                    'size' => $request->product_size,
                    'color' => $request->product_color,
                    'image' => $product->product_master_image,
                    'discounted_price' => 0
                    ]
            ]);

            return response()->json(['success' => "Successfully Added On Your Cart!"]);
        }
    }

    // get data from Cart
    public function getFromCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ]);
    }

    // product remove from Cart
    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);

        if(Cart::count() > 0)
        {
            if(Session::has('coupon'))
            {
                $coupon_code = session()->get('coupon')['coupon_code'];
                $coupon = Coupon::where(DB::raw('BINARY `coupon_code`'), $coupon_code)
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
                }
            }
            return response()->json(['success' => "Successfully Delete From Your Cart!"]);
        }
        else
        {
            Session::forget('coupon');
            return response()->json(['error' => "No Cart Available!"]);
        }
    }

    // cartIncrement
    public function cartIncrement($rowId)
    {
        $cart = Cart::get($rowId);
        Cart::update($rowId, $cart->qty + 1);

        if(Session::has('coupon'))
        {
            $coupon_code = session()->get('coupon')['coupon_code'];
            $coupon = Coupon::where(DB::raw('BINARY `coupon_code`'), $coupon_code)
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
            }
        }

        return response()->json(['success' => "Successfully Increment Your Cart!"]);
    }

    // cartDecrement
    public function cartDecrement($rowId)
    {
        $cart = Cart::get($rowId);
        Cart::update($rowId, $cart->qty - 1);

        if(Session::has('coupon'))
        {
            $coupon_code = session()->get('coupon')['coupon_code'];
            $coupon = Coupon::where(DB::raw('BINARY `coupon_code`'), $coupon_code)
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
                    'total_price' => round(Cart::total() - (Cart::total() * $coupon->discount_amount) / 100)
                ]);
            }
        }

        return response()->json(['success' => "Successfully Decrement Your Cart!"]);
    }
}
