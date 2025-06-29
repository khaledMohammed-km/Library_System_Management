<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book; // Make sure this is imported
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Updated 'add' method to use Route Model Binding for Book
    public function add(Request $request, Book $book) // Changed from $bookId to Book $book
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Check if the book is in stock
        if ($book->stock <= 0) { // Changed to <= 0 for robustness
            return redirect()->route('books.show', $book->id)->with('error', 'This book is out of stock.');
        }

        // Check if this specific book is already in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('book_id', $book->id)
                        ->first();

        if ($cartItem) {
            // If the book is already in the cart, inform the user or handle quantity
            // For now, assuming you don't want duplicate entries in cart (no quantity column)
            return redirect()->route('books.show', $book->id)->with('error', 'This book is already in your cart.');
        }

        // If not in cart and in stock, add it
        Cart::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);
        $book->decrement('stock'); // Decrement stock as it's now in a cart
        return redirect()->route('books.index')->with('success', 'Book added to cart!');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $cartBooks = Cart::with('book')->where('user_id', $user->id)->get();
        // Ensure this points to resources/views/cart/index.blade.php
        return view('cart.index', compact('cartBooks'));
    }

    public function remove(Cart $cart) // Uses Route Model Binding for Cart
    {
        // Security check: Ensure the authenticated user owns this cart item
        if (Auth::id() !== $cart->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Re-increment the book's stock only if the book still exists
        $book = $cart->book;
        if ($book) {
            $book->increment('stock');
        }

        // Delete the cart item
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Book removed from cart.');
    }
}