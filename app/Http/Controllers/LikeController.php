<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post){
        if($post->likes()->where('user_id',Auth::id())->exists()){
            $post->likes()->where('user_id',Auth::id())->delete();
            return response()->json(['liked' => false,'likesCount'=>$post->likes()->count()]);
        }else{
        Like::create([
            'user_id'=>Auth::id(),
            'post_id'=>$post->id,
        ]);
        return response()->json(['liked' => true,'likesCount'=>$post->likes()->count()]);
    }
    }
}
