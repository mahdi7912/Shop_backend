<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTagsRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\Image\ImageService;
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
            'posts' => $posts,
        ]);
    }

    public function store(StorePostRequest $request, ImageService $imageService)
    {

        $input = $request->all();
        if ($request->hasFile('image')) {

            // dd('hi');

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');

            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return response()->json([
                    'data' => [
                        'message' => 'error'
                    ]
                ], 403);
            }
        }
        $input['image'] = $result;
        $post = Post::create($input);


        return response()->json([
            'data' => [
                'message' => 'success'
            ]
        ], 200);
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
        ], 200);
    }

    public function storeTags(PostTagsRequest $request, Post $post)
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

        ], 200);
    }
}
