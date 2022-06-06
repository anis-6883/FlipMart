<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.list-order', compact('orders'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($order_id)
    {
        $order = Order::where([ ['id', $order_id], ['user_id', Auth::id()] ])->with('order_items')->first();
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->get();
        return view('admin.show-order', compact('order', 'order_items'));
    }

    public function edit($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.edit-order', compact('order'));
    }

    public function update(Request $req, $order_id)
    {
        $order = Order::find($order_id);
        $order->order_status = $req->order_status;
        $order->save();
        return redirect()->route('admin.orderIndex')->with('success', 'Order Status Updated Successfully!');
    }

    public function destroy($id)
    {
        //
    }
}
