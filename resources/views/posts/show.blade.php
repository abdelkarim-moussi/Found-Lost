<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>FoundLost</title>
</head>
<body>
    <div class="bg-white m-20 grid grid-cols-3 rounded-lg shadow-lg overflow-hidden transform transition-all hover:shadow-2xl">
        <img class="col-span-1 h-full object-cover" src="{{asset('images/bg.jpg')}}" alt="Post Image">
        <div class="p-6 col-span-2">
            <h2 class="text-2xl font-bold mb-2 text-gray-800 hover:text-blue-600 transition-colors duration-300">
                {{ $post[0]->title }}
            </h2>
            <p class="text-gray-600 mb-4">{{ $post[0]->description }}</p>
            <div class="flex items-center text-gray-500 text-sm mb-5">
                <span class="mr-4">📅 {{ $post[0]->date }}</span>
                <span>📍 {{ $post[0]->place }}</span>
            </div>
            <a href="/delete/{{$post[0]->id}}" class="bg-red-400 px-3 py-1 rounded mt-5">delete</a>
        </div>
    </div>
    
    <div class="m-20">
       
        <form method="POST" action="/comment">
            @csrf
            <textarea name="content" id="content" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer transition-colors duration-300" placeholder="Write your comment here..."></textarea>
            <input type="hidden" name="post_id" value="{{ $post[0]->id }}">
            <button type="submit" class="py-2 px-5 bg-blue-500 text-white mt-3 rounded hover:bg-blue-600 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Add Comment
            </button>
        </form>
        
        <div class="w-full py-10">
            <h3 class="text-lg font-semibold capitalize text-gray-800">All Comments</h3>
            <div class="flex flex-col gap-5 mt-5">
                @foreach($post[0]->comments as $comment)
                <div class="bg-white p-5 w-full rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                    <p class="text-gray-700">
                        {{ $comment->content }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2">{{ $comment->created_at->format('M d, Y H:i') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>