@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-3xl font-bold mb-6">My Shopping Cart</h2>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    @if($cartBooks->isEmpty())
        <p class="text-gray-600">Your cart is empty.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200 mb-6">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cartBooks as $cart)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cart->book->title ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cart->book->author ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cart->book->published_at ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('books.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out">Continue Shopping</a>
    @endif
</div>
@endsection
