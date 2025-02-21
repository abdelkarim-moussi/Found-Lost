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
        $posts = Post::all();
        $stats = Post::all()->count();
        return view('posts/index',['posts'=>$posts,'categories'=>$categories,'stats'=>$stats]);
    }

    public function show($id)
    {
        $post = Post::find($id)->with('comments','category')->get();
        // dd($post[0]->title);
        return view('posts/show',['post'=>$post]);
    }

    public function store(Request $request)
    {
    
            $validate = $request->validate(
                [
                    'title'=>"required | string",
                    'description'=>"required | string | min:100",
                    'place'=>"required | string"
                ]
                );

            $post = Post::create(
            [
                'user_id'=>Auth::user()->id,
                'title'=> strtolower($validate['title']),
                'description'=> strtolower($validate['description']),
                'cat_id'=> $request->input('category'),
                'date'=> $request->input('date'),
                'place'=> $validate['place'],
                'cover'=>$request->cover->path()
            ]
            );

            $post['cover'] = $request->cover->store('images');

            dd($post);
            $post->save();
            // return redirect("/posts");

    }

    public function search(Request $request)
    {
        $key = trim(strtolower(($request->get('search'))));
        
        $posts = Post::query()
        ->where('title','like',"%{$key}%")
        ->orWhere('description','like',"%{$key}%")
        ->orWhere('place','like',"%{$key}%")
        ->orderBy('created_at','desc')
        ->get();
        // ->paginate(6);

        $categories = Category::all();
        return view('posts/index',['posts'=>$posts,'categories'=>$categories]);

    }

    public function filter(Request $request)
    {
        $category = Category::query()
        ->where('name','like',$request->filter)->get();

        $posts = Post::query()
        ->where('cat_id','=',$category[0]->id)
        ->orderBy('created_at','desc')
        ->get();
        // // ->paginate(6);

        $categories = Category::all();
        return view('posts/index',['posts'=>$posts,'categories'=>$categories]);

    }

    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();

        return redirect("posts");
    }

}
