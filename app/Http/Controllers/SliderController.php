<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Services\Image\ImageService;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request, ImageService $imageService)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {

            // dd('hi');

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'sliders');

            // $result = $imageService->createIndexAndSave($request->file('image'));
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

        Slider::create([
            'url'  =>  $input['url'],
            'image'  =>  $input['image'],
        ]);

        return response()->json([
            'data' => [
                'message' => 'success',
                'slider' => Slider::latest()->first()
             ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider, ImageService $imageService)
    {
        $imageService->deleteImage($slider->image);
        $slider->delete();
        return response()->json([
            'message' => 'success',

        ], 200);
    }
}
