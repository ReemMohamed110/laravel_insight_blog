<?php


namespace App\Http\Controllers;



use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,Post $post){
        //  dd(123);
        $validation = $request->validate([
            'content' => 'required|string',
            'parent_id'=>"nullable|exists:comments,id"
        ]);
        Comment::create([
            'content'=>$request->content,
            'post_id'=>$post->id,
            'user_id'=>Auth::id(),
            'parent_id'=>$request->parent_id,
        ]);
      return redirect()->back();
    }
}
