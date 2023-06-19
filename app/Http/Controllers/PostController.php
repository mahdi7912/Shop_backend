<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTagsRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Services\Image\ImageService;
use App\Models\Image;
use App\Models\Tag;

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
        return new PostResource($posts);
    }

    public function store(StorePostRequest $request, ImageService $imageService)
    {

        $input = $request->all();
        // dd($request);
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
            'status'  =>  $input['status']
        ]);



        return response()->json([
            'data' => [
                'message' => 'success',
                'post' => Post::latest()->first()
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
            'post' => $post,
            'tags' => $post->tags
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
            'post' => $post,
            'tags' => $post->tags
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

        if ($request->hasFile('image')) {

            if (!empty($post->image)) {
                $imageService->deleteDirectoryAndFiles($post->image);
                $imageService->deleteImage($post->image);
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

            $input['image'] = $result;
        }

        $input['tags'] = $input['tags'] ?? [];
        $post->tags()->attach($input['tags']);


        $post->update($input);


        return response()->json([
            'message' => 'success',
            'post' => $post
        ], 200);
    }



    public function destroy(Post $post, ImageService $imageService)
    {
        $imageService->deleteImage($post->image);
        $post->delete();
        return response()->json([
            'message' => 'success',

        ], 200);
    }
}
