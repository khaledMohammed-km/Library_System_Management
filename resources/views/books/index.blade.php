<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f9ff; /* Light Cyan theme - a softer, new background */
        }
        .book-card {
            transition: transform 0.2s ease-in-out;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center py-8 px-4 sm:px-6 lg:px-8">
    <header class="w-full max-w-7xl mb-12 text-center">
        <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-4">Welcome to Our Digital Library</h1>
        <p class="text-xl text-gray-700">Explore our collection of available books below.</p>
        <button id="recommendationButton" class="mt-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
            ✨ Discover New Books
        </button>
    </header>

    <!-- Recommendation Section -->
    <section id="recommendationSection" class="w-full max-w-7xl bg-white rounded-xl shadow-lg p-6 mb-12 hidden">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">✨ Recommended Just For You</h2>
        <div id="recommendationContent" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Recommendations will be loaded here -->
        </div>
        <p id="loadingIndicator" class="text-center text-gray-600 mt-4 hidden">Loading recommendations...</p>
        <p id="errorFeedback" class="text-center text-red-500 mt-4 hidden">Failed to load recommendations. Please try again.</p>
    </section>

    <!-- Search and Filter Section -->
    <section class="w-full max-w-7xl mb-8 flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="w-full sm:w-1/2">
            <label for="searchBox" class="sr-only">Search by Book Name</label>
            <input type="text" id="searchBox" placeholder="Search by book name..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg">
        </div>
        <div class="w-full sm:w-auto">
            <label for="categoryFilter" class="sr-only">Filter by Category</label>
            <select id="categoryFilter" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg">
                <option value="all">All Categories</option>
                <option value="fantasy">Fantasy</option>
                <option value="mystery">Mystery</option>
                <option value="programming">Programming</option>
                <option value="history">History</option>
                <!-- Add more categories as needed -->
            </select>
        </div>
    </section>

    <main id="bookList" class="w-full max-w-7xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <!-- Example Book Card 1 -->
        <a href="show.blade.php?book_id=1" class="book-card bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden cursor-pointer p-4 flex flex-col items-center text-center" data-category="fantasy" data-title="The Great Adventure" data-price="19.99">
            <img src="https://placehold.co/150x200/90EE90/000000?text=Book+Cover+1" alt="Book Cover" class="rounded-lg mb-4 w-3/4 h-auto object-cover">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">The Great Adventure</h3>
            <p class="text-gray-600 text-sm">Author: Jane Doe</p>
            <p class="text-gray-500 text-xs mt-1">Genre: Fantasy</p>
            <p class="text-green-600 font-bold mt-2">$19.99</p>
        </a>

        <!-- Example Book Card 2 -->
        <a href="show.blade.php?book_id=2" class="book-card bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden cursor-pointer p-4 flex flex-col items-center text-center" data-category="mystery" data-title="Mystery of the Old House" data-price="15.50">
            <img src="https://placehold.co/150x200/ADD8E6/000000?text=Book+Cover+2" alt="Book Cover" class="rounded-lg mb-4 w-3/4 h-auto object-cover">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Mystery of the Old House</h3>
            <p class="text-gray-600 text-sm">Author: John Smith</p>
            <p class="text-gray-500 text-xs mt-1">Genre: Mystery</p>
            <p class="text-green-600 font-bold mt-2">$15.50</p>
        </a>

        <!-- Example Book Card 3 -->
        <a href="show.blade.php?book_id=3" class="book-card bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden cursor-pointer p-4 flex flex-col items-center text-center" data-category="programming" data-title="Coding with Joy" data-price="29.99">
            <img src="https://placehold.co/150x200/FFD700/000000?text=Book+Cover+3" alt="Book Cover" class="rounded-lg mb-4 w-3/4 h-auto object-cover">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Coding with Joy</h3>
            <p class="text-gray-600 text-sm">Author: Alice Tech</p>
            <p class="text-gray-500 text-xs mt-1">Genre: Programming</p>
            <p class="text-green-600 font-bold mt-2">$29.99</p>
        </a>

        <!-- Example Book Card 4 -->
        <a href="show.blade.php?book_id=4" class="book-card bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden cursor-pointer p-4 flex flex-col items-center text-center" data-category="history" data-title="Historical Echoes" data-price="22.75">
            <img src="https://placehold.co/150x200/F08080/000000?text=Book+Cover+4" alt="Book Cover" class="rounded-lg mb-4 w-3/4 h-auto object-cover">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Historical Echoes</h3>
            <p class="text-gray-600 text-sm">Author: Robert History</p>
            <p class="text-gray-500 text-xs mt-1">Genre: History</p>
            <p class="text-green-600 font-bold mt-2">$22.75</p>
        </a>

        <!-- Add more book cards as needed -->
    </main>

    <footer class="w-full max-w-7xl mt-12 text-center text-gray-600">
        <p>&copy; 2025 Digital Library. All rights reserved.</p>
    </footer>

    <script>
        // Function to filter books
        function filterBooks() {
            const searchInput = document.getElementById('searchBox').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
            const bookCards = document.querySelectorAll('#bookList .book-card');

            bookCards.forEach(card => {
                const title = card.getAttribute('data-title').toLowerCase();
                const category = card.getAttribute('data-category').toLowerCase();

                const matchesSearch = title.includes(searchInput);
                const matchesCategory = (categoryFilter === 'all' || category === categoryFilter);

                if (matchesSearch && matchesCategory) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }

        // Event listeners for search and filter
        document.getElementById('searchBox').addEventListener('keyup', filterBooks);
        document.getElementById('categoryFilter').addEventListener('change', filterBooks);

        // Gemini API recommendation feature (existing code)
        document.getElementById('recommendationButton').addEventListener('click', async () => {
            const recommendationSection = document.getElementById('recommendationSection');
            const recommendationContent = document.getElementById('recommendationContent');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const errorFeedback = document.getElementById('errorFeedback');

            recommendationSection.classList.remove('hidden'); // Show the section
            loadingIndicator.classList.remove('hidden'); // Show loading
            errorFeedback.classList.add('hidden'); // Hide any previous errors
            recommendationContent.innerHTML = ''; // Clear previous recommendations

            // Define the prompt for the LLM
            const prompt = "As a helpful library assistant, provide 3 highly engaging fictional books. For each book, include its title, author, and a one-sentence enticing description. Ensure the books are from different popular genres.";

            // Define the desired structured response schema
            const responseSchema = {
                type: "ARRAY",
                items: {
                    type: "OBJECT",
                    properties: {
                        "title": { "type": "STRING" },
                        "author": { "type": "STRING" },
                        "description": { "type": "STRING" }
                    },
                    "propertyOrdering": ["title", "author", "description"]
                }
            };

            try {
                let chatHistory = [];
                chatHistory.push({ role: "user", parts: [{ text: prompt }] });
                const payload = {
                    contents: chatHistory,
                    generationConfig: {
                        responseMimeType: "application/json",
                        responseSchema: responseSchema
                    }
                };

                const apiKey = ""; // Canvas will automatically provide the API key
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (result.candidates && result.candidates.length > 0 &&
                    result.candidates[0].content && result.candidates[0].content.parts &&
                    result.candidates[0].content.parts.length > 0) {
                    const json = result.candidates[0].content.parts[0].text;
                    const parsedJson = JSON.parse(json);

                    // Render recommendations
                    parsedJson.forEach(book => {
                        const bookHtml = `
                            <div class="bg-blue-50 p-4 rounded-lg shadow-md flex items-center space-x-4">
                                <img src="https://placehold.co/80x100/60A5FA/ffffff?text=Book" alt="Book Cover" class="rounded-md flex-shrink-0">
                                <div>
                                    <h4 class="text-lg font-semibold text-blue-800">${book.title}</h4>
                                    <p class="text-gray-700 text-sm">By ${book.author}</p>
                                    <p class="text-gray-600 text-xs mt-1">${book.description}</p>
                                </div>
                            </div>
                        `;
                        recommendationContent.innerHTML += bookHtml;
                    });
                } else {
                    errorFeedback.textContent = "No recommendations found. Please try again.";
                    errorFeedback.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error fetching recommendations:', error);
                errorFeedback.textContent = "An error occurred while fetching recommendations. Please check your network connection.";
                errorFeedback.classList.remove('hidden');
            } finally {
                loadingIndicator.classList.add('hidden'); // Hide loading regardless of success/failure
            }
        });
    </script>
</body>
</html>
