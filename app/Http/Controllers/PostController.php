<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index(){
        $posts = Post::all();
        return view('posts/index',['posts'=>$posts]);
    }

    public function show($id){
        $post = Post::find($id)->with('comments')->get();
        // dd($post[0]->title);
        return view('posts/show',['post'=>$post]);
    }

    public function store(Request $request)
    {
            $post = Post::create(
            [
                'user_id'=>Auth::user()->id,
                'title'=> $request->input('title'),
                'description'=> $request->input('description'),
                'category'=> $request->input('category'),
                'date'=> $request->input('date'),
                'place'=> $request->input('place')
            ]
            );

            $post->save();
            return redirect("/posts");

    }

}
