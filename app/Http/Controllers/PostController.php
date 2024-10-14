<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("hi");
        $posts = Post::get();
        // dd($posts);
        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            // dd($data);
            $post = new post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->status = 1;
            $post->save();
            return redirect()->back()->with('success', 'Post created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        // echo $post;
        $postDetails = Post::find($post['id']);
        // dd($postDetails);
        return view('posts.edit', compact('postDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        // echo $post; die;
        if ($request->isMethod('PUT')){
            $data = $request->all();
            // dd($data);
            Post::where('_id', $post['_id'])->update([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);                     
            // $post->save();
            return redirect('/posts')->with('success', 'Post updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        //
    }
}
