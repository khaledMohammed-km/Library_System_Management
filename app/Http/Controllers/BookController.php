<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
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
    }*/

    public function index()
    {
        $categories = Category::all();
        $books = Book::with('category')->get();
        return view('books.index', compact('categories', 'books'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|integer|min:1000|max:9999',
            'description' => 'required|string|max:500',
            'image' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'published_at' => $validated['published_at'],
            'description' => $validated['description'],
            'image' => $validated['image'] ?? null,
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }


    // Display the specified resource.
    public function show($book)
    {
        // Return the show book view
        return view('books.show', compact('book'));
    }

    //test dashboard view
    public function booksDashboard()
    {
        $categories = Category::all();
        $books = Book::with('category')->get();
        return view('books.index', compact('categories', 'books'));
    }

    //Show the form for editing the specified resource.
    public function edit($book)
    {
        // Return the edit book view
        return view('books.edit', compact('book'));
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
    }
}
