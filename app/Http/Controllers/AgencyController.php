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

        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgencyRequest $request, ImageService $imageService)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {

            dd('hi');

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'agencies');

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

        Agency::create([
            'name'  =>  $input['name'],
            'phone'  =>  $input['phone'],
            'address'  =>  $input['address'],
            'email'  =>  $input['email'],
            'image'  =>  $input['image'],
        ]);


        return response()->json([
            'data' => [
                'message' => 'success'
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

        ],200);
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

        ],200);
    }


    public function update(UpdateAgencyRequest $request, Agency $agency)
    {

        $agency->update([
            "name" => $request->name,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email
        ]);

        return response()->json([
            'message' => 'success'
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
