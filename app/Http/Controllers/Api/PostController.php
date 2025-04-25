<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return response()->json(PostResource::collection($posts), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(123);
        $validation = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('posts', $request->file('image'));
        }
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => 1,
        ]);
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        $validation = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
        ]);
        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = Storage::disk('public')->put('posts', $request->file('image'));
            $post->image = $imagePath;
        }
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,

        ]);
        return response()->json(new PostResource($post), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post = Post::destroy($post->id);
        return response()->json(['message' => 'post deleted'], 200);
    }
}
