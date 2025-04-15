<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('welcome')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (Gate::allows('create_post')) {
           return view('posts.create_post');
        }
         return redirect()->route('dashboard')->with('error', 'you are not to add new post,not authorized');
    }
    public function dashboard()
    {
        $posts = Post::latest()->paginate(20);
        return view('posts.post_dashboard')->with('posts', $posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->image);
        $validation = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('posts', $request->file('image'));
        }
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('post_dashboard')->with('success', 'post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.single_post')->with('posts', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit_post')->with('posts', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, Post $post)
    {
        $validation = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = Storage::disk('public')->put('posts', $request->file('image'));
            $post->image = $imagePath;
        }
        Post::find($id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,

        ]);
        return redirect()->route('post_dashboard')->with('success', 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return back()->with('deleted', 'post deleted successfully');
    }
}
