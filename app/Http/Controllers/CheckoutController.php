<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderItem;
use App\Models\Product_Detail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        if(Cart::count() > 0)
        {
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            return view('frontend.checkout', compact('carts', 'cartQty', 'cartTotal'));
        }
        else{
            return redirect()->route('home')->withErrors(['error' => 'Shopping At least One Product For Chechout...']);
        }
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        $arr['username'] = $req->username;
        $arr['email'] = $req->email;
        $arr['phone'] = $req->phone;
        $arr['address'] = $req->address;

        if($req->district == 1)
            $arr['shipping_charge'] = 50;
        else if($req->district == 2)
            $arr['shipping_charge'] = 70;
        else
            return redirect()->back()->withErrors(['error' => 'Please, Select Your District!']);

        if($req->payment_method == 'stripe')
            return view('frontend.stripe', compact('cartQty', 'cartTotal', 'arr'));
        else if($req->payment_method == 'card')
            return redirect()->back()->withErrors(['error' => 'Card is not Accepted Now...']);
        else
            return view('frontend.cod', compact('cartQty', 'cartTotal', 'arr'));
    }

    // Order By Stripe Payment Gateway
    public function stripeOrder(Request $req)
    {
        // Add Shipping Charge
        if(Session::has('coupon'))
            $total_amount = session()->get('coupon')['total_price'] + $req->shipping_charge;
        else
            $total_amount = Cart::total() + $req->shipping_charge;

        \Stripe\Stripe::setApiKey('sk_test_51It11HBUiGp7cYCIKvsdX1U79hEPlV8pJNIKlSXovRGnQguAQKXnWG3KWGF51lirwfWayyueMovNcUcLob82PBmp00i73daEOl');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_amount * 100,
        'currency' => 'usd',
        'description' => 'Flipmart Online Shop',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);

        // Insert Data Into Orders Table
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'coupon_id' => Session::has('coupon') ? session()->get('coupon')['coupon_id'] : NULL,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Insert Data Into OrderDetails Table
        $obj = new Order_Detail;
        $obj->order_id = $order_id;
        $obj->username = $req->username;
        $obj->email = $req->email;
        $obj->phone = $req->phone;
        $obj->address = $req->address;
        $obj->payment_type = $charge->payment_method_details->type;
        $obj->payment_method = 'Stripe';
        $obj->transaction_id = $charge->balance_transaction;
        $obj->currency = $charge->currency;
        $obj->order_number = $charge->metadata->order_id;
        $obj->invoice_no = 'FOS_' . uniqid() . mt_rand(10000000, 99999999);
        $obj->order_date = date('Y-m-d H:i:s');
        $obj->order_month = date('F');
        $obj->order_year = date('Y');
        $obj->delivery_charge = $req->shipping_charge;
        $obj->discount_coupon = Session::has('coupon') ? session()->get('coupon')['coupon_code'] : NULL;
        $obj->discount_amount = Session::has('coupon') ? session()->get('coupon')['discount_price'] : NULL;
        $obj->total_before_discount = Cart::total();
        $obj->grand_total = $total_amount;
        $obj->save();

        // Insert Data Into OrderItems Table
        $invoice = Order::with('order_detail')->findOrFail($order_id);
        $mail_data = [
            'invoice_no' => $invoice->order_detail->invoice_no,
            'username' => $invoice->order_detail->username,
            'email' => $invoice->order_detail->email,
            'phone' => $invoice->order_detail->phone,
            'address' => $invoice->order_detail->address,
            'order_amount' => $invoice->order_detail->grand_total,
            'transaction_id' => $invoice->order_detail->transaction_id,
            'order_date' => $invoice->order_detail->order_date,
            'order_number' => $invoice->order_detail->order_number,
            'total_item' => Cart::count()
        ];

        Mail::to($req->email)->send(new OrderMail($mail_data));

        // Insert Data Into OrderItem Table
        $carts = Cart::content();
        foreach($carts as $cart)
        {
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);

            $obj2 = Product_Detail::where('product_id', $cart->id)->first();
            $obj2->product_stock -= $cart->qty; 
            $obj2->total_sold += $cart->qty;
            $obj2->save();
        }

        // Delete the Coupon if Exist
        if(Session::has('coupon'))
            Session::forget('coupon');

        // Delete the Cart Item after Purchased
        Cart::destroy();

        session()->flash('success', 'Your Order Placed Successfully...');
        return redirect()->route('home');
    }

    // Order By Cash On Delivery
    public function codOrder(Request $req)
    {
        // Add Shipping Charge
        if(Session::has('coupon'))
            $total_amount = session()->get('coupon')['total_price'] + $req->shipping_charge;
        else
            $total_amount = Cart::total() + $req->shipping_charge;

        // Insert Data Into Orders Table
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'coupon_id' => Session::has('coupon') ? session()->get('coupon')['coupon_id'] : NULL,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Insert Data Into OrderDetails Table
        $obj = new Order_Detail;
        $obj->order_id = $order_id;
        $obj->username = $req->username;
        $obj->email = $req->email;
        $obj->phone = $req->phone;
        $obj->address = $req->address;
        $obj->payment_type = 'cash';
        $obj->payment_method = 'Cash On Delivery';
        $obj->transaction_id = 'txn_' . uniqid() . mt_rand(10000000, 99999999);
        $obj->currency = 'Taka';
        $obj->order_number = uniqid() . mt_rand(10000000, 99999999);
        $obj->invoice_no = 'FOS_' . uniqid() . mt_rand(10000000, 99999999);
        $obj->order_date = date('Y-m-d H:i:s');
        $obj->order_month = date('F');
        $obj->order_year = date('Y');
        $obj->delivery_charge = $req->shipping_charge;
        $obj->discount_coupon = Session::has('coupon') ? session()->get('coupon')['coupon_code'] : NULL;
        $obj->discount_amount = Session::has('coupon') ? session()->get('coupon')['discount_price'] : NULL;
        $obj->total_before_discount = Cart::total();
        $obj->grand_total = $total_amount;
        $obj->save();

        // Insert Data Into OrderItems Table
        $carts = Cart::content();
        foreach($carts as $cart)
        {
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);

            $obj2 = Product_Detail::where('product_id', $cart->id)->first();
            $obj2->product_stock -= $cart->qty; 
            $obj2->total_sold += $cart->qty;
            $obj2->save();
        }

        // Mail to Order Invoice
        $invoice = Order::with('order_detail')->findOrFail($order_id);
        $mail_data = [
            'invoice_no' => $invoice->order_detail->invoice_no,
            'username' => $invoice->order_detail->username,
            'email' => $invoice->order_detail->email,
            'phone' => $invoice->order_detail->phone,
            'address' => $invoice->order_detail->address,
            'order_amount' => $invoice->order_detail->grand_total,
            'transaction_id' => $invoice->order_detail->transaction_id,
            'order_date' => $invoice->order_detail->order_date,
            'order_number' => $invoice->order_detail->order_number,
            'total_item' => Cart::count()
        ];

        Mail::to($req->email)->send(new OrderMail($mail_data));

        // Delete the Coupon if Exist
        if(Session::has('coupon'))
            Session::forget('coupon');

        // Delete the Cart Item after Purchased
        Cart::destroy();

        session()->flash('success', 'Your Order Placed Successfully...');
        return redirect()->route('home');
    }
}
