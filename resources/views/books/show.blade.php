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
        </div>

        {{-- Description --}}
        @if(!empty($bookDescription))
        <div class="prose text-gray-700 leading-relaxed max-w-none mb-6">
            <span class="font-semibold">Description:</span>
            <p class="mt-1">{{ $bookDescription }}</p>
        </div>
        @endif

        <div class="mt-6 flex justify-center md:justify-start space-x-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                Purchase / Command
            </button>
            @php
                $editId = $book->id ?? null;
            @endphp
            <a href="{{ $editId ? route('books.edit', $editId) : '#' }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                Edit
            </a>
            <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
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
