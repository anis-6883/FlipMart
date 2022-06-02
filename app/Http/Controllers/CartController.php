<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        return response()->json(['success' => "Successfully Delete From Your Cart!"]);
    }

    // cartIncrement
    public function cartIncrement($rowId)
    {
        $cart = Cart::get($rowId);
        Cart::update($rowId, $cart->qty + 1);
        return response()->json(['success' => "Successfully Increment Your Cart!"]);
    }

    // cartDecrement
    public function cartDecrement($rowId)
    {
        $cart = Cart::get($rowId);
        Cart::update($rowId, $cart->qty - 1);
        return response()->json(['success' => "Successfully Decrement Your Cart!"]);
    }
}
