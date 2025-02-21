<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $posts = Post::simplePaginate(6);
        return view('posts/index',['posts'=>$posts,'categories'=>$categories]);
    }

    public function show($id)
    {
        $post = Post::find($id)->with('comments','category')->get();
        // dd($post[0]->title);
        return view('posts/show',['post'=>$post]);
    }

    public function store(Request $request)
    {
            $post = Post::create(
            [
                'user_id'=>Auth::user()->id,
                'title'=> strtolower($request->input('title')),
                'description'=> strtolower($request->input('description')),
                'cat_id'=> $request->input('category'),
                'date'=> $request->input('date'),
                'place'=> $request->input('place')
            ]
            );

            $post->save();
            return redirect("/posts");

    }

    public function search(Request $request)
    {
        $key = trim(strtolower(($request->get('search'))));
        
        $posts = Post::query()
        ->where('title','like',"%{$key}%")
        ->orWhere('description','like',"%{$key}%")
        ->orWhere('place','like',"%{$key}%")
        ->orderBy('created_at','desc')
        ->paginate(6);

        $categories = Category::all();
        return view('posts/index',['posts'=>$posts,'categories'=>$categories]);

    }

}
