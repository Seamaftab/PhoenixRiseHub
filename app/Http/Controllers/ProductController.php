<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('view_product_gate');

        $products = Product::with('category')->latest()->paginate(10);
        return view('components.backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('view_product_gate');

        $categories = Category::all();
        return view('components.backend.pages.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {   
        $imageName = '';
        $title = $request->title;

        if ($request->hasFile('image')) 
        {
            $time = now()->format('Y_m_d_H_i_s');
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = 'public/products/'.$title.'_'.$time.'.'.$extension;
            $request->file('image')->storeAs('public/products/'.$title.'_'.$time.'.'.$extension);
            $imageName = asset('storage/products/'.$title.'_'.$time.'.'.$extension);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'title' => $title,
            'price' => $request->price,
            'image' => $imageName,
            'description' => $request->description,
            'status' => $request->status,
            'slug' => Str::slug($title),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product Enlisted successfully');
    }

    public function show($product)
    {
        $this->authorize('view_product_gate');

        $product = Product::with('category')->find($product);
        return view('components.backend.pages.products.show', compact('product'));
    }

    public function edit($product)
    {
        $this->authorize('update_product_gate');

        $product = Product::with('category')->find($product);
        $categories = Category::all();
        return view('components.backend.pages.products.edit', compact('product','categories'));
    }

    public function update(ProductRequest $request, $product)
    {
        $product = Product::findOrFail($product);

        $title = $request->title;

        if ($request->hasFile('image')) 
        {
            $time = now()->format('Y_m_d_H_i_s');
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = 'public/products/'.$title.'_'.$time.'.'.$extension;
            $request->file('image')->storeAs('public/products/'.$title.'_'.$time.'.'.$extension);
            $imageName = asset('storage/products/'.$title.'_'.$time.'.'.$extension);
        }

        $product->update([
            'category_id' => $request->category_id,
            'title' => $title,
            'price' => $request->price,
            'image' => $imageName ?? $product->image,
            'description' => $request->description,
            'status' => $request->status,
            'slug' => Str::slug($title),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product Enlisted successfully');
    }

    public function destroy($product)
    {
        $this->authorize('delete_product_gate');

        $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product sent to trash');
    }

    public function trash()
    {
        $this->authorize('delete_product_gate');

        $products = Product::onlyTrashed()->get();
        return view('components.backend.pages.products.trash', compact('products'));
    }

    public function restore($product)
    {
        $this->authorize('delete_product_gate');

        $product = Product::onlyTrashed()->find($product);
        $product->restore();
        return redirect()->route('products.trash')->with('success', 'Product restored successfully');
    }

    public function delete($product)
    {
        $this->authorize('delete_product_gate');
        
        $product = Product::onlyTrashed()->find($product);
        $product->forceDelete();
        return redirect()->route('products.trash')->with('success', 'Product deleted successfully');        
    }
}
