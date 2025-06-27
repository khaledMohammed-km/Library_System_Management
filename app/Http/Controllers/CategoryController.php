<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Return the categories index view
        return view('categories.index');
    }

    public function create()
    {
        // Return the create category view
        return view('categories.create');
    }

    public function edit($category)
    {
        // Return the edit category view
        return view('categories.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard')->with('success', 'Category created successfully!');
    }
}
