<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\COmment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showComments($id){
        $comments = Comment::all()->where('post_id','=',$id);
        return redirect('posts/'.$id,['comments'=>$comments]);
    }
    
    public function addComment(Request $request){
        if(!isset(Auth::user()->id)){
            return redirect('login');
        }
        else{
            $comment = Comment::create(
                [
                    'post_id'=>$request->input('post_id'),
                    'user_id'=>Auth::user()->id,
                    'content'=>$request->input('content')
                ]
                );
            $comment->save();
    
            return redirect('/posts/'.$comment->post_id);
        }
        
    }
}
