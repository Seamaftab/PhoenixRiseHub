<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view_purchase_request');

        $purchaseRequests = PurchaseRequest::with('purchaseRequestItem')->get();
        return view('components.backend.pages.purchaseRequests.index', compact('purchaseRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create_purchase_request');
        
        $products = Product::all();
        return view('components.backend.pages.purchaseRequests.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchaseRequest = PurchaseRequest::create([
            'title' => $request->title,
            'status' => 0,
            'forward_to' => 1,
            'sent_by' => 2,
            'note' => $request->note,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $product = Product::findOrFail($request->product_id);

        PurchaseRequestItem::create([
            'purchase_request_id' => $purchaseRequest->id,
            'product_id' => $product->id,
            'product_title' => $product->title,
            'quantity' => $request->quantity,
            'estimated_cost' => $request->estimated_cost,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('purchaseRequests.index')->with('success', 'Purchase request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($purchaseRequest)
    {
        $purchaseRequest = PurchaseRequest::with('purchaseRequestItem')->find($purchaseRequest);
        return view('components.backend.pages.purchaseRequests.show', compact('purchaseRequest'));
    }

    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        $this->authorize('update_purchase_request');

        $purchaseRequest->update([
            'status'=> $request->status,
        ]);

        return redirect()->route('purchaseRequests.index')->with('success', 'Purchase request status updated successfully.');
    }

    public function srcInfo($info)
    {
        $purchaseRequest = PurchaseRequest::find($info);
        $purchaseRequestItem = $purchaseRequest->purchaseRequestItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($purchaseRequest)
    {
        $purchaseRequest = PurchaseRequest::find($purchaseRequest);
        $purchaseRequest->purchaseRequestItem()->delete();
        $purchaseRequest->delete();

        return redirect()->back();
    }
}
