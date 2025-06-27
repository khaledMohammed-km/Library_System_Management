<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #e0f7fa; /* Light Cyan theme for category editing */
        }
        .form-container {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <header class="w-full max-w-xl mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Edit Category Name</h1>
        <p class="text-lg text-gray-700">Update the name of this book genre.</p>
    </header>

    <main class="w-full max-w-xl bg-white rounded-xl form-container p-8">
        <form action="#" method="POST" class="space-y-6">
            <div>
                <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="category_name" id="category_name" value="Fantasy" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="index.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </main>

    <footer class="w-full max-w-xl mt-8 text-center text-gray-600">
        <p>&copy; 2025 Digital Library. All rights reserved.</p>
    </footer>
</body>
</html>
