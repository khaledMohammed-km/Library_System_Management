<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Shopping Cart - Digital Library</title> {{-- Improved title --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f9ff; /* Consistent background, or match your global layout */
        }
        /* Optional: Add custom styles for table if needed */
        .cart-table th, .cart-table td {
            padding: 1rem; /* More generous padding */
            border-bottom: 1px solid #e2e8f0; /* Light gray border */
        }
        .cart-table thead th {
            background-color: #f7fafc; /* Lighter header background */
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center py-8 px-4 sm:px-6 lg:px-8">
    {{-- This entire content block can be wrapped in @section('content') if you use layouts.app --}}
    <div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8 w-full"> {{-- Added w-full --}}
        <h2 class="text-3xl font-bold mb-6 text-gray-800">My Shopping Cart</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if($cartBooks->isEmpty())
            <p class="text-gray-600 text-lg mb-6">Your cart is empty. Time to find some great reads!</p>
            <a href="{{ route('books.index') }}" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Continue Shopping
            </a>
        @else
            <div class="overflow-x-auto"> {{-- Added for better mobile responsiveness for tables --}}
                <table class="min-w-full divide-y divide-gray-200 shadow-sm rounded-lg overflow-hidden cart-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $totalPrice = 0; @endphp
                        @foreach($cartBooks as $cart)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cart->book->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $cart->book->author ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $cart->book->published_at ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">${{ number_format($cart->book->price ?? 0, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <form action="{{ route('cart.remove', $cart->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this book from your cart?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold py-1 px-3 rounded transition duration-150 ease-in-out">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @php $totalPrice += $cart->book->price ?? 0; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td colspan="3" class="px-6 py-4 text-right text-base font-semibold text-gray-700">Total:</td>
                            <td class="px-6 py-4 text-left text-base font-bold text-green-700">${{ number_format($totalPrice, 2) }}</td>
                            <td class="px-6 py-4"></td> {{-- Empty cell for Actions column --}}
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('books.index') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out text-center inline-flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Continue Shopping
                </a>
                <button class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out text-center inline-flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Proceed to Checkout
                </button>
            </div>
        @endif
    </div>
</body>
</html>