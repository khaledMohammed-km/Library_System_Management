<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #e6e6fa; /* Lavender theme */
        }
        .form-container {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <header class="w-full max-w-2xl mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Edit Book Information</h1>
        <p class="text-lg text-gray-700">Update the details for the selected book.</p>
    </header>

    <main class="w-full max-w-2xl bg-white rounded-xl form-container p-8">
        <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Book Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Published Year</label>
                <input type="number" name="published_at" id="published_at" value="{{ old('published_at', $book->published_at) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="1000" max="9999" required>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Book Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $book->price) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" step="0.01">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Book Image URL</label>
                <input type="url" name="image" id="image" value="{{ old('image', $book->image) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description', $book->description) }}</textarea>
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Available in Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0" required>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Cancel
                </a>
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </main>

    <footer class="w-full max-w-2xl mt-8 text-center text-gray-600">
        <p>&copy; 2025 Digital Library. All rights reserved.</p>
    </footer>
</body>
</html>
