<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = Category::all();
		return view('components.backend.pages.categories.index',compact('categories'));
	}

	public function create()
	{
		return view('components.backend.pages.categories.create');	
	}

	public function store(CategoryRequest $request)
	{
		Category::create([
			'name' => $request->name,
			'slug' => Str::slug($request->name),
			'created_by' => auth()->id(),
			'updated_by' => auth()->id()
		]);

		return redirect()->route('categories.index')->with('success', 'New Category Added');
	}

	public function edit($category)
	{
		$category = Category::findOrFail($category);
		return view('components.backend.pages.categories.edit', compact('category'));
	}

	public function update(CategoryRequest $request, $category)
	{
		$category = Category::findOrFail($category);

		$category->update([
			'name' => $request->name,
			'slug' => Str::slug($request->name),
			'created_by' => auth()->id(),
			'updated_by' => auth()->id()
		]);

		return redirect()->route('categories.index')->with('success', 'Edit Successful');
	}

	public function destroy($category)
	{
		$category = Category::findOrFail($category);
		$category->delete();

		return redirect()->route('categories.index')->with('success', 'Delete Successful');	
	}
}
