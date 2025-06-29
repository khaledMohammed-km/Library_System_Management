<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7e0; /* Warm Yellow theme */
        }
        .detail-card {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <header class="w-full max-w-4xl mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Book Information</h1>
        <p class="text-lg text-gray-700">Detailed insights into your selected book.</p>
    </header>

    <main class="w-full max-w-4xl bg-white rounded-xl detail-card p-8 flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
        <div class="flex-shrink-0">
            @php
                $coverUrl = '';
                $title = '';
                if (is_object($book)) {
                    $title = isset($book->title) ? $book->title : '';
                    $coverUrl = isset($book->image) && !empty($book->image) ? $book->image : '';
                } elseif (is_array($book)) {
                    $title = isset($book['title']) ? $book['title'] : '';
                    $coverUrl = isset($book['image']) && !empty($book['image']) ? $book['image'] : '';
                }
                if (empty($coverUrl)) {
                    $coverUrl = 'https://covers.openlibrary.org/b/isbn/' . urlencode($title) . '-L.jpg';
                }
            @endphp
            <img src="{{ $coverUrl }}" alt="Book Cover" class="rounded-lg w-full md:w-64 h-auto object-cover mb-4" onerror="this.onerror=null;this.src='https://placehold.co/250x350/cccccc/000000?text=No+Image';">
        </div>
        <div class="flex-grow text-center md:text-left">
            @php
                // Ensure $book is an Eloquent model and has loaded relations
                $bookTitle = $book->title ?? '';
                $bookAuthor = $book->author ?? '';
                $bookCategory = ($book->category && isset($book->category->name)) ? $book->category->name : 'N/A';
                $bookPublished = $book->published_at ?? '';
                $bookPrice = $book->price ?? null;
                $bookDescription = $book->description ?? '';
            @endphp

        <h2 class="text-3xl font-extrabold text-gray-800 mb-3">{{ $bookTitle }}</h2>

        <div class="flex flex-col space-y-2 mb-4">
            {{-- Author --}}
            <div class="flex items-center">
                <span class="font-semibold mr-2">Author:</span>
                <span>{{ $bookAuthor }}</span>
            </div>
            {{-- Genre --}}
            <div class="flex items-center">
                <span class="font-semibold mr-2">Genre:</span>
                <span>{{ $bookCategory }}</span>
            </div>
            {{-- Published --}}
            <div class="flex items-center">
                <span class="font-semibold mr-2">Published:</span>
                <span>{{ $bookPublished }}</span>
            </div>
            {{-- Price (only if set) --}}
            @if($bookPrice)
            <div class="flex items-center">
                <span class="font-semibold mr-2">Price:</span>
                <span class="text-green-600 font-bold">${{ number_format($bookPrice, 2) }}</span>
            </div>
            @endif
            {{-- Stock --}}
            <div class="flex items-center">
                <span class="font-semibold mr-2">Available in Stock:</span>
                <span class="text-blue-700 font-bold">{{ $book->stock ?? 0 }}</span>
            </div>
        </div>

        {{-- Description --}}
        @if(!empty($bookDescription))
        <div class="prose text-gray-700 leading-relaxed max-w-none mb-6">
            <span class="font-semibold">Description:</span>
            <p class="mt-1">{{ $bookDescription }}</p>
        </div>
        @endif

        <div class="flex flex-wrap justify-center md:justify-start gap-4 w-full mt-8">
    
            <form action="{{ route('cart.add', $book->id) }}" method="POST"
                class="flex-shrink-0 w-40 flex items-center justify-center"> 
                @csrf
                <button type="submit" class="w-full h-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center justify-center">
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5 mr-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007.5 17h9a1 1 0 00.85-1.53L17 13M7 13V6a1 1 0 011-1h5a1 1 0 011 1v7'></path></svg>
                    Add to Cart
                </button>
            </form>

            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('books.edit', $book) }}"
                    class="flex-shrink-0 w-40 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center justify-center">
                        Edit
                    </a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');"
                        class="flex-shrink-0 w-40 flex items-center justify-center"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full h-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                            Delete
                        </button>
                    </form>
                @endif
            @endauth
            <a href="{{ route('books.index') }}"
            class="flex-shrink-0 w-40 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center justify-center">
                Back to Books
            </a>
        </div>
    </div>
    </main>

    <footer class="w-full max-w-4xl mt-8 text-center text-gray-600">
        <p>&copy; 2025 Digital Library. All rights reserved.</p>
    </footer>
</body>
</html>
