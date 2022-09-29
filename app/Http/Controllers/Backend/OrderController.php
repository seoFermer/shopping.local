<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate();
        return view('backend.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('backend.order.show', compact('order'));
    }

    public function productDelete(Order $order, Product $product)
    {
        $order->product()->detach($product->id);

       if($order->product()->count() === 0){
            $order->delete();
            return redirect()->route('dashboard.order.index');
        };

        return back();
    }

}
