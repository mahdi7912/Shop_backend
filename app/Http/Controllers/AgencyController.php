<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;
use App\Http\Services\Image\ImageService;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::all();

        return response()->json([

            'message' => 'success',
            'agencies' => $agencies

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgencyRequest $request, ImageService $imageService)
    {
        $agency = new Agency();

        $input = $request->all();

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'agencies');

            $result = $imageService->save($request->file('image'));
            if ($result === false) {

                return response()->json([
                    'message' => 'error loading image',
                ],403);
            }
            $input['image'] = $result;
        }

        $agency->create($input);


        return response()->json([
            'data' => [
                'message' => 'success',
                'agency' => Agency::latest()->first()
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        return response()->json([

            'message' =>  'success',
            'agency' => $agency

        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        return response()->json([

            'message' =>  'success',
            'agency' => $agency

        ], 200);
    }


    public function update(UpdateAgencyRequest $request, Agency $agency, ImageService $imageService)
    {

        $input = $request->all();

        if ($request->hasFile('image')) {

            if (!empty($agency->image)) {

                $imageService->deleteDirectoryAndFiles($agency->image);
                $imageService->deleteImage($agency->image);
            }


            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'agencies');

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

         $agency->update($input);
        return response()->json([
            'message' => 'success',
            'post' => $agency
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency, ImageService $imageService)
    {

        $imageService->deleteImage($agency->image);
        $agency->delete();
        return response()->json([
            'message' => 'success',

        ], 200);
    }
}
