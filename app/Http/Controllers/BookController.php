<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class BookController
{
    /*protected CategoryService $categoryService;
    protected BookService $bookService;

    public function __construct(CategoryService $categoryService, BookService $bookService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
    }*/

    // Display a listing of the resource.
    /*public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');

        $books = $this->bookService->getAll($search, $categoryId);
        $categories = $this->categoryService->getAll();

        return view('dashboard.books.index', compact('books', 'categories'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $categories = $this->categoryService->getAll();

        return view('dashboard.books.create', compact('categories'));
    }

    //Store a newly created resource in storage.
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'image' => 'nullable|image',
            'category' => 'required|exists:categories,id',
        ]);

        $this->bookService->create($validated);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }


    // Display the specified resource.
    public function show(Book $book)
    {
        return view('dashboard.books.show', compact('book'));
    }

    //test dashboard view
    public function booksDashboard()
    {
        return view('books.index');
    }

    //Show the form for editing the specified resource.
    public function edit(Book $book)
    {
        $categories = $this->categoryService->getAll();

        return view('dashboard.books.edit', compact('book', 'categories'));
    }

    
    //Update the specified resource in storage.
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->bookService->update($book, $request->validated());

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

     //Remove the specified resource from storage.
    public function destroy(Book $book)
    {
        $this->bookService->delete($book);

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }*/
    public function booksDashboard()
    {
        // Return the books dashboard view
        return view('books.index');
    }

    public function create()
    {
        // Return the create book view
        return view('books.create');
    }

    public function show($book)
    {
        // Return the show book view
        return view('books.show', compact('book'));
    }

    public function edit($book)
    {
        // Return the edit book view
        return view('books.edit', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Book added successfully!');
    }
}
