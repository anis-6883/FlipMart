<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if($product->product_discounted_price != NULL){

            $discount_price = ($product->product_regular_price * $product->product_discounted_price) / 100;
            $product_price = $product->product_regular_price - $discount_price;

            Cart::add([
                'id' => $product_id, 
                'name' => $product->product_name, 
                'qty' => $request->product_qty, 
                'price' => $product_price, 
                'weight' => 1, 
                'options' => [
                    'size' => $request->product_size,
                    'color' => $request->product_color,
                    'image' => $product->product_master_image,
                    ]
            ]);

            return response()->json(['success' => "Successfully Added On Your Cart!"]);
        }
        else{

            Cart::add([
                'id' => $product_id, 
                'name' => $product->product_name, 
                'qty' => $request->product_qty, 
                'price' => $product->product_regular_price, 
                'weight' => 1, 
                'options' => [
                    'size' => $request->product_size,
                    'color' => $request->product_color,
                    'image' => $product->product_master_image,
                    ]
            ]);

            return response()->json(['success' => "Successfully Added On Your Cart!"]);
        }
    }
}
