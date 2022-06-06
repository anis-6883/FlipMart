<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
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
            return view('checkout', compact('carts', 'cartQty', 'cartTotal'));
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

        if($req->payment_method == 'stripe')
            return view('stripe', compact('cartQty', 'cartTotal', 'arr'));
        else if($req->payment_method == 'card')
            return redirect()->back()->withErrors(['error' => 'Card is not Accepted Now...']);
        else
            return view('cod', compact('cartQty', 'cartTotal', 'arr'));
    }

    // Order By Stripe Payment Gateway
    public function stripeOrder(Request $req)
    {
        if(Session::has('coupon'))
            $total_amount = session()->get('coupon')['total_price'] + 50;
        else
            $total_amount = Cart::total() + 50;

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

        // Insert Data Into Order Table
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'username' => $req->username,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'payment_type' => $charge->payment_method_details->type,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'order_number' => $charge->metadata->order_id,
            'amount' => $total_amount,
            'invoice_no' => 'FOS_' . date('YmdHis') . '_' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('Y-m-d H:i:s'), 
            'order_month' => Carbon::now()->format('F'), 
            'order_year' => Carbon::now()->format('Y'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
        ]);

        $invoice = Order::find($order_id);
        $mail_data = [
            'invoice_no' => $invoice->invoice_no,
            'username' => $invoice->username,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
            'order_amount' => $invoice->amount,
            'transaction_id' => $invoice->transaction_id,
            'order_date' => $invoice->order_date,
            'order_number' => $invoice->order_number,
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
        }

        // Delete the Coupon if it Exist
        if(Session::has('coupon'))
            Session::forget('coupon');

        // Delete the Cart Item after Purchased
        Cart::destroy();

        return redirect('/')->with('success', 'Your Order Placed Successfully...');
    }

    // Order By Cash On Delivery
    public function codOrder(Request $req)
    {
        if(Session::has('coupon'))
            $total_amount = session()->get('coupon')['total_price'] + 50;
        else
            $total_amount = Cart::total() + 50;

        // Insert Data Into Order Table
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'username' => $req->username,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'payment_type' => 'cash',
            'payment_method' => 'Cash On Delivery',
            'transaction_id' => 'txn_' . uniqid() . mt_rand(10000000, 99999999),
            'currency' => 'Taka',
            'order_number' => uniqid() . mt_rand(10000000, 99999999),
            'amount' => $total_amount,
            'invoice_no' => 'FOS_' . uniqid() . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('Y-m-d H:i:s'), 
            'order_month' => Carbon::now()->format('F'), 
            'order_year' => Carbon::now()->format('Y'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
        ]);

        $invoice = Order::find($order_id);
        $mail_data = [
            'invoice_no' => $invoice->invoice_no,
            'username' => $invoice->username,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
            'order_amount' => $invoice->amount,
            'transaction_id' => $invoice->transaction_id,
            'order_date' => $invoice->order_date,
            'order_number' => $invoice->order_number,
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
        }

        // Delete the Coupon if it Exist
        if(Session::has('coupon'))
            Session::forget('coupon');

        // Delete the Cart Item after Purchased
        Cart::destroy();

        return redirect('/')->with('success', 'Your Order Placed Successfully...');
    }
}
