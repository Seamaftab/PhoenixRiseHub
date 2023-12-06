<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Src;
use App\Models\SrcTransaction;
use Illuminate\Http\Request;

class SrcController extends Controller
{

    public function index()
    {
        $srcRecords = Src::with('product')->get();
        return view('components.backend.pages.stockRecordCart.index', compact('srcRecords'));
    }

    public function create()
    {
        $user = auth()->user();
        $purchaseRequest = PurchaseRequest::where('sent_by', $user->id)->where('status', 1)->first();

        if ($purchaseRequest && $purchaseRequest->purchaseRequestItem) 
        {
            $product = Product::findOrFail($purchaseRequest->purchaseRequestItem->product_id);
            return view('components.backend.pages.stockRecordCart.create', compact('product', 'purchaseRequest'));
        }
        else
        {
            return redirect()->back()->with('error', 'You do not have an accepted request to create a stock record.');
        }
        
    }

    public function store(Request $request)
    {
        $src = Src::create([
            'product_id' => $request->product_id,
            'stock' => $request->stock,
            'status' => $request->status,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        SrcTransaction::create([
            'srcs_id' => $src->id,
            'quantity' => $request->stock,
            'status' => 1,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $purchaseRequest = PurchaseRequest::whereHas('purchaseRequestItem', function ($req) use ($request) 
        {
            $req->where('product_id', $request->product_id);
        })->first();

        $purchaseRequest->purchaseRequestItem()->delete();
        $purchaseRequest->delete();

        return redirect()->route('src.index')->with('success', 'Stock record created successfully.');
    }

    public function show(Src $src)
    {
        //
    }

    public function edit(Src $src)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Src $src)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Src $src)
    {
        //
    }
}
