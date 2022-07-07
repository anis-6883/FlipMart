<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Order_Detail;
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
        if(Session::has('coupon'))
            $total_amount = session()->get('coupon')['total_price'] + session()->get('shipping_charge');
        else
            $total_amount = Cart::total() + session()->get('shipping_charge');

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
            'invoice_no' => 'FOS_' . uniqid() . '_' . mt_rand(100000, 999999),
            'order_date' => Carbon::now()->format('Y-m-d H:i:s'), 
            'order_month' => Carbon::now()->format('F'), 
            'order_year' => Carbon::now()->format('Y'),
            'delivery_charge' => session()->get('shipping_charge'),
            'discount_coupon' => isset(session()->get('coupon')['coupon_title']) ? session()->get('coupon')['coupon_title'] : NULL,
            'discount_amount' => isset(session()->get('coupon')['discount_price']) ? session()->get('coupon')['discount_price'] : NULL,
            'total_before_discount' => Cart::total(),
            'grand_total' => $total_amount,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
        ]);

        $invoice = Order::with('order_detail')->findOrFail($order_id);
        $mail_data = [
            'invoice_no' => $invoice->order_detail->invoice_no,
            'username' => $invoice->order_detail->username,
            'email' => $invoice->order_detail->email,
            'phone' => $invoice->order_detail->phone,
            'address' => $invoice->order_detail->address,
            'order_amount' => $invoice->order_detail->amount,
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
        }


        return "Done";

        // $invoice = Order::with('order_detail')->findOrFail($order_id);
        // $mail_data = [
        //     'invoice_no' => $invoice->order_detail->invoice_no,
        //     'username' => $invoice->order_detail->username,
        //     'email' => $invoice->order_detail->email,
        //     'phone' => $invoice->order_detail->phone,
        //     'address' => $invoice->order_detail->address,
        //     'order_amount' => $invoice->order_detail->grand_total,
        //     'transaction_id' => $invoice->order_detail->transaction_id,
        //     'order_date' => $invoice->order_detail->order_date,
        //     'order_number' => $invoice->order_detail->order_number,
        //     'total_item' => Cart::count()
        // ];

        // Mail::to($req->email)->send(new OrderMail($mail_data));

        
        // // Delete the Coupon if it Exist
        // if(Session::has('coupon'))
        //     Session::forget('coupon');

        // // Delete the Cart Item after Purchased
        // Cart::destroy();

        // session()->flash('success', 'Your Order Placed Successfully...');
        // return redirect()->route('home');
    }
}
