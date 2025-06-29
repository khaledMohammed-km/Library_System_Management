<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, $bookId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $book = Book::findOrFail($bookId);
        if ($book->stock > 0) {
            Cart::firstOrCreate([
                'user_id' => $user->id,
                'book_id' => $bookId,
            ]);
            $book->decrement('stock');
            return redirect()->route('books.index')->with('success', 'Book added to cart!');
        } else {
            return redirect()->route('books.show', $bookId)->with('error', 'This book is out of stock.');
        }
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $cartBooks = Cart::with('book')->where('user_id', $user->id)->get();
        return view('cart.index', compact('cartBooks'));
    }
}
