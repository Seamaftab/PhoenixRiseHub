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

    public function confirmed()
    {
        $orders = auth()->user()->orders()->get();

        return view('order_confirmed', compact('orders'));
    }

}
