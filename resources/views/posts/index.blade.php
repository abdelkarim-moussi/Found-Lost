<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>FoundLost</title>
</head>
<body>
    

    <header class="relative bg-cover bg-center h-96 flex items-center justify-center" style="background-image: url('images/bg.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Latest Posts</h1>
            <p class="text-xl text-gray-200">Discover the latest updates and stories from around the world.</p>
        </div>
    </header>

    <main class="p-5">
        <div class="flex gap-5 items-center justify-between">
            <p><strong>disponible articles :</strong> {{ $stats }}</p>
            <div class="w-[50%] flex gap-5 items-center">
                <form action="/filter" method="GET" class="flex gap-3 w-ful">
                    <select name="filter" id="filter" class="block px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="flex-1 bg-blue-500 px-5 text-white rounded py-1">filter</button>
                </form>
                <form action="/search" method="GET" role="search" class="flex items-center justify-center gap-3">
                    <input type="search" name="search" class="block px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    </input>
                    <button type="submit" class="flex-1 bg-blue-500 px-5 text-white rounded py-1">search</button>
                </form>
            </div>
            <a href="/posts/create" class="bg-blue-500 text-white rounded px-5 py-1">add post</a>
        </div>
        <div class="container mx-auto py-12 grid grid-cols-1 md:grid-cols-3 gap-10">

            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 transform transition duration-500 hover:scale-105">
                    <img class="w-full h-40 object-cover" src="{{ asset('storage/app/images/'.$post->cover) }}" alt="Post Cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2 text-gray-800"><a href="posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                        <p class="text-gray-600 mb-4">{{ $post->description }}</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <span class="mr-4">📅 {{ $post->date }}</span>
                            <span>📍 {{ $post->place }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

</body>
</html>



