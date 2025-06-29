<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Book</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffe4e1; /* Misty Rose theme */
        }
        .form-card {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <header class="w-full max-w-2xl mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Add New Book to Library</h1>
        <p class="text-lg text-gray-700">Fill in the details below to add a new book to our collection.</p>
    </header>

    <main class="w-full max-w-2xl bg-white rounded-xl form-card p-8">
        <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Book Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="e.g., The Midnight Library" required>
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                <input type="text" name="author" id="author" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="e.g., Matt Haig" required>
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Published Year</label>
                <input type="number" name="published_at" id="published_at" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="e.g., 2020" min="1000" max="9999" required>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Book Image URL</label>
                <input type="url" name="image" id="image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="e.g., https://example.com/image.jpg" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="Enter a brief description of the book..." required></textarea>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Book Price</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="e.g., 19.99" step="0.01" required>
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Available in Stock</label>
                <input type="number" name="stock" id="stock" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm" placeholder="e.g., 10" min="0" required>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Cancel
                </a>
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Add Book
                </button>
            </div>
        </form>
    </main>

    <footer class="w-full max-w-2xl mt-8 text-center text-gray-600">
        <p>&copy; 2025 Digital Library. All rights reserved.</p>
    </footer>
</body>
</html>
