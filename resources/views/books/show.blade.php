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
            <h2 class="text-3xl font-extrabold text-gray-800 mb-3">{{ $book->title }}</h2>
            <div class="flex flex-col space-y-2 mb-4">
                <div><span class="font-semibold">Author:</span> {{ $book->author }}</div>
                <div><span class="font-semibold">Genre:</span> {{ $book->category->name ?? 'N/A' }}</div>
                <div><span class="font-semibold">Published:</span> {{ $book->published_at }}</div>
                @if(isset($book->price))
                <div><span class="font-semibold">Price:</span> ${{ $book->price }}</div>
                @endif
            </div>
            <div class="prose text-gray-700 leading-relaxed max-w-none mb-6">
                <p>{{ $book->description }}</p>
            </div>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Purchase / Command
                </button>
                <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
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
