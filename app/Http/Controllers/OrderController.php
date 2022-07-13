<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('order_detail')->latest()->get();
        return view('backend.list-order', compact('orders'));
    }

    public function show($order_id)
    {
        $order = Order::where('id', $order_id)->with('order_items')->first();
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->get();
        return view('backend.show-order', compact('order', 'order_items'));
    }

    public function edit($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('backend.edit-order', compact('order'));
    }

    public function update(Request $req, $order_id)
    {
        $order = Order::find($order_id);
        $order->order_status = $req->order_status;
        if($req->order_status == "Delivered")
        {
            $obj = Order_Detail::where('order_id', $order_id)->first();
            $obj->delivered_date = date('Y-m-d H:i:s');
            $obj->save();
        }
        $order->save();

        session()->flash('success', 'Order Status Updated Successfully!');
        return redirect()->route('admin.orderIndex');
    }

    public function pending()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Pending')->latest()->get();
        return view('backend.pending-order', compact('orders'));
    }

    public function processing()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Processing')->latest()->get();
        return view('backend.processing-order', compact('orders'));
    }

    public function halt()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Halt')->latest()->get();
        return view('backend.halt-order', compact('orders'));
    }

    public function shipping()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Shipping')->latest()->get();
        return view('backend.shipping-order', compact('orders'));
    }

    public function delivered()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Delivered')->latest()->get();
        return view('backend.delivered-order', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Completed')->latest()->get();
        return view('backend.completed-order', compact('orders'));
    }

    public function cancelled()
    {
        $orders = Order::with('order_detail')->where('order_status', 'Cancelled')->latest()->get();
        return view('backend.cancelled-order', compact('orders'));
    }

}
