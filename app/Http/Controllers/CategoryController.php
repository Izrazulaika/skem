<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(6); // Assuming you want 4 categories per page
        $page = $categories->currentPage();
        return view('categories.index', compact('categories', 'page'));
    }


    public function show(Category $category)
    {
        $category->load('subjects'); // Load the subjects related to the category
        return view('categories.show', compact('category'));
    }


    public function create()
    {
        return view('categories.create');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }


    public function store(Request $request): RedirectResponse
    {
        // Check if the category already exists
        $existingCategory = Category::where('name', $request->category_name)->exists();
        if ($existingCategory) {
            return redirect()->route('categories.create')->with('error', 'Category already exists!');
        }

        // Create the category
        $category = new Category();
        $category->name = $request->category_name;
        $category->save();

        return redirect()->route('categories.create')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            // Add validation rules for other fields as needed
        ]);

        $category->update([
            'name' => $request->category_name,
            // Update other fields as needed
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }



}
