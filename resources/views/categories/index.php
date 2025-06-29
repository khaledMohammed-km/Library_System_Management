<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col items-center py-8 px-4">
    <header class="w-full max-w-4xl mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-4">Book Categories</h1>
        <p class="text-lg text-gray-700">Browse and manage available book genres.</p>
        <a href="{{ route('categories.create') }}" class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-6 rounded-full transition duration-300 ease-in-out hover:scale-105 shadow-md">
            + Add New Category
        </a>
        <a href="{{ route('books.create') }}" class="mt-6 ml-4 inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2.5 px-6 rounded-full transition duration-300 ease-in-out hover:scale-105 shadow-md">
            Back to Books
        </a>
    </header>
    <main class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
            <div class="category-card bg-indigo-50 p-6 rounded-lg shadow-sm flex items-center justify-between">
                <span class="text-xl font-semibold text-indigo-800">{{ $category->name }}</span>
                <div class="flex space-x-2">
                    <a href="/categories/{category}/edit" class="text-indigo-600 hover:text-indigo-800 transition duration-150">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>