<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;

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
            'data' => [
                'message' => 'success',
                'agencies' => $agencies
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgencyRequest $request)
    {

        $agency = new Agency;

        $agency->create([
            "name" => $request->name,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email
        ]);

        return response()->json([
            'message' => 'success'
        ]);
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
            'data' => [
                'message' =>  'success',
                'agency' => $agency
            ]
        ]);
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
            'data' => [
                'message' =>  'success',
                'agency' => $agency
            ]
        ]);
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
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {

        $agency->delete();
        return response()->json([
            'data' => [
                'message' => 'success'
            ]

        ]);
    }
}
