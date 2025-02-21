<x-app-layout>

    <header class="relative bg-cover bg-center h-96 flex items-center justify-center" style="background-image: url('images/bg.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Latest Posts</h1>
            <p class="text-xl text-gray-200">Discover the latest updates and stories from around the world.</p>
        </div>
    </header>
    <main class="p-5">
        <div>
            <a href="/posts/create" class="bg-blue-500 text-white rounded px-6 py-1.5">add post</a>
        </div>
        <div class="container mx-auto py-12 grid grid-cols-1 md:grid-cols-3 gap-10">

            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 transform transition duration-500 hover:scale-105">
                    <img class="w-full h-40 object-cover" src="{{asset('images/bg.jpg')}}" alt="Post Image">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2 text-gray-800"><a href="posts/{{{ $post->id }}}">{{ $post->title }}</a></h2>
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

</x-app-layout>




