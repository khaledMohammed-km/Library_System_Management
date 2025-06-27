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
            <img src="https://placehold.co/250x350/90EE90/000000?text=Book+Cover" alt="Book Cover" class="rounded-lg w-full md:w-auto h-auto object-cover">
        </div>
        <div class="flex-grow text-center md:text-left">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-3">The Great Adventure</h2>
            <p class="text-xl text-gray-600 mb-2"><strong>Author:</strong> Jane Doe</p>
            <p class="text-lg text-gray-600 mb-2"><strong>Genre:</strong> Fantasy</p>
            <p class="text-lg text-gray-600 mb-2"><strong>Published:</strong> 2023</p>
            <p class="text-lg text-gray-600 mb-4"><strong>Price:</strong> $19.99</p>
            <div class="prose text-gray-700 leading-relaxed max-w-none">
                <p>This epic tale follows the journey of a young hero through mystical lands filled with ancient magic and formidable creatures. Join them as they uncover long-lost secrets, forge powerful alliances, and confront a looming darkness that threatens to engulf their world.</p>
                <p>A true masterpiece of fantasy literature, this book will transport you to a realm where imagination knows no bounds. Perfect for readers who love intricate world-building, compelling characters, and a thrilling plot.</p>
            </div>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Borrow Book
                </button>
                <a href="index.blade.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
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
