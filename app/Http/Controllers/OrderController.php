<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('orderItems')->get();

        return view('components.backend.pages.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        try 
        {
            DB::beginTransaction();

            $user = auth()->user();

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 0,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            $cartItems = $request->products;

            foreach ($cartItems as $item) {
                $cartItem = CartItem::find($item['cart_item_id']);

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'price'=>$cartItem->price,
                    'product_title' => $cartItem->product->title,
                    'quantity' => $item['quantity'],
                ]);

                $cartItem->delete();
            }

            DB::commit();
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('order_confirmed')->with('success', 'Thank You for your Order');
    }

    public function show($order)
    {
        $order = Order::findOrFail($order);
        return view('components.backend.pages.orders.show', compact('order'));
    }

    public function edit($order)
    {
        $order = Order::findOrFail($order);
        return view('components.backend.pages.orders.edit', compact('order'));
    }

    public function update(Request $request, $order)
    {
        try 
        {
            $order = Order::findOrFail($order);
            $order->update([
                'status' => $request->status,
            ]);

            return redirect()->route('orders.index')->with('success', 'Order updated successfully');
        } 
        catch (\Exception $e) 
        {
            return back()->with('error', 'Failed to update order. ' . $e->getMessage());
        }
    }

    public function cancel_order($order)
    {
        $order = Order::findOrFail($order);

        $order->update(['status'=>4]);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('danger', 'Order Cancelled');
    }

    public function cancelled_orders()
    {
        $orders = Order::onlyTrashed()->with(['orderItems' => function ($query) 
        {
            $query->withTrashed();
        }])->get();
        return view('components.backend.pages.orders.cancelled', compact('orders'));
    }

    public function confirmed()
    {
        $orders = auth()->user()->orders()->get();

        return view('order_confirmed', compact('orders'));
    }

    public function restore($order)
    {
        //$this->authorize('looking_at_orders');

        $order = Order::onlyTrashed()->find($order);
        //dd($order);
        $order->update(['status' => 0]);
        $order->orderItems()->restore();
        $order->restore();
        return redirect()->route('cancelled')->with('success', 'Order Restored Successfully');
    }

    public function delete($order)
    {
        //$this->authorize('looking_at_orders');
        
        $order = Order::onlyTrashed()->find($order);

        $order->orderItems()->forceDelete();
        $order->forceDelete();

        return redirect()->route('orders.index')->with('danger', 'Order Removed Permanently');
    }

}
