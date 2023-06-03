<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTagsRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([

            'message' => 'success',
            'posts' => $posts

        ]);
    }

    public function store(StorePostRequest $request)
    {

        $post = new Post;

        $post->name = $request->name;
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;

        $post->save();
        $post->tags->create([
            'name' => $request->tags
        ]);

        return response()->json([
            'data' => [
                'message' => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'message' => 'success',
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()->json([
            'message' => 'success',
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request);
        $post->update($request->all());
        return response()->json([
            'message' => 'success',
            'post' => $post
        ]);
    }

    public function storeTags(PostTagsRequest $request , Post $post)
    {
        $input = $request->all();
        $input['tags'] = $input['tags'] ?? [];
        $post->tags->sync($input['tags']);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'success',

        ]);
    }
}
