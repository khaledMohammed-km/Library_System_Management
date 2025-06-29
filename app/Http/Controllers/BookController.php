<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Services\BookService;
use App\Services\CategoryService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BookController
{
    use AuthorizesRequests;

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
        if (!auth()->user() || !auth()->user()->isAdmin()) {
             abort(403, 'This action is unauthorized.');
        }
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'This action is unauthorized.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|integer|min:1000|max:9999',
            'description' => 'required|string|max:500',
            'image' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'published_at' => $validated['published_at'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }


    // Display the specified resource.
    public function show(Book $book) 
    {
        $book->load('category'); 
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
    public function edit(Book $book)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'This action is unauthorized.');
        }
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Book $book)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'This action is unauthorized.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|integer|min:1000|max:9999',
            'description' => 'required|string|max:500',
            'image' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
        ]);
        $book->update($validated);
        return redirect()->route('books.show', $book->id)->with('success', 'Book updated successfully');
    }

     //Remove the specified resource from storage.
    public function destroy(Book $book)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'This action is unauthorized.');
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
