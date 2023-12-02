<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $bags = auth()->user()->cart()->with('cartItems')->first();

    	return view('cart', compact('bags'));
    }

    public function store(Request $request)
    {
        try 
        {
            DB::beginTransaction();

            $product = $request->product_id;
            $quantity = $request->quantity;
            $price = $request->price;

            $cart = auth()->user()->cart()->firstOrCreate([
                'user_id' => auth()->id()
            ]);

            $item = $cart->cartItems()->where('product_id', $product)->first();

            if ($item) 
            {
                $item->update([
                    'quantity' => $item->quantity + $quantity
                ]);
            } 
            else 
            {
                $cart->cartItems()->create([
                    'product_id' => $product,
                    'price' => $price,
                    'quantity' => $quantity
                ]);
            }

            DB::commit();
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            dd($e->getMessage());
        }

        return redirect()->route('carts.index');
    }

    public function update(Request $request, $cart)
    {
        $item = auth()->user()->cart()->find($cart);

        if ($item) {
           $item->update([
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('carts.index');
    }

    public function destroy($cart)
    {
        try
        {
            auth()->user()->cart()->first()->cartItems()->where('id', $cart)->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Cart Item has been removed'
                ]
            );
        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

}
