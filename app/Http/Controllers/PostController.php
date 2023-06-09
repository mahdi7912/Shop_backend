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
        dd($request);
        if ($request->hasFile('image')) {

            // dd('hi');

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');

            // $result = $imageService->createIndexAndSave($request->file('image'));
            $result = $imageService->save($request->file('image'));
// dd(gettype($result));
            if ($result === false) {
                return response()->json([
                    'data' => [
                        'message' => 'error'
                    ]
                ], 403);
            }

        $input['image'] = $result;
        }
        $post = new Post;
        $post->create([
            'name'  =>  $input['name'],
            'summary'  =>  $input['summary'],
            'description'  =>  $input['description'],
            'category_id'  =>  $input['category_id'],
            'user_id'  =>  $input['user_id'],
            'image'  =>  $input['image'],
        ]);


        return response()->json([
            'data' => [
                'message' => 'success',
                'agency' => Post::latest()->first()
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
    public function update(UpdatePostRequest $request, Post $post, ImageService $imageService)
    {


        $input = $request->all();

        dd($input);
        if ($request->hasFile('image')) {

            if (!empty($post->image)) {
                $imageService->deleteDirectoryAndFiles($post->image);
            }


            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');

            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return response()->json([
                    'data' => [
                        'message' => 'error'
                    ]
                ], 403);
            }
        }

        $input['image'] = $result;
         $post->update([
            'name'  =>  $input['name'],
            'summary'  =>  $input['summary'],
            'description'  =>  $input['description'],
            'category_id'  =>  $input['category_id'],
            'user_id'  =>  $input['user_id'],
            'image'  =>  $input['image'],
        ]);
        return response()->json([
            'message' => 'success',
            'agency' => $post
        ], 200);
    }

    public function storeTags(PostTagsRequest $request, Post $post)
    {
        $input = $request->all();
        $input['tags'] = $input['tags'] ?? [];
        $post->tags->sync($input['tags']);
    }

    public function destroy(Post $post , ImageService $imageService)
    {
        $imageService->deleteImage($post->image);
        $post->delete();
        return response()->json([
            'message' => 'success',

        ], 200);
    }
}
