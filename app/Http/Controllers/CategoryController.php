<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a paginated list of categories
    public function index()
    {
        $items = Category::orderBy('name')->paginate(10);
        return view('categories.index', compact('items'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category in the database
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('ok','Category created');
    }

    // Show the form for editing an existing category
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update an existing category with validated data
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('ok','Category updated');
    }

    // Delete a category from the database
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('ok','Category deleted');
    }

    // Show a confirmation page before deleting a category
    public function confirmDestroy(Category $category)
    {
        return view('categories.delete', compact('category'));
    }
}
